<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Notifications\ProductsOrdered;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        $order = new Order();
        $order->create($request->all());
        $order->notify(new ProductsOrdered());
    }
}
