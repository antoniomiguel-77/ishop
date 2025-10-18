<?php

namespace App\Livewire\Pages\Site;

use App\Models\Gallery;
use App\Repositories\Category\CategoryRepository;
use App\Repositories\Product\ProductRepository;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;
use Livewire\Attributes\On;
use Livewire\Component;

class Product extends Component
{
    public $search, $category, $detail = [];
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

    #[On('productSeted')]
    public function productSeted($product)
    {
        $this->product_id = $product;
        $this->existingImages = GalleryRepository::search($this->product_id);
    }


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
}
