<?php

namespace App\Livewire\Pages\Admin;

use Livewire\Component;
use App\Repositories\Category\CategoryRepository;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;


class Category extends Component
{
    public $category_id, $name, $perPage, $search;


    public function mount()
    {
        $this->reset(['name', 'category_id']);
        $this->search = '';
        $this->perPage = 10;
    }

    /**Validaçoes */
    public function rules()
    {
        return (new \App\Http\Requests\CategoryRequest([
            'name' => $this->name,
            'category_id' => $this->category_id, // necessário para ignorar na validação
        ]))->rules();
    }

    /**Mensagens Personalizadas */
    public function messages()
    {
        return (new \App\Http\Requests\CategoryRequest())->messages();
    }

    public function render()
    {
        return view('livewire.pages.admin.category', [
            'categories' => $this->getCategory($this->search)
        ]);
    }

    /**salvar ou actualizar dados de catgoria */
    public function saveCategory()
    {

        $this->validate();

        try {

            $data = [
                'category_id' => $this->category_id,
                'name' => $this->name,
                'company_id' => auth()->user()->company_id ?? null,
                'user_id' => auth()->user()->id ?? null,
            ];

            $category = CategoryRepository::store($data);


            if ($this->category_id != null) {
                $this->dispatch('closeModalCategory');
            }

            $this->dispatch("setCategory", $category->id);


            if ($category) {
                LivewireAlert::text('Operação realizada com sucesso.')
                    ->success()
                    ->toast()
                    ->position('top-end')
                    ->show();
                $this->reset(['name','category_id']);
            }
        } catch (\Exception $th) {
            LivewireAlert::text('Falha ao realizar a operação. Por favor, tente novamente.')
                ->error()
                ->toast()
                ->position('top-end')
                ->show();
        }
    }

    /**Pesquisar categoria */
    public function getCategory($search = null)
    {

        try {

            return  CategoryRepository::search([
                'search' => $search,
            ]);
        } catch (\Throwable $th) {

            LivewireAlert::text('Falha ao realizar a operação. Por favor, tente novamente.')
                ->error()
                ->toast()
                ->position('top-end')
                ->show();
        }
    }

    /**Editar categoria */
    public function edit($category_id)
    {


        try {
            $category = CategoryRepository::edit($category_id);
            $this->category_id = $category->id;
            $this->name = $category->name;
        } catch (\Throwable $th) {
            LivewireAlert::text('Falha ao carregar os dados do cliente.')
                ->error()
                ->toast()
                ->position('top-end')
                ->show();
        }
    }

    /**Confirmar antes de excluir */
    public function confirm($category_id)
    {
        $this->category_id = $category_id;
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

    /**Excluir cliente */
    public function destroy()
    {
        try {

            $category = CategoryRepository::destroy($this->category_id);
            if ($category) {
                LivewireAlert::text('Cliente excluído com sucesso.')
                    ->success()
                    ->toast()
                    ->position('top-end')
                    ->show();
            }
        } catch (\Throwable $th) {
            LivewireAlert::text('Falha ao excluir o cliente. Por favor, tente novamente.')
                ->error()
                ->toast()
                ->position('top-end')
                ->show();
        }
    }
}
