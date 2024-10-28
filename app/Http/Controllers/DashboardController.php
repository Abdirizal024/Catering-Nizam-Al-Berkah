<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Kontaks;
use App\Models\Testimoni;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function home()
{
    // Mengambil semua data testimoni
    $testimoni = Testimoni::all(); // Atau gunakan paginate() jika diperlukan

    // Mengambil data menu dari tabel menus
    $menus = Menu::all(); // Atau gunakan paginate() jika ingin membatasi tampilan

    // Mengirimkan kedua data tersebut ke view
    return view('index', compact('testimoni', 'menus')); // Mengirimkan testimoni dan menu
}

    public function about()
    {
        return view('about');
    }

    public function blog()
    {
        return view('blog');
    }

    public function contact()
    {
        return view('contact');
    }

    public function reservation()
    {
        return view('reservation');
    }

    public function menu()
    {
        // Ambil data menu dari database
        $menus = Menu::all(); // Mengambil semua data menu
        $kontak = Kontaks::first(); // Mengambil nomor kontak

        // Kirim data menu ke view
        return view('menu', compact('menus', 'kontak'));
    }
    

    public function maps()
    {
        return view('admin.maps.googlemaps');
    }
}
