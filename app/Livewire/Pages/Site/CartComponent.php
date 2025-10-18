<?php

namespace App\Livewire\Pages\Site;

use App\Repositories\Product\ProductRepository;
use App\Services\CartService;
use Darryldecode\Cart\Facades\CartFacade as Cart;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;
use Livewire\Attributes\On;
use Livewire\Component;

class CartComponent extends Component
{
    public $cartItems = [], $qtd = [],$subtotal = [];
    public function render()
    {
        $total = Cart::getTotal();
        return view('livewire.pages.site.cart-component', compact('total'));
    }

 





    #[On('updateCounterItem')]
    public function mount()
    {
        try {
            $this->cartItems = CartService::getCartItems();

            foreach ($this->cartItems as $cartItem) {
                $this->qtd[$cartItem->id] = $cartItem->quantity;
                $this->subtotal[$cartItem->id] = $cartItem->price * $cartItem->quantity;
            }
        } catch (\Throwable $th) {
            LivewireAlert::text('Falha ao realizar a operação. Por favor, tente novamente.')
                ->error()
                ->toast()
                ->position('top-end')
                ->show();
        }
    }


    /**
     * Summary of getMainImage
     * @param mixed $product
     */
    public function getMainImage(int $product)
    {
        try {
            return ProductRepository::getMainImage($product);
        } catch (\Throwable $th) {
            LivewireAlert::text('Falha ao realizar a operação. Por favor, tente novamente.')
                ->error()
                ->toast()
                ->position('top-end')
                ->show();

        }

    }


    public function removeItem(int $product)
    {
        try {
            CartService::removeItem($product);
            $this->mount();
            LivewireAlert::text('Item Removido com sucesso.')
                ->success()
                ->toast()
                ->position('top-end')
                ->show();
            $this->dispatch('updateCounterItem');
        } catch (\Throwable $th) {
            LivewireAlert::text('Falha ao realizar a operação. Por favor, tente novamente.')
                ->error()
                ->toast()
                ->position('top-end')
                ->show();

        }

    }

    public function updateQuantity(int $product, int $qtd)
    {
        try {

            CartService::updateQuantity($product, $qtd);
            $this->mount();
        } catch (\Throwable $th) {
            LivewireAlert::text('Falha ao realizar a operação. Por favor, tente novamente.')
                ->error()
                ->toast()
                ->position('top-end')
                ->show();

        }

    }


     public function checkout()
    {
        try {

         
        } catch (\Throwable $th) {
            LivewireAlert::text('Falha ao realizar a operação. Por favor, tente novamente.')
                ->error()
                ->toast()
                ->position('top-end')
                ->show();

        }

    }

    
}
