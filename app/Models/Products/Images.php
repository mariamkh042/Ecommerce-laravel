<?php

namespace App\Models\Products;

use App\Models\Products;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Images extends Model
{
    use HasFactory;

    protected $table = 'product_images';

    protected $fillable = [
        'product_id',
        'image',
    ];

    public function prodImg(){
        return $this->hasOne(Products::class,'id','product_id');
    }
}
