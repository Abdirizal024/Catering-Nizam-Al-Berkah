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
        $admin = Auth::guard('admin')->user(); // Mendapatkan admin yang sedang login

        return view('admin.index', compact('menuCount', 'orderCount', 'adminCount', 'admin'));
    }


    public function menu()
    {
        $menus = Menu::all();
        $admin = Auth::guard('admin')->user(); // Mendapatkan admin yang sedang login
        return view('admin.menu', compact('menus', 'admin'));
    }

 // Menampilkan halaman profil
 public function profile()
 {
     $admin = Auth::guard('admin')->user();
     return view('admin.profile', compact('admin'));
 }

 // Update profil admin // Update admin profile information
    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'username' => 'required|string|max:255',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $user = Auth::user();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->username = $request->username;

        if ($request->hasFile('profile_picture')) {
            $profilePicture = $request->file('profile_picture')->store('profile_pictures', 'public');
            $user->profile_picture = $profilePicture;
        }

        // Explicitly declare the type of $user
/** @var \App\Models\User $user */
$user = Auth::user();
$user->name = $request->name;
$user->save();

        return redirect()->back()->with('success', 'Profile updated successfully');
    }

    // Update admin password
    public function updatePassword(Request $request)
    {
        $request->validate([
            'slama' => 'required',
            'sbaru' => 'required|min:8|confirmed'
        ]);

        $user = Auth::user();

        if (!Hash::check($request->slama, $user->password)) {
            return redirect()->back()->withErrors(['slama' => 'The old password is incorrect']);
        }

        $user->password = Hash::make($request->sbaru);
        // Explicitly declare the type of $user
/** @var \App\Models\User $user */
$user = Auth::user();
$user->name = $request->name;
$user->save();

        return redirect()->back()->with('success', 'Password updated successfully');
    }

    public function data_admin()
    {
        $admins = Admin::all(); // Ambil semua data admin
        $admin = Auth::guard('admin')->user(); // Mendapatkan admin yang sedang login

        return view('admin.admin', compact('admin','admins'));
    }

      // Menampilkan form untuk membuat admin baru
      public function admin_create()
      {
          return view('admin.create'); // Ganti dengan view untuk membuat admin
      }
  
      // Menyimpan admin baru ke database
      public function admin_store(Request $request)
      {
          $request->validate([
              'name' => 'required|string|max:255',
              'username' => 'required|string|max:255|unique:admins',
              'email' => 'required|string|email|max:255|unique:admins',
              'password' => 'required|string|min:8|confirmed',
              'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi gambar profil
          ]);
  
          $admin = new Admin();
          $admin->name = $request->name;
          $admin->username = $request->username;
          $admin->email = $request->email;
          $admin->password = bcrypt($request->password);
  
          // Menyimpan gambar profil jika ada
          if ($request->hasFile('profile_picture')) {
              $imageName = time().'.'.$request->profile_picture->extension();
              $request->profile_picture->move(public_path('images'), $imageName);
              $admin->profile_picture = $imageName;
          }
  
          $admin->save();
  
          return redirect()->route('admin.index')->with('success', 'Admin berhasil ditambahkan!');
      }
  
      // Menampilkan form untuk mengedit admin
      public function admin_edit($id)
      {
          $admin = Admin::findOrFail($id);
          return view('admin.edit', compact('admin')); // Ganti dengan view untuk mengedit admin
      }
  
      // Mengupdate admin yang ada
      public function admin_update(Request $request, $id)
      {
          $admin = Admin::findOrFail($id);
  
          $request->validate([
              'name' => 'required|string|max:255',
              'username' => 'required|string|max:255|unique:admins,username,' . $admin->id,
              'email' => 'required|string|email|max:255|unique:admins,email,' . $admin->id,
              'password' => 'nullable|string|min:8|confirmed',
              'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
          ]);
  
          $admin->name = $request->name;
          $admin->username = $request->username;
          $admin->email = $request->email;
  
          if ($request->password) {
              $admin->password = bcrypt($request->password);
          }
  
          if ($request->hasFile('profile_picture')) {
              $imageName = time().'.'.$request->profile_picture->extension();
              $request->profile_picture->move(public_path('images'), $imageName);
              $admin->profile_picture = $imageName;
          }
  
          $admin->save();
  
          return redirect()->route('admin.index')->with('success', 'Admin berhasil diperbarui!');
      }
  
      // Menghapus admin
      public function destroy($id)
      {
          $admin = Admin::findOrFail($id);
          $admin->delete();
  
          return redirect()->route('admin.index')->with('success', 'Admin berhasil dihapus!');
      }

    public function create_admin()
    {
        $admin = Auth::guard('admin')->user(); // Mendapatkan admin yang sedang login

        return view('admin.tambah_menu', compact('admin'));
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
        $admin = Auth::guard('admin')->user(); // Mendapatkan admin yang sedang login

        // Ambil data menu berdasarkan ID
        $menu = Menu::findOrFail($id);

        // Tampilkan halaman edit menu
        return view('admin.edit_menu', compact('menu', 'admin'));
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
        $admin = Auth::guard('admin')->user(); // Mendapatkan admin yang sedang login

        // Ambil semua data pesanan
        $orders = Order::with('menu')->get();

        // Kirim data ke view
        return view('admin.transaksi', compact('orders', 'admin'));
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


    public function login_proses(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        if (Auth::guard('admin')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended(route('admin'));
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

