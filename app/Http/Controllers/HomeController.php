<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $barang = Barang::where('status', 'tersedia')
            ->where('stok', '>', 0)
            ->get();

        return view('home', compact('barang'));
    }

}
