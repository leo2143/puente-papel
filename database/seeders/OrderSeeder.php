<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;

class OrderSeeder extends Seeder
{

    public function run(): void
    {
        $user = User::where('email', 'leitoorellana58@gmail.com')->first();
        
        $products = Product::all();
        
        if ($user && $products->count() > 0) {
            $orders = [
                [
                    'user_id' => $user->id,
                    'status' => 'paid',
                    'payment_id' => '71528493021',
                    'items' => [
                        ['product_index' => 0, 'quantity' => 2],
                        ['product_index' => 1, 'quantity' => 1], 
                    ],
                ],
                [
                    'user_id' => $user->id,
                    'status' => 'paid',
                    'payment_id' => '71528493022',
                    'items' => [
                        ['product_index' => 2, 'quantity' => 1], 
                        ['product_index' => 3, 'quantity' => 3], 
                        ['product_index' => 4, 'quantity' => 1], 
                    ],
                ],
                [
                    'user_id' => $user->id,
                    'status' => 'pending',
                    'payment_id' => null,
                    'items' => [
                        ['product_index' => 5, 'quantity' => 1],
                    ],
                ],
            ];

            foreach ($orders as $orderData) {
                $totalAmount = 0;
                
                $order = Order::create([
                    'user_id' => $orderData['user_id'],
                    'total_amount' => 0,
                    'status' => $orderData['status'],
                    'payment_id' => $orderData['payment_id'],
                ]);

                foreach ($orderData['items'] as $itemData) {
                    $product = $products[$itemData['product_index']];
                    $quantity = $itemData['quantity'];
                    $price = $product->price;

                    OrderItem::create([
                        'order_id' => $order->id,
                        'product_id' => $product->id,
                        'quantity' => $quantity,
                        'price' => $price,
                    ]);

                    $totalAmount += $price * $quantity;
                }

                $order->update(['total_amount' => $totalAmount]);
            }
        }
    }
}

