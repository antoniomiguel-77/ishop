<?php

namespace App\Livewire\Pages\Site;

use App\Models\Gallery;
use App\Repositories\Category\CategoryRepository;
use App\Repositories\Product\ProductRepository;
use App\Services\CartService;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;
use Livewire\Attributes\On;
use Livewire\Component;

class Product extends Component
{
    public $search, $category, $detail = [],$qtd = 1;
    public function render()
    {
        return view('livewire.pages.site.product', [
            'products' => $this->getProducts($this->search, $this->category),
            'categories' => $this->getCategpories()
        ]);
    }



    /** Listar produtos */
    public function getProducts(?string $search, ?int $category = null)
    {
        try {

            return ProductRepository::search(
                $this->search,
                12,
                $this->category,
                false,
                false
            );
        } catch (\Throwable $th) {
            LivewireAlert::text('Falha ao realizar a operação. Por favor, tente novamente.')
                ->error()
                ->toast()
                ->position('top-end')
                ->show();

            return collect();
        }
    }

    /** Listar categorias */
    public function getCategpories()
    {
        try {
            return CategoryRepository::search(null);
        } catch (\Throwable $th) {
            LivewireAlert::text('Falha ao realizar a operação. Por favor, tente novamente.')
                ->error()
                ->toast()
                ->position('top-end')
                ->show();

            return collect();
        }
    }


    /**
     * Summary of getMainImage
     * @param mixed $product
     */
    public function getMainImage($product)
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

    /**
     * Summary of getDetail
     * @param mixed $product
     * @return void
     */
    public function getDetail($product)
    {
        
        $this->detail = [];
        try {
            $this->detail = ProductRepository::getDetail($product);
        } catch (\Throwable $th) {
            LivewireAlert::text('Falha ao realizar a operação. Por favor, tente novamente.')
                ->error()
                ->toast()
                ->position('top-end')
                ->show();

        }

    }


    public function addToCar($product)
    {
        try {
            $add =  CartService::addToCart($product,$this->qtd);
             LivewireAlert::text($add)
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


}
