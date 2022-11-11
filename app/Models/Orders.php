<?php

namespace App\Models;

use App\Models\OrderProducts;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Orders extends Model
{
    use HasFactory;

    protected $table ='orders';

    protected $fillable = [
        'user_id',
        'total_price',
        'name',
        'email',
        'mobile',
        'phone',
        'city',
        'address',
        'pin_code',
        'note',
        'status',
        'tracking_no',
        'ordered_at',
    ];

    public function orderProducts()
    {
        return $this->hasMany(OrderProducts::class,'order_id','id');
    }
}
