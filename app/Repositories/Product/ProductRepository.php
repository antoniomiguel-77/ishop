<?php

namespace App\Repositories\Product;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use App\Models\Product;


class ProductRepository
{
    /** Criar novo Produto */
    public static function store($product)
    {
        try {

            return Product::updateOrCreate(['id' => $product['product_id']], $product);
        } catch (\Throwable $th) {
            Log::error('Error', [
                'message' => $th->getMessage(),
                'line' => $th->getLine(),
                'file' => $th->getFile(),
            ]);

            return false;
        }
    }

    /** excluir Produto */
    public static function destroy($product)
    {
        try {
            return Product::where('id', $product)->delete();
        } catch (\Throwable $th) {
            Log::error('Error', [
                'message' => $th->getMessage(),
                'line' => $th->getLine(),
                'file' => $th->getFile(),
            ]);

            return false;
        }
    }

    /** editar Produto */
    public static function edit($product)
    {
        try {
            return Product::find($product);
        } catch (\Throwable $th) {
            Log::error('Error', [
                'message' => $th->getMessage(),
                'line' => $th->getLine(),
                'file' => $th->getFile(),
            ]);

            return false;
        }
    }

    /** listar Produto */
    public static function search(array $search, $all = false)
    {
        try {

            $query = Product::query();

            if (!empty($search['search'])) {
                $query->where('name', 'like', '%' . $search['search'] . '%');
            }

            if (auth()?->user()?->company_id) {
                $query->where('company_id', auth()->user()?->company_id);
            }
            if ($all) {
                return $query->orderBy('created_at', 'desc')->get();
            }
            return $query
                ->where('status', 1)
                ->orderBy('created_at', 'desc')
                ->paginate(is_numeric($search['perPage'] ?? 5) ? (int)$search['perPage'] : 10);
        } catch (\Throwable $th) {
            Log::error('Erro na busca de produtos', [
                'message' => $th->getMessage(),
                'line' => $th->getLine(),
                'file' => $th->getFile(),
            ]);

            return false;
        }
    }

    /** get taxReason */
    public static function getTaxReasons()
    {
        try {

            return Cache::remember('tax_reasons', 60, function () {
                return \App\Models\ReasonTax::select('id', 'name')
                    ->orderBy('name', 'asc')
                    ->get();
            });
        } catch (\Throwable $th) {
            Log::error('Error', [
                'message' => $th->getMessage(),
                'line' => $th->getLine(),
                'file' => $th->getFile(),
            ]);
            return [];
        }
    }
}
