<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
  /**
   * Mostrar el carrito de compras.
   */
  public function index()
  {
    $cart = session('cart', []);
    $total = $this->calculateTotal($cart);

    return view('cart.index', [
      'cart' => $cart,
      'total' => $total,
    ]);
  }

  /**
   * Agregar un producto al carrito.
   */
  public function add(Request $request)
  {
    $validated = $request->validate([
      'product_id' => 'required|exists:products,id',
      'quantity' => 'required|integer|min:1',
    ], [
      'product_id.required' => 'El producto es obligatorio.',
      'product_id.exists' => 'El producto seleccionado no existe.',
      'quantity.required' => 'La cantidad es obligatoria.',
      'quantity.integer' => 'La cantidad debe ser un número entero.',
      'quantity.min' => 'La cantidad debe ser al menos 1.',
    ]);

    $product = Product::findOrFail($validated['product_id']);

    // Verificar que el producto esté activo y tenga stock
    if (!$product->is_active) {
      return back()
        ->with('feedback.message', 'Este producto no está disponible.')
        ->with('feedback.type', 'warning');
    }

    if ($product->stock < $validated['quantity']) {
      return back()
        ->with('feedback.message', 'No hay suficiente stock disponible.')
        ->with('feedback.type', 'warning');
    }

    // Obtener el carrito actual de la sesión
    $cart = session('cart', []);

    // Si el producto ya está en el carrito, actualizar la cantidad
    if (isset($cart[$product->id])) {
      $cart[$product->id]['quantity'] += $validated['quantity'];
      
      // Verificar que no exceda el stock disponible
      if ($cart[$product->id]['quantity'] > $product->stock) {
        return back()
          ->with('feedback.message', 'La cantidad excede el stock disponible.')
          ->with('feedback.type', 'warning');
      }
    } else {
      // Agregar nuevo producto al carrito
      $cart[$product->id] = [
        'product_id' => $product->id,
        'name' => $product->name ?? $product->title,
        'image_url' => $product->image_url,
        'price' => $product->price,
        'quantity' => $validated['quantity'],
      ];
    }

    // Guardar el carrito actualizado en la sesión
    session(['cart' => $cart]);

    // Si el request tiene 'buy_now', redirigir al checkout (requiere autenticación)
    if ($request->has('buy_now') && $request->boolean('buy_now')) {
      if (!Auth::check()) {
        return to_route('auth.login.show')
          ->with('feedback.message', 'Por favor, inicia sesión para continuar con la compra.')
          ->with('feedback.type', 'info');
      }
      return to_route('checkout')
        ->with('feedback.message', 'Producto agregado al carrito.')
        ->with('feedback.type', 'success');
    }

    return back()
      ->with('feedback.message', 'Producto agregado al carrito.')
      ->with('feedback.type', 'success');
  }

  /**
   * Eliminar un producto del carrito.
   */
  public function remove(Request $request, $productId)
  {
    $cart = session('cart', []);

    if (isset($cart[$productId])) {
      unset($cart[$productId]);
      session(['cart' => $cart]);

      return to_route('cart.index')
        ->with('feedback.message', 'Producto eliminado del carrito.')
        ->with('feedback.type', 'success');
    }

    return to_route('cart.index')
      ->with('feedback.message', 'El producto no estaba en el carrito.')
      ->with('feedback.type', 'warning');
  }

  /**
   * Actualizar las cantidades de productos en el carrito.
   */
  public function update(Request $request)
  {
    $validated = $request->validate([
      'items' => 'required|array',
      'items.*' => 'required|integer|min:1',
    ], [
      'items.required' => 'Debe proporcionar los items a actualizar.',
      'items.array' => 'Los items deben ser un arreglo.',
      'items.*.required' => 'La cantidad es obligatoria.',
      'items.*.integer' => 'La cantidad debe ser un número entero.',
      'items.*.min' => 'La cantidad debe ser al menos 1.',
    ]);

    $cart = session('cart', []);

    foreach ($validated['items'] as $productId => $quantity) {
      if (isset($cart[$productId])) {
        // Obtener el producto para validar stock
        $product = Product::find($productId);
        
        if ($product && $quantity > $product->stock) {
          return back()
            ->withInput()
            ->with('feedback.message', "El producto '{$product->name}' no tiene suficiente stock.")
            ->with('feedback.type', 'warning');
        }

        $cart[$productId]['quantity'] = $quantity;
      }
    }

    session(['cart' => $cart]);

    return to_route('cart.index')
      ->with('feedback.message', 'Carrito actualizado correctamente.')
      ->with('feedback.type', 'success');
  }

  /**
   * Vaciar completamente el carrito.
   */
  public function clear()
  {
    session(['cart' => []]);

    return to_route('cart.index')
      ->with('feedback.message', 'Carrito vaciado correctamente.')
      ->with('feedback.type', 'success');
  }

  /**
   * Calcular el total del carrito.
   *
   * @param array $cart
   * @return float
   */
  private function calculateTotal(array $cart): float
  {
    $total = 0;

    foreach ($cart as $item) {
      $total += $item['price'] * $item['quantity'];
    }

    return $total;
  }
}

