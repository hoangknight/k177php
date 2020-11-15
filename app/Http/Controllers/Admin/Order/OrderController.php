<?php

namespace App\Http\Controllers\Admin\Order;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
// use App\Models\OrderDetial;
class OrderController extends Controller
{
    public function orders(){
        $orders = Order::where('state',0)->get();
        return view('backend.orders.order', compact('orders'));
    }
    public function detail($orderId){
        $order =  Order::find($orderId);
        return view('backend.orders.detailorder', compact('order'));
    }
    public function approve($orderId){
        $order = Order::find($orderId);
        $order->state = 1;
        $order->save();
        return redirect()->route('order.order');
    }
    public function processed(){
        $orders = Order::where('state',1)->get();
        return view('backend.orders.processed', compact('orders'));
    }
}
