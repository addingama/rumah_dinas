<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TipeRumahController extends Controller
{
    public function index() {
        return view('tipe_rumah.index');
    }
}
