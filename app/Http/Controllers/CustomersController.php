<?php 

namespace App\Http\Controllers;

use App\Customer;
use App\Http\Controllers\Controller;

class CustomersController extends Controller
{
    public function index() {
    	$customers = Customer::all();

    	return response()->json($customers, 201);
    }

    public function show($id) {
    	$customer = Customer::where('id',$id)->get();

    	return response()->json($customer, 201);
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