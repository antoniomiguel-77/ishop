<?php

namespace App\Livewire\Pages\Admin;

use App\Repositories\User\UserRepository;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

class User extends Component
{

    use WithPagination;
    public $name, $email, $type = 'manager', $user_id, $password, $search;

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.pages.admin.user', [
            'users' => $this->getUsers($this->search)
        ]);
    }


    public function clearField()
    {
         $this->reset(['name', 'user_id','email']);
    }


    /**Validaçoes */
    public function rules()
    {
        return (new \App\Http\Requests\UserRequest([
            'name' => $this->name,
            'email' => $this->email,
            'user_id' => $this->user_id,
        ]))->rules();
    }

    /**Mensagens Personalizadas */
    public function messages()
    {
        return (new \App\Http\Requests\UserRequest())->messages();
    }

    /** Carregar utilizadores */
    public function getUsers($search)
    {
        try {

            return  UserRepository::search([
                'search' => $search,
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

    /**salvar ou actualizar dados de utilizadores */
    public function saveUser()
    {


        $this->validate();

        try {

            $data = [
                'user_id' => $this->user_id,
                'name' => $this->name,
                'email' => $this->email,
                'company_id' => auth()->user()->company_id ?? null,
                'type' => $this->type
            ];




            if ($this->user_id == null) {
                $this->password = \App\Services\PasswordGeneratorService::generate(6);
                $data[] = [
                    'password' => $this->password,
                ];
            }

            $user = UserRepository::store($data);


            if ($this->user_id != null) {
                $this->dispatch('closeModalUser');
            }



            if ($user && $this->user_id != null) {
                LivewireAlert::html('Operação realizada com sucesso.')
                    ->success()
                    ->toast()
                    ->position('top-end')
                    ->show();
                $this->reset(['name', 'email']);
            }

            if ($user && $this->user_id == null) {

                LivewireAlert::html(
                    'Operação realizada com sucesso.<br>
                    O utilizador:' . $this->name . ' foi criado
                    <br><strong>Palavra-passe: ' . $this->password . '</strong><br>
                    O utilizador deve alterar a sua senha no primeiro acesso a conta
                    '
                )
                    ->success()
                    ->toast(false)
                    ->position('center')
                    ->timer(false)
                    ->withConfirmButton('Compreendo')
                    ->withOptions([
                        'allowOutsideClick' => false,
                    ])
                    ->show();


                $this->reset(['name', 'user_id','email']);
            }
        } catch (\Exception $th) {
            dd($th->getMessage());
            LivewireAlert::text('Falha ao realizar a operação. Por favor, tente novamente.')
                ->error()
                ->toast()
                ->position('top-end')
                ->show();
        }
    }


    /**Editar utilizador */
    public function edit($user_id)
    {


        try {
            $user = UserRepository::edit($user_id);
            $this->user_id = $user->id;
            $this->name = $user->name;
            $this->email = $user->email;
        } catch (\Throwable $th) {
            LivewireAlert::text('Falha ao carregar os dados do cliente.')
                ->error()
                ->toast()
                ->position('top-end')
                ->show();
        }
    }

    /**Confirmar antes de excluir */
    public function confirm($user_id)
    {
        $this->user_id = $user_id;
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

    /**Excluir utilizadores */
    public function destroy()
    {
        try {

            $category = UserRepository::destroy($this->user_id);
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
