<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller


{
    public function home(){
    return view('user.home');


}
public function  contact(){
    return view('user.contact');


}

public function form(){
    return view('user.form');


}


}
