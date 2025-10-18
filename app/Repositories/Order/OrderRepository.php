<?php

namespace App\Repositories\Order;

use App\Livewire\Pages\Admin\Order;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use DateTimeInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class OrderRepository
{
    /** get orders */
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


    /** change status of order */
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

    /** Carregar dados do grafico */
    public static function loadOrdersChart()
    {

        try {
            $ordersByMonth = Order::select(
                DB::raw('MONTH(created_at) as month'),
                DB::raw('COUNT(*) as total')
            )
                ->where('company_id', auth()->user()->company_id)
                ->whereYear('created_at', now()->year)
                ->groupBy('month')
                ->orderBy('month')
                ->pluck('total', 'month');

            $ordersData = array_fill(1, 12, 0);
            foreach ($ordersByMonth as $month => $total) {
                $ordersData[$month] = $total;
            }



            return array_values($ordersData);
        } catch (\Throwable $th) {
            Log::error('Error', [
                'message' => $th->getMessage(),
                'line' => $th->getLine(),
                'file' => $th->getFile(),
            ]);
            return [];
        }
    }

    /** Total de utilizadores */
    public static function userCount()
    {

        try {
            return User::where('company_id', auth()->user()->company_id)
                ->whereBetween('created_at', [
                    now()->startOfYear(),
                    now()->endOfDay()
                ])
                ->count();
        } catch (\Throwable $th) {
            Log::error('Error', [
                'message' => $th->getMessage(),
                'line' => $th->getLine(),
                'file' => $th->getFile(),
            ]);
            return 0;
        }
    }

    /** Total de produtos */
    public static function productCount()
    {

        try {
            return Product::where('company_id', auth()->user()->company_id)
                ->whereBetween('created_at', [
                    now()->startOfYear(),
                    now()->endOfDay()
                ])
                ->count();
        } catch (\Throwable $th) {
            Log::error('Error', [
                'message' => $th->getMessage(),
                'line' => $th->getLine(),
                'file' => $th->getFile(),
            ]);
            return 0;
        }
    }

    /** Total de encomendas */
    public static function orderCount()
    {

        try {
            return Order::where('company_id', auth()->user()->company_id)
                ->whereBetween('created_at', [
                    now()->startOfYear(),
                    now()->endOfDay()
                ])
                ->count();
        } catch (\Throwable $th) {
            Log::error('Error', [
                'message' => $th->getMessage(),
                'line' => $th->getLine(),
                'file' => $th->getFile(),
            ]);
            return 0;
        }
    }
}
