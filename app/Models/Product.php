<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\SoftDeletes;
use \Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\{Category,Company,ReasonTax,User};
use Illuminate\Database\Eloquent\Casts\Attribute;

class Product extends Model
{
    use SoftDeletes, HasFactory;
    protected $table = "products";
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'code',
        'price',
        'retention',
        'type',
        'tax',
        'reason_id',
        'company_id',
        'user_id',
        'category_id',
        'company_id',
        'reason_tax_id',
        'quantity'
    ];
 
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function company()
    {
        return $this->belongsTo(Company::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function reason()
    {
        return $this->belongsTo(ReasonTax::class, 'reason_id');
    }


    protected static function booted()
    {
        static::creating(function ($product) {
            $lastId = Product::where('company_id', $product->company_id)->max('id') ?? 0;
            $product->code = ($product->type == 'service') ? 'S' . str_pad($lastId + 1, 6, '0', STR_PAD_LEFT) :
                'P' . str_pad($lastId + 1, 6, '0', STR_PAD_LEFT);
        });
    }

    protected function priceWithTax(): Attribute
    {
        return Attribute::get(function () {
            $base = $this->price ?? 0;
            $tax  = $this->tax ?? 0;

            if ($tax > 0) {
                $iva = ($base * $tax) / 100;
                return round($base + $iva, 2);
            }

            return round($base, 2);
        });
    }
}