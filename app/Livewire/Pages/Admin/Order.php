<?php

namespace App\Livewire\Pages\Admin;

use App\Repositories\Order\OrderRepository;
use DateTimeInterface;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

class Order extends Component
{
    use WithPagination;
    public $startDate, $endDate, $customer, $number, $perPage = 10, $order_id, $status;

    public function statusList()
    {
        return [
            'pending'=>'Pendente',
            'processing'=>'Processando',
            'shipped'=>'Enviado',
            'delivered'=>'Entregue',
            'cancelled'=>'Cancelado',
            'refunded'=>'Reembolsada'
        ];
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.pages.admin.order', [
            'orders' => $this->getOrders($this->customer, $this->number, $this->startDate, $this->endDate, $this->perPage),
            'status'=>$this->statusList()
        ]);
    }


    /** Listar todos os pedidos */
    public function getOrders(?string $customer, ?string $number, ?DateTimeInterface $start, ?DateTimeInterface $end, int $perPage)
    {
        try {
            return OrderRepository::search($customer, $number, $start, $end, $perPage);
        } catch (\Throwable $th) {
            LivewireAlert::text('Falha ao realizar a operação. Por favor, tente novamente.')
                ->error()
                ->toast()
                ->position('top-end')
                ->show();

            return collect();
        }
    }

    /**Confirmar antes de alterar o estado da encomenda */
    public function confirm($order, $status)
    {
        $this->order_id = $order;
        $this->status = $status;
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
            ->onConfirm('changeStatus')
            ->show();
    }


    /** Listar todos os pedidos */
    public function changeStatus()
    {
        try {
            $isChanged = OrderRepository::changeStatus($this->order_id, $this->status);

            if ($isChanged) {

                LivewireAlert::text('Operação realizada com sucesso.')
                    ->success()
                    ->toast()
                    ->position('top-end')
                    ->show();


                $this->reset(['order_id', 'status']);
            }
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
