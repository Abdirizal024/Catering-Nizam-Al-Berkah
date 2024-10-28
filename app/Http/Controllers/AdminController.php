<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Admin;
use App\Models\Order;
use App\Models\Kontaks;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function index()
    {
        $menuCount = Menu::count();
        $orderCount = Order::count();
        $adminCount = Admin::count();
        
        return view('admin.index', compact('menuCount', 'orderCount', 'adminCount'));
    }
    

    public function menu()
    {
        $menus = Menu::all();
        return view('admin.menu', compact('menus'));
    }

    public function profil()
    {
        // Cek apakah pengguna sudah login
    if (Auth::check()) {
        $user = Auth::user();

        return view('admin.profil', [
            'title' => 'Profil Pengguna',
            'user' => $user
        ]);
    }

    // Jika tidak login, arahkan ke halaman login
    return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
    }

    public function data_admin()
    {
        return view('admin.dataadmin');
    }

    public function create()
    {
        return view('admin.tambah_menu');
    }

        // Method untuk menyimpan menu baru ke database
    public function store(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'harga' => 'required|numeric',
            'gambar' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        // Jika ada file gambar diupload, simpan ke storage
        if ($request->hasFile('gambar')) {
            $gambarPath = $request->file('gambar')->store('images', 'public');
            $validatedData['gambar'] = $gambarPath;
        }

        // Simpan data menu ke database
        Menu::create($validatedData);

        // Redirect ke halaman daftar menu dengan pesan sukses
        return redirect()->route('admin.menu')->with('success', 'Menu berhasil ditambahkan!');
    }

    public function edit($id)
    {
        // Ambil data menu berdasarkan ID
        $menu = Menu::findOrFail($id);
    
        // Tampilkan halaman edit menu
        return view('admin.edit_menu', compact('menu'));
    }
    
    public function update(Request $request, $id)
    {
        // Validasi input dari form edit
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'harga' => 'required|numeric',
            'gambar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048' // opsional untuk gambar
        ]);
    
        // Ambil menu berdasarkan ID
        $menu = Menu::findOrFail($id);
    
        // Periksa jika ada gambar yang diupload
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama
            if ($menu->gambar) {
                Storage::delete('public/' . $menu->gambar);
            }
    
            // Simpan gambar baru
            $path = $request->file('gambar')->store('menu_images', 'public');
            $validatedData['gambar'] = $path;
        }
    
        // Update data menu di database
        $menu->update($validatedData);
    
        // Redirect ke halaman menu dengan pesan sukses
        return redirect()->route('admin.menu')->with('success', 'Menu berhasil diupdate!');
    }

    public function transaksi()
    {
        // Ambil semua data pesanan
        $orders = Order::with('menu')->get();

        // Kirim data ke view
        return view('admin.transaksi', compact('orders'));
    }

    public function kontak()
    {
        $kontak = Kontaks::where('id', 1)->first();
        return view('admin.kontak', [
            'title' => 'Kontak',
            'kontak' => $kontak
        ]); 
    }

    public function update_kontak(Request $request, $id)
    {
        
        $request->validate([
            'kontak' => 'required|numeric'
        ]);
    
        // Temukan kontak berdasarkan ID dan perbarui
        $kontak = Kontaks::findOrFail($id);
        $kontak->kontak = $request->input('kontak');
        $kontak->save();

        return redirect()->back()->with('success', 'Kontak berhasil diperbarui');
    }

    public function login()
    {
        return view('admin.auth.login');
    }

    
    // Fungsi untuk menangani login
    public function login_proses(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        if(Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/admin');
        }

        return back()->with('loginError', 'Login Failed!');
    }

    public function logout()
    {
        Auth::logout();

        request()->session()->invalidate();

        request()->session()->regenerateToken();

        return redirect('/');
    }

}

