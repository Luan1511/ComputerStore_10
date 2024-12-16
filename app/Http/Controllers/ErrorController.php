<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Point;
use Illuminate\Http\Request;

class ErrorController extends Controller
{
    //
    public function error_point() {
        Point::create([
            'user_id' => auth()->id(),
            'point' => 0
        ]);

        // return response()->noContent();
        return view('home');
    }


}
