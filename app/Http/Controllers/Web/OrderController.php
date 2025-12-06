<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use MercadoPago\Client\Preference\PreferenceClient;
use MercadoPago\MercadoPagoConfig;

class OrderController extends Controller
{
  /**
   * Mostrar formulario de checkout.
   */
  public function checkout()
  {
    try {
      $cart = session('cart', []);

      if (empty($cart)) {
        return to_route('cart.index')
          ->with('feedback.message', 'El carrito está vacío.')
          ->with('feedback.type', 'warning');
      }

      $user = Auth::user();

      // Obtener información completa de los productos para validar stock
      $productIds = array_keys($cart);
      $products = Product::whereIn('id', $productIds)->get()->keyBy('id');

      // Validar stock antes de continuar
      foreach ($cart as $productId => $item) {
        $product = $products->get($productId);
        
        if (!$product || !$product->is_active) {
          return to_route('cart.index')
            ->with('feedback.message', "El producto '{$item['name']}' ya no está disponible.")
            ->with('feedback.type', 'danger');
        }
        
        if ($product->stock < $item['quantity']) {
          return to_route('cart.index')
            ->with('feedback.message', "No hay suficiente stock de '{$item['name']}'. Disponible: {$product->stock}")
            ->with('feedback.type', 'danger');
        }
      }

      // Calcular total
      $total = 0;
      foreach ($cart as $item) {
        $total += $item['price'] * $item['quantity'];
      }

      // Crear la orden en estado "pending" usando transacción
      $order = DB::transaction(function () use ($cart, $user, $total, $products) {
        // Crear la orden
        $order = Order::create([
          'user_id' => $user->id,
          'total_amount' => $total,
          'status' => 'pending',
        ]);

        // Crear los items de la orden y reservar stock
        foreach ($cart as $productId => $item) {
          $product = $products->get($productId);

          OrderItem::create([
            'order_id' => $order->id,
            'product_id' => $productId,
            'quantity' => $item['quantity'],
            'price' => $item['price'],
          ]);

          // Reservar stock (descontar)
          $product->decrement('stock', $item['quantity']);
        }

        return $order;
      });

      // Crear preferencia de Mercado Pago
      MercadoPagoConfig::setAccessToken(config('mercadopago.access_token'));
      $preferenceFactory = new PreferenceClient();

      $items = [];
      foreach ($cart as $item) {
        $items[] = [
          'title' => $item['name'],
          'quantity' => (int) $item['quantity'],
          'unit_price' => (float) $item['price'],
        ];
      }

      $preference = $preferenceFactory->create([
        'items' => $items,
        'external_reference' => (string) $order->id, // ¡Vincula el pago con la orden!
        'back_urls' => [
          // 'success' => route('orders.mp.success'),
          'success' => 'https://uncarted-ernest-disingenuous.ngrok-free.dev/mp/success',

          'failure' => route('orders.mp.failure'),
          'pending' => route('orders.mp.pending'),
        ],
        'auto_return' => 'approved',
      ]);

      // Limpiar el carrito (la orden ya está creada)
      session(['cart' => []]);

      return view('cart.checkout', [
        'cart' => $cart,
        'products' => $products,
        'total' => $total,
        'user' => $user,
        'order' => $order,
        'preference' => $preference,
        'MPPublickey' => config('mercadopago.public_key'),
      ]);

    } catch (\MercadoPago\Exceptions\MPApiException $th) {
      Log::error('Error de Mercado Pago', ['error' => $th->getMessage()]);
      return to_route('cart.index')
        ->with('feedback.message', 'Error al conectar con Mercado Pago. Intenta nuevamente.')
        ->with('feedback.type', 'danger');
    } catch (\Throwable $th) {
      throw $th;
    }
  }
  

  /**
   * Procesar el checkout y crear la orden.
   */
  public function store(Request $request)
  {
    $cart = session('cart', []);

    if (empty($cart)) {
      return to_route('cart.index')
        ->with('feedback.message', 'El carrito está vacío.')
        ->with('feedback.type', 'warning');
    }

    $user = Auth::user();

    try {
      // Usar transacción para asegurar atomicidad
      $order = DB::transaction(function () use ($cart, $user) {
        // Obtener productos del carrito para validar stock
        $productIds = array_keys($cart);
        $products = Product::whereIn('id', $productIds)
          ->lockForUpdate() // Bloquear registros para evitar condiciones de carrera
          ->get()
          ->keyBy('id');

        // Validar stock antes de procesar
        foreach ($cart as $productId => $item) {
          $product = $products->get($productId);

          if (!$product) {
            throw new \Exception("El producto con ID {$productId} ya no existe.");
          }

          if (!$product->is_active) {
            throw new \Exception("El producto '{$product->name}' no está disponible.");
          }

          if ($product->stock < $item['quantity']) {
            throw new \Exception(
              "No hay suficiente stock del producto '{$product->name}'. " .
              "Stock disponible: {$product->stock}, solicitado: {$item['quantity']}."
            );
          }
        }

        // Calcular total
        $total = 0;
        foreach ($cart as $item) {
          $total += $item['price'] * $item['quantity'];
        }

        // Crear la orden
        $order = Order::create([
          'user_id' => $user->id,
          'total_amount' => $total,
        ]);

        // Crear los items de la orden y actualizar stock
        foreach ($cart as $productId => $item) {
          $product = $products->get($productId);

          // Crear OrderItem con precio histórico
          OrderItem::create([
            'order_id' => $order->id,
            'product_id' => $productId,
            'quantity' => $item['quantity'],
            'price' => $item['price'], // Precio al momento de la compra
          ]);

          // Reducir stock del producto
          $product->decrement('stock', $item['quantity']);
        }

        // Limpiar el carrito solo si todo fue exitoso
        session(['cart' => []]);

        return $order;
      });

      return to_route('orders.show', ['order' => $order->id])
        ->with('feedback.message', '¡Compra realizada exitosamente!')
        ->with('feedback.type', 'success');

    } catch (\Exception $e) {
      return back()
        ->withInput()
        ->with('feedback.message', 'Error al procesar la compra: ' . $e->getMessage())
        ->with('feedback.type', 'danger');
    }
  }

  /**
   * Mostrar historial de órdenes del usuario autenticado.
   */
  public function index()
  {
    $orders = Order::where('user_id', Auth::id())
      ->with(['orderItems.product']) // Eager loading para evitar N+1 queries
      ->orderBy('created_at', 'desc')
      ->paginate(10);

    return view('orders.index', [
      'orders' => $orders,
    ]);
  }

  /**
   * Mostrar detalles de una orden específica.
   */
  public function show(Order $order)
  {
    // Verificar que la orden pertenezca al usuario autenticado
    if ($order->user_id !== Auth::id()) {
      abort(403, 'No tienes permiso para ver esta orden.');
    }

    // Cargar relaciones con eager loading
    $order->load(['orderItems.product', 'user']);

    return view('orders.show', [
      'order' => $order,
    ]);
  }

  /**
   * Webhook de Mercado Pago - Recibe notificaciones de pagos
   */
  public function verifyPayment(Request $request)
  {
    // Siempre devolver 200 para que MP no reintente
    // La validación de firma ya se hizo en el middleware

    // Verificar si la firma fue válida
    if (!$request->boolean('payment-successfuly')) {
      Log::warning('Webhook MP: Firma inválida', $request->all());
      return response()->json(['status' => 'invalid signature'], 200);
    }

    // Obtener el ID del pago
    $paymentId = $request->input('data.id');
    
    try {

      MercadoPagoConfig::setAccessToken(config('mercadopago.access_token'));
      $paymentClient = new \MercadoPago\Client\Payment\PaymentClient();
      $payment = $paymentClient->get($paymentId);

      $orderId = $payment->external_reference;

      $order = Order::find($orderId);
      
      if (!$order) {
        Log::error('Webhook MP: Orden no encontrada', ['order_id' => $orderId, 'payment_id' => $paymentId]);
        return response()->json(['status' => 'order not found'], 200);
      }

      // Mapear estado de MP a nuestro estado
      $mpStatus = $payment->status;
      $newStatus = match($mpStatus) {
        'approved' => 'paid',
        'pending', 'in_process', 'authorized' => 'pending',
        'rejected', 'cancelled', 'refunded', 'charged_back' => 'failed',
        default => 'pending',
      };

      $order->update([
        'status' => $newStatus,
        'payment_id' => (string) $paymentId,
      ]);

      Log::info('Orden actualizada');

      // Si el pago falló, devolver el stock
      if ($newStatus === 'failed' && $order->status !== 'failed') {
        foreach ($order->orderItems as $item) {
          $item->product->increment('stock', $item->quantity);
        }
      }

      return response()->json(['status' => 'ok'], 200);

    } catch (\Exception $e) {
      Log::error('Webhook MP: Error al procesar', [
        'payment_id' => $paymentId,
        'error' => $e->getMessage(),
      ]);
      return response()->json(['status' => 'error'], 200);
    }
  }


  /**
   * Callback de Mercado Pago - Pago exitoso
   * El usuario es redirigido aquí después de pagar
   */
  public function mpSuccess(Request $request)
  {
    $externalReference = $request->input('external_reference');
    $paymentId = $request->input('payment_id');
    
    // Buscar la orden
    $order = Order::where('id', $externalReference)
      ->where('user_id', Auth::id())
      ->first();

    if ($order) {
      if ($order->status === 'pending' && $paymentId) {
        $order->update([
          'status' => 'paid',
          'payment_id' => $paymentId,
        ]);
      }

      return to_route('orders.show', ['order' => $order->id])
        ->with('feedback.message', '¡Pago realizado con éxito! Gracias por tu compra.')
        ->with('feedback.type', 'success');
    }

    return to_route('orders.index')
      ->with('feedback.message', '¡Pago realizado con éxito!')
      ->with('feedback.type', 'success');
  }

  /**
   * Callback de Mercado Pago - Pago fallido
   */
  public function mpFailure(Request $request)
  {
    $externalReference = $request->input('external_reference');
    
    $order = Order::where('id', $externalReference)
      ->where('user_id', Auth::id())
      ->first();

    if ($order && $order->status === 'pending') {

      foreach ($order->orderItems as $item) {
        $item->product->increment('stock', $item->quantity);
      }
      
      $order->update(['status' => 'failed']);
    }

    return to_route('cart.index')
      ->with('feedback.message', 'El pago no pudo ser procesado. Por favor, intenta nuevamente.')
      ->with('feedback.type', 'danger');
  }

  /**
   * Callback de Mercado Pago - Pago pendiente
   */
  public function mpPending(Request $request)
  {
    $externalReference = $request->input('external_reference');
    
    $order = Order::where('id', $externalReference)
      ->where('user_id', Auth::id())
      ->first();

    if ($order) {
      return to_route('orders.show', ['order' => $order->id])
        ->with('feedback.message', 'Tu pago está pendiente de confirmación. Te notificaremos cuando se acredite.')
        ->with('feedback.type', 'warning');
    }

    return to_route('orders.index')
      ->with('feedback.message', 'Tu pago está pendiente de confirmación.')
      ->with('feedback.type', 'warning');
  }
}

