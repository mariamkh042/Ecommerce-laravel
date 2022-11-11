<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Orders;
use App\Models\Products;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        $orders = Orders::count();
        $prod = Products::count();
        $admins = User::where('role_as','=','1')->count();
        $user = User::where('role_as','=','0')->count();
        return view('admin.home',compact('prod','admins','user','orders'));
    }
}
