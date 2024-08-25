<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Mail;

use App\Mail\mailemaker;
class emailcontroller extends Controller
{
    public function send(){
        Mail::to(Auth::user()->email)->send(new mailemaker());

    }
}
