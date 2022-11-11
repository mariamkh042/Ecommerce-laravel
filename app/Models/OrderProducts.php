<?php

namespace App\Models;

use App\Models\Orders;
use App\Models\Products;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderProducts extends Model
{
    use HasFactory;

    protected $table ='order_products';

    protected $fillable = [
        'order_id',
        'product_id',
        'color',
        'qty',
        'price',
    ];

    public function order(){
        return $this->hasOne(Orders::class,'id','order_id');
    }

    public function products()
    {
        return $this->belongsTo(Products::class,'product_id','id');
    }
}