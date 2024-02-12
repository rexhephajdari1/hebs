<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
   public function index(){
    return view('dashboard', [
        'users' => User::count(),
        'categories' => Category::count(),
        'products' => Product::count(),
        'produktet'=>Product::all(),
        'kategorit'=>Category::all()  
          
    ]);
   }
}
