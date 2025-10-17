<?php

namespace App\Models;

use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Municipality extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'description',
        'province_id',
    ];

    public function province()
    {
        return $this->belongsTo(Company::class, 'province_id', 'id');
    }
}
