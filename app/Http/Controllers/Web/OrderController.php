<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
  /**
   * Mostrar formulario de checkout.
   */
  public function checkout()
  {
    $cart = session('cart', []);

    if (empty($cart)) {
      return to_route('cart.index')
        ->with('feedback.message', 'El carrito está vacío.')
        ->with('feedback.type', 'warning');
    }

    // Calcular total
    $total = 0;
    foreach ($cart as $item) {
      $total += $item['price'] * $item['quantity'];
    }

    // Obtener información completa de los productos para validar stock
    $productIds = array_keys($cart);
    $products = Product::whereIn('id', $productIds)->get()->keyBy('id');

    return view('cart.checkout', [
      'cart' => $cart,
      'products' => $products,
      'total' => $total,
      'user' => Auth::user(),
    ]);
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
}

