<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function index(){
        $products = Product::get();
        // dd($products);
        return view ('products.index',['products' => $products]);
}

public function create(){
    return view('products.create');

}
public function store(Request $request){
    $product = new Product();
    $product -> title = $request -> title;
    $product -> price = $request -> price;
    $product -> save();
    return reflect()->route('product.index'); 

}

}