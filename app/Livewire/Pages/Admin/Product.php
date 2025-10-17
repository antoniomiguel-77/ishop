<?php

namespace App\Livewire\Pages\Admin;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;
use App\Repositories\Product\ProductRepository;
use App\Repositories\Category\CategoryRepository;
use Illuminate\Support\Facades\{DB,Log};
use Livewire\Attributes\On;
use Livewire\WithPagination;

class Product extends Component
{
    use WithPagination;
    public $product_id, $subcategory_id, $category_id, $searchCategory, $searchSubcategory;
    public $categories = [];
    public $name, $price, $type = 'unit', $tax = 0, $reason_id, $perPage = 5, $search;





    public function clearField()
    {
        if ((float)auth()->user()->company->tax > 0) {
            $this->tax = (float)auth()->user()->company->tax;
            $this->reset(
                [
                    'product_id',
                    'name',
                    'price',
                    'type',
                    'reason_id',
                    'category_id',
                    'subcategory_id',
                ]
            );

            return;
        }

        $this->reset(
            [
                'product_id',
                'name',
                'price',
                'type',
                'tax',
                'reason_id',
                'category_id',
                'subcategory_id',
            ]
        );
    }


    /**Validaçoes */
    public function rules()
    {
        return (new \App\Http\Requests\ProductRequest([
            'name' => $this->name,
            'product_id' => $this->product_id
        ]))->rules();
    }

    /**Mensagens Personalizadas */
    public function messages()
    {
        return (new \App\Http\Requests\ProductRequest())->messages();
    }


    public function mount()
    {

        $this->categories = $this->getcategories($this->searchCategory);

        if ((float)auth()->user()->company->tax > 0) {
            $this->tax = (float)auth()->user()->company->tax;
        }
    }




    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.pages.admin.product', [
            'products' => $this->getProducts(),
            'taxReasons' => $this->getTaxReasons(),

        ]);
    }

    /**get TaxReason */
    public function getTaxReasons()
    {
        try {
            return ProductRepository::getTaxReasons();
        } catch (\Exception $e) {
            LivewireAlert::text('Falha ao carregar os dados do Produto.')
                ->error()
                ->toast()
                ->position('top-end')
                ->show();

            return [];
        }
    }

    /**get Categories */

    public function getcategories($search)
    {
        try {
            return CategoryRepository::search([]);
        } catch (\Exception $e) {
            LivewireAlert::text('Falha ao carregar os dados do Produto.')
                ->error()
                ->toast()
                ->position(position: 'top-end')
                ->show();

            return [];
        }
    }



    /**Setar Categoria quando for adicionada */
    #[On('setCategory')]
    public function setCategory($category)
    {

        $this->mount();
        $this->category_id = (string) $category;
    }



    /**Pesquisar Produto */
    public function getProducts()
    {

        try {

            return  ProductRepository::search([
                'search' => $this->search,
                'perPage' => $this->perPage,
            ]);

     
            
        } catch (\Throwable $th) {
            LivewireAlert::text('Falha ao realizar a operação. Por favor, tente novamente.')
                ->error()
                ->toast()
                ->position('top-end')
                ->show();

                return [];
        }
    }

    /**salvar ou actualizar dados del Produto */
    public function saveProd()
    {
        DB::beginTransaction();
        $this->validate();

        try {


            $data = [
                'product_id' => $this->product_id,
                'name' => $this->name,
                'reason_id' => ((int)$this->reason_id > 0) ? (int)$this->reason_id : null,
                'price' => $this->price,
                'type' => $this->type,
                'tax' => $this->tax,
                'category_id' => $this->category_id,
                'subcategory_id' => $this->subcategory_id,
                'company_id' => auth()->user()?->company_id ?? null,
                'user_id' => auth()->user()?->id ?? null,
            ];







            $product = ProductRepository::store($data);

            if ($this->product_id != null) {
                $this->dispatch('closeModal');
                Log::info('name', [$product]);
            }

            if ($product) {
                LivewireAlert::text('Operação realizada com sucesso.')
                    ->success()
                    ->toast()
                    ->position('top-end')
                    ->show();


                $this->dispatch('resetSelect2');
            }
            $this->clearField();
            DB::commit();
        } catch (\Exception $th) {
            DB::rollback();
            LivewireAlert::text('Falha ao realizar a operação. Por favor, tente novamente.')
                ->error()
                ->toast()
                ->position('top-end')
                ->show();
        }
    }



    /**Editar Produto */
    public function edit($product_id)
    {
        try {



            $product = ProductRepository::edit($product_id);

            $this->product_id = $product->id;
            $this->name = $product->name;
            $this->price = $product->price;
            $this->type = $product->type;
            $this->tax = $product->tax;
            $this->reason_id = $product->reason_id;
            $this->category_id = $product->category_id;
            $this->subcategory_id = $product->subcategory_id;
            $this->dispatch('editProd', $this->category_id, $this->subcategory_id);
        } catch (\Throwable $th) {
            LivewireAlert::text('Falha ao carregar os dados do Produto.')
                ->error()
                ->toast()
                ->position('top-end')
                ->show();
        }
    }

    /**Confirmar antes de excluir */
    public function confirm($product_id)
    {
        $this->product_id = $product_id;
        LivewireAlert::title('confirmação')
            ->text('Deseja prosseguir com esta ação? Esta ação não pode ser desfeita.')
            ->position('center')
            ->withConfirmButton()
            ->confirmButtonText('Excluir')
            ->confirmButtonColor('#059669')
            ->withCancelButton()
            ->cancelButtonColor('#dc2626')
            ->cancelButtonText('Cancelar')
            ->question()
            ->onConfirm('destroy')
            ->show();
    }

    /**Excluir Produto */
    public function destroy()
    {
        try {

            $product = ProductRepository::destroy($this->product_id);
            if ($product) {
                LivewireAlert::text('Produto excluído com sucesso.')
                    ->success()
                    ->toast()
                    ->position('top-end')
                    ->show();
            }
        } catch (\Throwable $th) {
            LivewireAlert::text('Falha ao excluir o Produto. Por favor, tente novamente.')
                ->error()
                ->toast()
                ->position('top-end')
                ->show();
        }
    }
}
