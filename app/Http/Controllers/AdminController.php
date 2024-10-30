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

      // Tampilkan form untuk menambahkan admin baru
      public function adminCreate()
      {
        $admin = Auth::guard('admin')->user(); // Mendapatkan admin yang sedang login

          return view('admin.tambah_admin', compact('admin'));
      }

      public function adminStore(Request $request)
      {
          // Validasi input
          $validatedData = $request->validate([
              'name' => 'required|string|max:255',
              'email' => 'required|email|unique:admin',
              'username' => 'required|string|unique:admin|max:255',
              'password' => 'required|string|min:8',
              'profile_picture' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
          ]);
      
          // Hash password
          $validatedData['password'] = Hash::make($validatedData['password']);
      
          // Cek apakah ada gambar yang diupload
          if ($request->hasFile('profile_picture')) {
              $gambarPath = $request->file('profile_picture')->store('images', 'public');
              $validatedData['profile_picture'] = $gambarPath;
          } else {
              // Set gambar default jika tidak ada gambar yang diupload
              $validatedData['profile_picture'] = 'default-admin2.png';
          }
      
          // Simpan data admin ke database
          Admin::create($validatedData);
      
          // Redirect ke halaman daftar admin dengan pesan sukses
          return redirect()->route('admin.index')->with('success', 'Admin berhasil ditambahkan!');
      }
      

      // Tampilkan form edit admin
      public function adminEdit($id)
      {
        $admin = Auth::guard('admin')->user(); // Mendapatkan admin yang sedang login
          $admin = Admin::findOrFail($id);
          return view('admin.edit_admin', compact('admin'));
      }

      // Perbarui data admin
      public function adminUpdate(Request $request, $id)
      {
          $admin = Admin::findOrFail($id);

          // Validasi input
          $validatedData = $request->validate([
              'name' => 'required|string|max:255',
              'email' => 'required|email|unique:admin,email,' . $admin->id,
              'username' => 'required|string|unique:admin,username,' . $admin->id . '|max:50',
              'password' => 'nullable|string|min:6|confirmed',
              'profile_picture' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
          ]);

          // Hash password jika ada perubahan password
          if ($request->filled('password')) {
              $validatedData['password'] = Hash::make($request->password);
          }

          // Jika ada file gambar baru diupload, hapus gambar lama dan simpan yang baru
          if ($request->hasFile('profile_picture')) {
              if ($admin->profile_picture) {
                  Storage::disk('public')->delete($admin->profile_picture);
              }
              $profilePicturePath = $request->file('profile_picture')->store('images', 'public');
              $validatedData['profile_picture'] = $profilePicturePath;
          }

          // Update data admin
          $admin->update($validatedData);

          // Redirect ke halaman daftar admin dengan pesan sukses
          return redirect()->route('admin.index')->with('success', 'Admin berhasil diperbarui!');
      }

      // Hapus data admin
      public function destroy($id)
      {
          $admin = Admin::findOrFail($id);

          // Hapus gambar profil jika ada
          if ($admin->profile_picture) {
              Storage::disk('public')->delete($admin->profile_picture);
          }

          // Hapus data admin dari database
          $admin->delete();

          // Redirect ke halaman daftar admin dengan pesan sukses
          return redirect()->route('admin.index')->with('success', 'Admin berhasil dihapus!');
      }

    public function create()
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
    // Validasi input
    $credentials = $request->validate([
        'username' => 'required|string',
        'password' => 'required|string',
    ]);

    // Proses login dengan guard admin
    if (Auth::guard('admin')->attempt(['username' => $credentials['username'], 'password' => $credentials['password']])) {
        $request->session()->regenerate();
        return redirect()->intended(route('admin'))->with('success', 'Berhasil login!');
    }

    // Jika gagal login
    return back()->withErrors([
        'loginError' => 'Username atau password salah!',
    ]);
}


    public function logout()
    {
        Auth::logout();

        request()->session()->invalidate();

        request()->session()->regenerateToken();

        return redirect('/');
    }

}

