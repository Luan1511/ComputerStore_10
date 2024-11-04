<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function gethome(){
        return view('home');
    }
    
    public function getabout(){
        return view('about');
    }
    
    public function getcontact(){
        return view('contact');
    }
    
    // public function get(){
    //     return view('about');
    // }
    
    // public function getabout(){
    //     return view('about');
    // }
    
    // public function getabout(){
    //     return view('about');
    // }
    
    // public function getabout(){
    //     return view('about');
    // }
}
