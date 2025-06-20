<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function news()
    {
        return view('pages.news');
    }


    public function contact()
    {
        return view('pages.contact');
    }
}
