<?php 

namespace App\Http\Controllers;

use App\Product;
use App\Http\Controllers\Controller;

class ProductsController extends Controller
{
    public function index() {
    	$products = Product::all();
    	
    	return response()->json($products, 201);
    }

    public function show($id) {
    	$product = Product::where('id',$id)->get();

    	return response()->json($product, 201);
    }

    public function update($id) {
    	return response()->json('update', 201);
    }

    public function store($request) {
    	return response()->json('store', 201);
    }

    public function destroy($id) {
    	return response()->json('destroy', 201);    	
    }
}