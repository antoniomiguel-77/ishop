<?php

namespace App\Livewire\Pages\Admin;

use App\Repositories\Order\OrderRepository;
use Livewire\Component;

class DashBoard extends Component
{
    public $ordersByMonth, $productCount, $orderCount, $userCount;
    public function render()
    {
        return view('livewire.pages.admin.dash-board');
    }


    public function mount()
    {
        $this->ordersByMonth = OrderRepository::loadOrdersChart();
        $this->productCount =  OrderRepository::productCount();
        $this->orderCount =  OrderRepository::orderCount();
        $this->userCount =  OrderRepository::userCount();
    }
}
