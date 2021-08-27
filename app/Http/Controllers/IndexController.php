<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        echo __CLASS__ . "[ok]" . PHP_EOL;
        return view('index');
    }
}
