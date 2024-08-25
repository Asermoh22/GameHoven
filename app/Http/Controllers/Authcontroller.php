<?php

namespace App\Http\Controllers;

use App\Models\User;
use Auth;
use Illuminate\Http\Request;
use Hash;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\EmailController; 
use Illuminate\Support\Facades\Mail;

use App\Mail\mailemaker;

use Nette\Utils\Random;

class Authcontroller extends Controller
{

   
    public function register(){
        return view('users.register');
    }

    public function handelregister(Request $request){
        $request->validate([
            'name'=>'required|string|max:100',
            'email'=>'required|string|max:100',
            'password'=>'required|string|max:255',
        ]);

        $name=$request->name;
        $email=$request->email;
        $password=$request->password;

      $user=  User::create([
            'name'=>$name,
            'email'=>$email,
            'password'=>Hash::make($password),
            'access_token' => Str::random(40)
        ]);

        Auth::login($user);
        Mail::to(Auth::user()->email)->send(new Mailemaker());


        return redirect(route('games.index'));
    }

    public function login(){
        return view('users.login');
    }

    public function handellogin(Request $request){
        $request->validate([
            'email'=>'required|string|max:100',
            'password'=>'required|string|max:255',
        ]);

        $email=$request->email;
        $password=$request->password;

        $cord=$request->only('email','password');
        if(Auth::attempt($cord)){
        Mail::to(Auth::user()->email)->send(new Mailemaker());
        return redirect(route('games.index'));


        }else{
            return back()->with('error', 'You don’t have an account.');

        }
    }

    public function redirectgoog(){
        return Socialite::driver('google')->redirect();
    }

    public function callbackgoog(){
        $user = Socialite::driver('google')->user();
        $name=$user->name;
        $email=$user->email;
       // dd($user->token);

        $existuser=User::where('email','=',$email)->first();
        if($existuser){
            Auth::login($existuser);
            Mail::to(Auth::user()->email)->send(new Mailemaker());

        }else{
           $newuser= User::create([
                'name'=>$name,
                'email'=>$email,
                'password'=>Hash::make(123456789),
            'Oauth_token' => $user->token
            ]);
            Auth::login($newuser);
            Mail::to(Auth::user()->email)->send(new Mailemaker());

        }

        return redirect(route('games.index'));
    }

    public function logout(Request $request){
        $request->session()->flush();

        Auth::logout();
        return redirect(route('auth.login'));
    }
}
