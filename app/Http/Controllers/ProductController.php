<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('products.index', ['products' => Product::paginate(10)]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('products.create', ['categories' => Category::all()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required',
            'name' => 'required',
            'price' => 'required'
        ]);

        $data = $request->except('_token');

        if($request->hasFile('image')){
            $image = $request->file('image')->getClientOriginalName();
            $name = pathinfo($image, PATHINFO_FILENAME);
            $ext = $request->file('image')->getClientOriginalExtension(); // More streamlined way to get extension
            $filename = time() . "_" . $name . "." . $ext;
    
            Storage::putFileAs('public/products/', $request->file('image'), $filename);
            $data['image'] = $filename;
        }
        Product::create($data);

        return redirect()->route('products.index')->with('staus','Product was created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('products.edit', ['product' => Product::findOrFail($id),'categories' => Category::all()]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        {
            $request->validate([
                'category_id' => 'required',
                'name' => 'required',   
                'price' => 'required    ',
            ]);
    
            $data = $request->except('_token');
    
            if($request->hasfile('image')){
                $image = $request->image->getClientOriginalName();
                $name = pathinfo($image ,PATHINFO_FILENAME);
                $ext = pathinfo($image ,PATHINFO_EXTENSION);
    
                $filename = time()."_".$name.".".$ext;
    
                Storage::putFileAs('public/products/',$request->image, $filename);
    
                $data['image'] = $filename;
            }
    
            Product::findOrFail($id)->update($data);
    
            return redirect()->route('products.index')->with('status', 'Product was update successfully.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Product::findOrFail($id)->delete();
        return redirect()->back()->with('status', 'Product was deleted successfully.');
    }

    }

