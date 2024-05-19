<?php

namespace App\Http\Controllers;

use App\Models\Cats;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function cart(){
        $carts = auth()->user()->carts()->where('completed', 0)->withPivot('id')->get();
        $price = 0;
        foreach($carts as $cart){
            $price += $cart->price;
        }
        return view('cart.show', [
            'products' => $carts,
            'totalPrice' => $price
        ]);
    }

    public function index(){
        if (request('input')){
            $products = Product::where('name', 'LIKE','%' .  request('input') . '%')->get();
        } else 
            $products = Product::latest()->simplePaginate(12);
        return view('index', [
            'products' => $products
            // 'amount' => $amount
        ]);
    }

    public function profile(){

        return view('user.profile');
    }

    public function history(){
        // $products = auth()->user()->carts()->where('completed', 1)->withPivot('size')->get();
        $orders = auth()->user()->orders()->with('carts')
            ->whereHas('carts', function ($query) {
                $query->where('completed', 1);
            })->get();
        $comments = [];
        // foreach($products as $product){
        //     $comment = $product->comments()->where('user_id', auth()->user()->id)->get();
        //     if ($comment->count() > 0){
        //         $comments[$product->id] = $comment[0];
        //     }
        // }
        return view('user.history', [
            'orders' => $orders
        ]);
    }
}
