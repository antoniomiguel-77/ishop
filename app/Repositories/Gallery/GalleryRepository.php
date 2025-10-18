<?php

namespace App\Repositories\Gallery;


use Illuminate\Support\Facades\Log;
use App\Models\Category;
use App\Models\Gallery;
use phpDocumentor\Reflection\Types\Boolean;

class GalleryRepository
{

    /** get categories */
    public static function search(int $product)
    {
        try {

            if(!empty($product)) {

                return Gallery::where('company_id', auth()->user()->company_id ?? null)
                    ->where('product_id', $product)
                    ->orderBy('created_at', 'desc')
                    ->get();
            }

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
    public static function store($gallery)
    {
        try {

            return Gallery::updateOrCreate(['image' => $gallery['image']], $gallery);
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
    public static function destroy($gallery)
    {
        try {
            return Gallery::where('id', $gallery)->delete();
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
    public static function edit($gallery)
    {
        try {
            return Gallery::find($gallery);
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
    public static function toggleMain($gallery)
    {
        try {
            // Desativa todas as imagens principais
            Gallery::query()->update(['is_main_image' => false]);

            // Ativa a selecionada
            $img = Gallery::find($gallery);
            $img->is_main_image = true;
            $img->save();

            if ($img) {
                return true;
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
