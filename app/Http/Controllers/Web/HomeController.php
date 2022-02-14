<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Models\Series;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function home() {

        return view('home');

    }
}
