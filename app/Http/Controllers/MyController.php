<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class MyController extends Controller
{
    public function show(){
        return view('cloud', [
            'name' => 'James',
            'title' => 'OwnCloud20',
        ]);
    }
}
