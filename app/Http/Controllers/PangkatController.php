<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PangkatController extends Controller
{
    public function index() {
        return view('pangkat.index');
    }
}
