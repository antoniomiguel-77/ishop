<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'number',
        'user_id',
        'company_id',
        'status',
        'discount',
        'tax',
        'total',
        'payment_method',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function items()
    {
        return $this->hasMany(OrderDetail::class);
    }


     protected static function booted()
    {
        static::creating(function ($order) {
            $lastId = Product::where('company_id', $order->company_id)->max('id') ?? 0;
            $order->number = 'O' . str_pad($lastId + 1, 6, '0', STR_PAD_LEFT);
        });
    }
}
