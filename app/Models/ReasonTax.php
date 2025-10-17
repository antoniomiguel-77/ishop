<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReasonTax extends Model
{
    protected $table = 'reason_taxes';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'code',
    ];

    public function product()
    {
        return $this->hasMany(ReasonTax::class, 'reason_id');
    }
}
