<?php

namespace App\Repositories\Order;

use App\Livewire\Pages\Admin\Order;
use Carbon\Carbon;
use DateTimeInterface;
use Illuminate\Support\Facades\Log;

class OrderRepository
{
    /** get categories */
    public static function search(?string $customer, ?string $number, ?DateTimeInterface $start, ?DateTimeInterface $end, ?int $perPage)
    {
        try {
            $start = $start ? Carbon::parse($start)->startOfDay() : Carbon::parse(now())->startOfDay();
            $end = $end ? Carbon::parse($end)->startOfDay() : Carbon::parse(now())->startOfDay();

            return Order::where(function ($query) use ($customer, $number) {
                if (!empty($customer)) {



                    $query->whereHas('user', function ($q) use ($customer) {
                        $q->where('name', 'like', "%{$customer}%");
                    })
                        ->orWhere('number', 'like', "%{$number}%");
                }
            })->where('company_id', auth()->user()->company_id ?? null)

                ->when(!empty($search['start_date']) && !empty($search['end_date']), function ($query) use ($start, $end) {
                    $query->whereBetween('created_at', [
                        $start,
                        $end
                    ]);
                })

                ->orderBy('created_at', 'desc')
                ->paginate($perPage);
        } catch (\Throwable $th) {
            Log::error('Error', [
                'message' => $th->getMessage(),
                'line' => $th->getLine(),
                'file' => $th->getFile(),
            ]);
            return collect();
        }
    }


    /** get categories */
    public static function changeStatus(int $order, string $status)
    {
        try {
            $order = Order::findOrFail($order);
            if ($order) {
                $order->status = $status;
                $order->save();

                return $order;
            }
        } catch (\Throwable $th) {
            Log::error('Error', [
                'message' => $th->getMessage(),
                'line' => $th->getLine(),
                'file' => $th->getFile(),
            ]);
            return false;
        }
    }
}
