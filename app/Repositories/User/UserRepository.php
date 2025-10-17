<?php

namespace App\Repositories\User;

use App\Models\User;
use Illuminate\Support\Facades\Log;

class UserRepository
{


    /** Criar novo cliente */
    public static function store($user)
    {
        try {
            return User::updateOrCreate(['id' => $user['user_id']], $user);
        } catch (\Throwable $th) {
            Log::error('Error', [
                'message' => $th->getMessage(),
                'line' => $th->getLine(),
                'file' => $th->getFile(),
            ]);

            return false;
        }
    }

    /** excluir cliente */
    public static function destroy($user)
    {
        try {
            return User::where('id', $user)->delete();
        } catch (\Throwable $th) {
            Log::error('Error', [
                'message' => $th->getMessage(),
                'line' => $th->getLine(),
                'file' => $th->getFile(),
            ]);

            return false;
        }
    }

    /** editar cliente */
    public static function edit($user)
    {
        try {
            return User::find($user);
        } catch (\Throwable $th) {
            Log::error('Error', [
                'message' => $th->getMessage(),
                'line' => $th->getLine(),
                'file' => $th->getFile(),
            ]);

            return false;
        }
    }

    /** listar cliente */
    public static function search($search)
    {
        try {
            return User::where(function ($query) use ($search) {
                if (isset($search['search'])) {
                    $query->where('name', 'like', '%' . $search['search'] . '%')
                        ->orWhere('email', 'like', '%' . $search['search'] . '%');
                }
            })
            ->whereNotIn('name',['admin'])
            ->where('company_id', auth()->user()->company_id ?? null)
                ->orderBy('created_at', 'desc')
                ->paginate($search['perPage'] ?? 5);
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
