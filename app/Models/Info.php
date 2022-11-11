<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Info extends Model
{
    use HasFactory;

    protected $table = "info";

    protected $fillable = [
        'id',
        'name',
        'email',
        'phone',
        'twitter',
        'facebook',
        'instagram',
        'youtube',
        'location',
        'open_hours',
    ];
}
