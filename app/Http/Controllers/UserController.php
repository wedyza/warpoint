<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Cats;
use App\Models\Product;
use App\Models\Subcategory;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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

        function parsePrice($price){
            switch($price){
                case 'До 750':
                    return Product::where('price', '<', 750);
                case '750 - 2000':
                    return Product::where('price', '>', 750)->where('price', '<', 2000);
                case '2000 - 7500':
                    return Product::where('price', '>', 2000)->where('price', '<', 7500);
                case '7500 и дороже':
                    return Product::where('price', '>', 7500);
                default:
                    return Product::where('price', '>', 0);
            }
        }

        

        if ((!request('price') and !request('category')) or (request('price') == 'all' and request('category') == 'all')){
            if (request('input')){
                $products = Product::where('name', 'LIKE','%' .  request('input') . '%')->get();
            } else 
                $products = Product::latest()->simplePaginate(12);
        }
        else if (request('price') == 'all' and request('category') != 'all'){
            $subcategory = Subcategory::where('name', request('category'))->get()[0];
            $products = Product::where('subcategory_id', $subcategory->id)->get();
        } else if (request('price') != 'all' and request('category') != 'all'){
            // ddd(request());
            $subcategory = Subcategory::where('name', request('category'))->get()[0];
            $products = parsePrice(request('price'))->where('subcategory_id', $subcategory->id)->get();
        } else if (request('price') != 'all' and request('category') == 'all'){
            $products = parsePrice(request('price'))->get();
        }
        return view('index', [
            'products' => $products,
            'categories' => Category::all()
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

    public function change(Request $request){
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|email'
        ]);

        $user = User::find(auth()->user()->id);
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->save();
    
        return back();
    }

    public function passwordChange(Request $request){
        // ddd($request);
        $data = $request->validate([
            'password_old' => 'required|password',
            'password' => 'required',
            'password_repeat' => 'required|same:password'
        ]);

        $user = User::find(auth()->user()->id);
        // ddd(Hash::check($user->password, bcrypt($data['password_old'])));
        // if (!Hash::check(bcrypt($data['password_old']), $user->password ))
        //     return back()->withErrors(['password' => 'Старый пароль не верен!']);

        if ($data['password'] != $data['password_repeat'])
            return back()->withErrors(['password' => 'Пароли не совпадают!']);

        $user->password = $data['password'];
        $user->save();

        return back();
    }
}
