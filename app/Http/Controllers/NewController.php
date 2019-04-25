<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NewController extends Controller
{
    public function index(){
    	return view('front-end.home.home');
    }
    public function categoryproduct(){
    	return view('front-end.category.category-content');
    }
}
