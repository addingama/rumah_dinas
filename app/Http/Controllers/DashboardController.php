<?php

namespace App\Http\Controllers;

use App\Models\Rumah;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index() {
        $jumlah_rumah = Rumah::count();
        $jumlah_rumah_terpinjam = Rumah::where('is_available', '=', 0)->count();
        $jumlah_rumah_tersedia = Rumah::where('is_available', '=', 1)->count();

        $data = compact('jumlah_rumah', 'jumlah_rumah_terpinjam', 'jumlah_rumah_tersedia');
        return view('dashboard.admin')->with($data);
    }
}
