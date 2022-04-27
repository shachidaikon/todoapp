<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail; //追記
use App\Mail\RegisterMail; 

class MailSendController extends Controller
{

    public function index() {
        return view('registers.index');
    }

    public function register(Request $request) {
        $name = $request['name'];
    
        Mail::send(new RegisterMail($name));
        return view('registers.index');
    }
}
