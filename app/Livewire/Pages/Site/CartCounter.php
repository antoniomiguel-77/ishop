<?php

namespace App\Livewire\Pages\Site;

use Darryldecode\Cart\Facades\CartFacade as Cart;
use Livewire\Attributes\On;
use Livewire\Component;

class CartCounter extends Component
{
    public function render()
    {
        return view('livewire.pages.site.cart-counter');
    }

    #[On('updateCounterItem')]
    public function getCounterProperty()
    {
      return  Cart::getContent()->count();
    }
}
