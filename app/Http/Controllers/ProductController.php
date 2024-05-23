<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use GrahamCampbell\ResultType\Success;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function newProductToCart(){
        $data = request()->validate([
            'id' => 'required|exists:products,id'
            
        ]);
        $user = User::find(auth()->user()->id);

        if ($user->carts()->where('completed', 0)->get()->pluck('id')->contains($data['id']))
            return ['error'];
        $user->carts()->attach($data['id']);

        return 200;
    }

    public function about(Product $product){

        return view('product.about', [
            'product' => $product,
            'comments' => $product->comments()->simplePaginate(4)
        ]);
    }

    public function destroy(Request $request){
        User::find(auth()->user()->id)->carts()->detach($request->id);

        return back();
    }

    public function pay(Request $request){
        $user = User::find(auth()->user()->id);
        $carts = $request->ids;
        $order = new Order;
        $order->address = $request->address;
        $order->status = 1;
        $order->user_id = $user->id;
        $order->date = Carbon::now()->format('Y-m-d');
        $order->price = 0;
        $order->save();

        foreach($carts as $cart){
            $realCart = Cart::find($cart['id']);
            $realCart->size = $cart['size'];
            $realCart->amount = $cart['amount'];
            $realCart->completed = true;
            $realCart->save();
            $order->carts()->attach($realCart->id);
            $order->price = $realCart->product->price;
        }        

        if ($request->points){
            if ($user->personal_points / $order->price > 0.3){
                $amount = $order->price * 0.3;
                $user->personal_points -= $amount; 
                $order->price -= $amount;
            } else {
                $order->price -=  $user->personal_points;
                $user->personal_points = 0;
            }
            $user->save();
        }
        $order->save();

        return 200;
    }
}
