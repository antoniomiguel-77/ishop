<?php

namespace App\Livewire\Pages\Admin;

use Livewire\Attributes\Layout;
use Livewire\Component;

class User extends Component
{

    public $name,$email,$role,$isEditing;
    
    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.pages.admin.user',[
            'users'=>$this->loadUsers()
        ]);
    }


    /** Carregar utilizadores */
    public function loadUsers()
    {
        try {
           return [];
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
