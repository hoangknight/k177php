<?php

namespace App\Http\Controllers\Site\Cart;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Cart;
use App\Models\Order;
use App\Models\OrderDetial;
class CartController extends Controller
{
    public function cart(){
        $data['cart'] = Cart::content();
        $data['total'] = Cart::total(0,"",".");
        return view('frontend.cart.cart', $data);
    }
    public function checkout(){
        $data['cart'] = Cart::content();
        $data['total'] = Cart::total(0,"",".");
        return view('frontend.cart.checkout',$data);
    }
    public function payment(Request $request){
        // Save to order table
        $order = new Order();
        $order->fullname = $request->full;
        $order->email = $request->email;
        $order->address = $request->address;
        $order->phone = $request->phone;
        $order->total = round(Cart::total(),0);
        $order->state = 0;
        $order->save();
        // Save to order detail table
        foreach (Cart::content() as $key => $value) {
            $order_detail = new OrderDetial();
            $order_detail->code = $value->id;
            $order_detail->name = $value->name;
            $order_detail->price = $value->price;
            $order_detail->quantity = $value->qty;
            $order_detail->image = $value->options->image;
            $order_detail->orders_id = $order->id;
            $order_detail->save();
        }
        return redirect()->route('cart.complete');

    }
    public function complete(){
        return view('frontend.cart.complete');
    }

    public function addToCart(Request $request){
        $product = Product::find($request->id_product);
        if($request->has('quantity')){
            $qty = $request->quantity;
        }else{
            $qty = 1;
        }
        Cart::add([ 'id' => $product->code, 
                    'name' => $product->name, 
                    'qty' => $qty, 
                    'price' => $product->price, 
                    'weight' => 0, 
                    'options' => ['image' => $product->image]]);
        return redirect()->route('cart');

    }

    public function update($rowId, $qty){
        Cart::update($rowId, $qty);
        return 200;
    }
    public function delete($rowId){
        Cart::remove($rowId);
        return redirect()->back();
    }
}
