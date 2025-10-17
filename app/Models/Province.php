<?php

namespace App\Models;

use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Province extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'description',
    ];

    public function municipality()
    {
        return $this->belongsTo(Company::class, 'province_id', 'id');
    }
}
