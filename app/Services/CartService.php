<?php
namespace App\Services;
use App\Repositories\Product\ProductRepository;
use Darryldecode\Cart\Facades\CartFacade as Cart;
use Illuminate\Support\Facades\Log;

class CartService
{



    public static function addToCart(int $product, ?int $qtd = 1)
    {
        try {

            $product = ProductRepository::edit($product);

            if ($product->quantity <= 0) {
                return "Quantidade Insuficiente.";
            }

            Cart::add([
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => $qtd,
                'attributes' => array(),
            ]);

            return 'Produto ' . $product->name . ', Adicionado no carrinho.';

        } catch (\Throwable $th) {
            Log::error('Error', [
                'message' => $th->getMessage(),
                'line' => $th->getLine(),
                'file' => $th->getFile(),
            ]);
        }
    }


    public static function getCartItems()
    {
        try {

            return Cart::getContent();
        } catch (\Throwable $th) {
            Log::error('Error', [
                'message' => $th->getMessage(),
                'line' => $th->getLine(),
                'file' => $th->getFile(),
            ]);
        }
    }

    public static function removeItem(int $product)
    {
        try {

            return Cart::remove($product);
        } catch (\Throwable $th) {
            Log::error('Error', [
                'message' => $th->getMessage(),
                'line' => $th->getLine(),
                'file' => $th->getFile(),
            ]);
        }
    }


    public static function updateQuantity(int $product, int $qtd)
    {
        try {

             Cart::remove($product);
             self::addToCart($product,$qtd);
        } catch (\Throwable $th) {
            Log::error('Error', [
                'message' => $th->getMessage(),
                'line' => $th->getLine(),
                'file' => $th->getFile(),
            ]);
        }
    }
}