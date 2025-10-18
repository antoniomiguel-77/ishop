<?php

namespace App\Livewire\Pages\Site;

use App\Repositories\Category\CategoryRepository;
use App\Repositories\Product\ProductRepository;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;
use Livewire\Component;

class Product extends Component
{
    public $search,$category;
    public function render()
    {
        return view('livewire.pages.site.product',[
            'products'=>$this->getProducts($this->search,$this->category),
            'categories'=>$this->getCategpories()
        ]);
    }



    /** Listar produtos */
    public function getProducts(?string $search,?int $category = null)
    {
        try {
            // if($category == null) {
            //     dd($this->category);
            // }
          return  ProductRepository::search(
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
}
