<?php

namespace App\Repositories\Category;


use Illuminate\Support\Facades\Log;
use App\Models\Category;


class CategoryRepository
{

    /** get categories */
    public static function search($search)
    {
        try {

            $query = Category::where(function ($query) use ($search) {
                if (isset($search)) {
                    $query->where('name', 'like', '%' . $search . '%');
                }
            });
            if (auth()?->user()?->company_id) {
                $query->where('company_id', auth()->user()?->company_id);
            }
            return $query->orderBy('created_at', 'desc')
                ->get();
        } catch (\Throwable $th) {
            Log::error('Error', [
                'message' => $th->getMessage(),
                'line' => $th->getLine(),
                'file' => $th->getFile(),
            ]);
            return [];
        }
    }

    /** Criar novo categoria */
    public static function store($category)
    {
        try {

            return Category::updateOrCreate(['id' => $category['category_id']], $category);
        } catch (\Throwable $th) {
            Log::error('Error', [
                'message' => $th->getMessage(),
                'line' => $th->getLine(),
                'file' => $th->getFile(),
            ]);

            return false;
        }
    }

    /** excluir categoria */
    public static function destroy($category)
    {
        try {
            return Category::where('id', $category)->delete();
        } catch (\Throwable $th) {
            Log::error('Error', [
                'message' => $th->getMessage(),
                'line' => $th->getLine(),
                'file' => $th->getFile(),
            ]);

            return false;
        }
    }

    /** editar categoria */
    public static function edit($category)
    {
        try {
            return Category::find($category);
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
