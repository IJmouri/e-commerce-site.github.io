<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class studentController extends Controller
{
    public function index()
    {
    	$name="sjfhnke";
    	return view('home')->with('name',$name);
    }
    public function inde()
    {
    	return ('home about');
    }
}

