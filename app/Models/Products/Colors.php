<?php

namespace App\Models\Products;

use App\Models\Products;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Colors extends Model
{
    use HasFactory;
    protected $table = "product_colors";

    protected $fillable = [
        'color',
        'name',
        'amount',
    ];

    public function product(){
        return $this->hasOne(Products::class,'id','product_id');
    }
}
