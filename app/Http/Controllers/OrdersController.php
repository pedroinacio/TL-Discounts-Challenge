<?php 

namespace App\Http\Controllers;

use App\Order;
use App\Http\Controllers\Controller;

class OrdersController extends Controller
{
    public function index() {
    	$orders = Order::all();
    	
    	return response()->json($orders, 201);
    }
}