<?php

namespace App\Livewire\Pages\Admin;

use Livewire\Component;

class DashBoard extends Component
{
    public $ordersByMonth;
    public function render()
    {
        return view('livewire.pages.admin.dash-board');
    }



    public function mount(){
        $this->dispatch('updateOrdersChart', orders: $this->ordersByMonth);
    }
}
