<?php

namespace App\Http\Controllers;

use App\Models\LoginToken;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;

class SessionController extends Controller
{
    public function show(){

        return view("sessions.show");
    }

    public function login(Request $request){
        $attributes = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (! Auth::attempt($attributes)) {
            return back()
            ->withInput()
            ->withErrors(["email" => 'Не существует аккаунта с такими данными']);
        }

        session()->regenerate();

        return redirect('/');
    }

    public function create(){

        return view("sessions.create");
    }

    public function register(Request $request){
        $attributes = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'second_password' => 'required',
            'name' => 'required'
        ]);

        if ($attributes['password'] != $attributes['second_password']){
            return back()->withInput()->withErrors(["password" => "Введеные пароли не совпадают!"]);
        }

        if (User::where('email', $attributes['email'])->count() != 0){
            return back()->withInput()->withErrors(["email" => "Аккаунт с таким email уже существует!"]);
        }

        $user = new User;
        $user->name = $attributes['name'];
        $user->password = $attributes['password'];
        $user->email = $attributes['email'];
        $user->save();

        Auth::attempt($attributes);

        session()->regenerate();

        return redirect('/');
    }

    public function destroy(){
        Auth::logout();

        return redirect('/');
    }

    public function reset(){

        return view('sessions.reset');
    }

    public function send(Request $request){
        $request->validate([
            'email' => 'required|email|exists:users,email'
        ]);

        User::whereEmail($request->email)->first()->sendLoginLink();

        return back();
    }

    public function login_without_password(Request $request, string $token){
        $token = LoginToken::where('token', hash('sha256', $token))->firstOrFail();
        abort_unless($request->hasValidSignature() && $token->isValid(), 401);
        $token->consume();
        Auth::login($token->user);
        return redirect('/');
    }
}
