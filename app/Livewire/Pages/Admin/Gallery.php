<?php

namespace App\Livewire\Pages\Admin;

use App\Repositories\Gallery\GalleryRepository;
use Livewire\Component;
use Livewire\WithFileUploads;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;
use Livewire\Attributes\On;

class Gallery extends Component
{
    use WithFileUploads;

    public $images = [], $existingImages = [], $uploadProgress = 0, $gallery_id, $product_id;

    public function mount()
    {
        $this->existingImages = GalleryRepository::search();
    }

    /**Validaçoes */
    public function rules()
    {
        return (new \App\Http\Requests\GalleryRequest())->rules();
    }

    /**Mensagens Personalizadas */
    public function messages()
    {
        return (new \App\Http\Requests\GalleryRequest())->messages();
    }

    public function uploadImages()
    {


        try {
            foreach ($this->images as $key => $image) {
                $path = $image->store('uploads', 'public');

                $data = [
                    'image' => '/storage/' . $path,
                    'is_main_image' => false,
                    'product_id' => $this->product_id,
                    'company_id' => auth()->user()->company_id
                ];

                GalleryRepository::store($data);
            }

            $this->reset('images');
            $this->existingImages = GalleryRepository::search();

            LivewireAlert::text('Upload realizado com sucesso!')
                ->success()
                ->toast()
                ->position('top-end')
                ->show();
        } catch (\Throwable $th) {
            LivewireAlert::text('Falha ao realizar a operação. Por favor, tente novamente.')
                ->error()
                ->toast()
                ->position('top-end')
                ->show();
        }
    }

    public function toggleMainImage($id)
    {
        try {
            $this->existingImages = [];
            $isSeted = GalleryRepository::toggleMain($id);

            if ($isSeted) {
                LivewireAlert::text('Operação realizada com sucesso!')
                    ->success()
                    ->toast()
                    ->position('top-end')
                    ->show();

                $this->existingImages = GalleryRepository::search();
                $this->dispatch('updatedCheck',['id' => $id]);
            }
        } catch (\Throwable $th) {
            LivewireAlert::text('Falha ao realizar a operação. Por favor, tente novamente.')
                ->error()
                ->toast()
                ->position('top-end')
                ->show();
        }
    }

    /**Confirmar antes de excluir */
    public function confirmDelete($gallery_id)
    {
        $this->gallery_id = $gallery_id;
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

    #[On('destroy')]
    public function destroy()
    {

        try {
            $isDeleted = GalleryRepository::destroy($this->gallery_id);

            if ($isDeleted) {
                LivewireAlert::text('Operação realizada com sucesso!')
                    ->success()
                    ->toast()
                    ->position('top-end')
                    ->show();
                $this->mount();
                $this->existingImages = GalleryRepository::search();
            }
        } catch (\Throwable $th) {
            LivewireAlert::text('Falha ao realizar a operação. Por favor, tente novamente.')
                ->error()
                ->toast()
                ->position('top-end')
                ->show();
        }
    }

    public function render()
    {
        return view('livewire.pages.admin.gallery');
    }

    #[On('productSeted')]
    public function productSeted($product)
    {
        $this->product_id = $product;
    }
}
