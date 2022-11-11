<?php

namespace App\Models;

use App\Models\Products;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Categories extends Model
{
    use HasFactory;

    protected $table = 'categories';
    
    protected $fillable = [
        'name',
        'description',
        'status',
        'popular',
        'meta_title',
        'meta_descrip',
        'meta_keywords',
    ];

    public function products(){
        return $this->hasMany(Products::class,'category_id','id');
    }
}
