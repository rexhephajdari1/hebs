<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductDashboardController extends Controller
{
    public function index()
{
    $products = Product::all(); // Merr të gjitha produktet
    $product = Product::latest()->first(); // Merr produktin më të fundit si shembull
    // Merrni gjithashtu të dhënat për përdoruesit dhe kategoritë siç keni bërë më parë
    return view('dashboard', compact('products', 'product')); // Dërgo të dhënat në pamje   
}

}
    