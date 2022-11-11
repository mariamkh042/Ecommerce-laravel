<?php

namespace App\Models;

use App\Models\Products;
use App\Models\Categories;
use App\Models\Products\Colors;
use App\Models\Products\Images;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Products extends Model
{
    use HasFactory;

    protected $table = "products";

    protected $fillable = [
        'category_id',
        'name',
        'small_description',
        'description',
        'original_price',
        'selling_price',
        'image',
        'qty',
        'offer',
        'qty',
        'status',
        'trending',
        'meta_title',
        'meta_keywords',
        'meta_description',
    ];

    public function category(){
        return $this->hasOne(Categories::class,'id','category_id');
    }

    public function img(){
        return $this->hasMany(Images::class,'product_id','id');
    }

    public function color(){
        return $this->hasMany(Colors::class,'product_id','id');
    }

    public function total_quantity($product_id){
        $quantity = Colors::where('product_id','=',$product_id)->sum('qty');
        return $quantity;
    }
}
