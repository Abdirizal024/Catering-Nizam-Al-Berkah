<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Admin;
use App\Models\Order;
use App\Models\Kontaks;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon; // Pastikan ini ada
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function index()
    {
        $menuCount = Menu::count();
        $orderCount = Order::count();
        $adminCount = Admin::count();
        $pendingOrders = Order::where('status', 'Pending')->count();
        $successfulOrders = Order::where('status', 'Sudah Dibayar')->count();
            // Total Pemasukan (order dengan status 'Sudah Dibayar')
        $pemasukan = Order::where('status', 'Sudah DiBayar')->sum('total_price');
        // Total Pengeluaran (order dengan status 'cancelled' atau lainnya)
        $pengeluaran = Order::where('status', 'cancelled')->sum('total_price');
        $currentAdmin = Auth::guard('admin')->user(); // Mendapatkan admin yang sedang login

         // Ambil pemasukan per bulan (status 'Sudah Dibayar')
    $pemasukanBulanan = Order::select(
        DB::raw("SUM(total_price) as total"),
        DB::raw("DATE_FORMAT(created_at, '%Y-%m') as bulan")
    )
    ->where('status', 'Sudah Dibayar')
    ->groupBy('bulan')
    ->orderBy('bulan', 'asc')
    ->pluck('total', 'bulan')
    ->toArray();

// Ambil pengeluaran per bulan (status 'cancelled')
$pengeluaranBulanan = Order::select(
        DB::raw("SUM(total_price) as total"),
        DB::raw("DATE_FORMAT(created_at, '%Y-%m') as bulan")
    )
    ->where('status', 'cancelled')
    ->groupBy('bulan')
    ->orderBy('bulan', 'asc')
    ->pluck('total', 'bulan')
    ->toArray();

// Membuat daftar bulan dalam setahun dalam format 'F Y'
$months = [];
foreach (range(0, 11) as $i) {
    $months[] = Carbon::now()->subMonths($i)->format('F Y');
}
$months = array_reverse($months);

// Data pemasukan dan pengeluaran diurutkan berdasarkan bulan
$pemasukanData = [];
$pengeluaranData = [];
foreach ($months as $month) {
    $key = Carbon::parse($month)->format('Y-m');
    $pemasukanData[] = $pemasukanBulanan[$key] ?? 0;
    $pengeluaranData[] = $pengeluaranBulanan[$key] ?? 0;
}


        return view('admin.index', compact('menuCount', 'orderCount', 'adminCount', 'currentAdmin', 'pendingOrders', 'successfulOrders', 'pemasukan', 'pengeluaran', 'months', 'pemasukanData', 'pengeluaranData'));
    }
    


    public function menu()
    {
        $menus = Menu::all();
 $currentAdmin = Auth::guard('admin')->user(); // Mendapatkan admin yang sedang login
        return view('admin.menu', compact('menus', 'currentAdmin'));
    }

 // Menampilkan halaman profil
 public function profile()
 {
      $currentAdmin = Auth::guard('admin')->user(); // Mendapatkan admin yang sedang login
     return view('admin.profile', compact('currentAdmin'));
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
        'sbaru' => 'required|confirmed'
    ]);

    // Mendapatkan pengguna yang sedang login
    $user = Auth::user();

    // Periksa apakah $user adalah instance dari model User
    if (!($user instanceof Admin)) {
        return redirect()->back()->withErrors(['updateError' => 'Gagal memperbarui kata sandi.']);
    }

    // Periksa kata sandi lama
    if (!Hash::check($request->slama, $user->password)) {
        return redirect()->back()->withErrors(['slama' => 'Kata sandi lama tidak sesuai']);
    }

    // Hash dan simpan kata sandi baru
    $user->password = Hash::make($request->sbaru);
    $user->save();

    return redirect()->back()->with('success', 'Kata sandi berhasil diperbarui');
}


public function data_admin()
{
    $admins = Admin::all(); // Ambil semua data admin
    $currentAdmin = Auth::guard('admin')->user(); // Mendapatkan admin yang sedang login

    return view('admin.admin', compact('currentAdmin', 'admins'));
}




      // Tampilkan form untuk menambahkan admin baru
      public function adminCreate()
      {
        $currentAdmin = Auth::guard('admin')->user(); // Mendapatkan admin yang sedang login

          return view('admin.tambah_admin', compact('currentAdmin'));
      }

      public function adminStore(Request $request)
{
    // Validasi input
    $request->validate([
        'name' => 'required|string|max:255',
        'username' => 'required|string|max:255|unique:admin',
        'email' => 'required|string|email|max:255|unique:admin',
        'password' => 'required|string|min:8',
        'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    // Cek jika ada admin yang sedang login
    $currentAdmin = Auth::user();


    // Mengatur gambar profil default
    $profilePicture = 'images/default-admin2.png';

    // Upload gambar profil jika ada
    if ($request->hasFile('profile_picture')) {
        $fileName = time() . '_' . $request->file('profile_picture')->getClientOriginalName();
        $filePath = 'images/' . $fileName;
        $request->file('profile_picture')->move(public_path('images'), $fileName);
        $profilePicture = $filePath;
    }

    // Membuat admin baru
    Admin::create([
        'name' => $request->name,
        'username' => $request->username,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'profile_picture' => $profilePicture,
    ]);

    return redirect()->route('data.admin')->with('success', 'Akun admin berhasil dibuat. Silakan login.');
}




      // Tampilkan form edit admin
      public function adminEdit($id)
      {
        $currentAdmin = Auth::guard('admin')->user(); // Mendapatkan admin yang sedang login
          $admin = Admin::findOrFail($id);
          return view('admin.edit_admin', compact('admin', 'currentAdmin'));
      }

      // Perbarui data admin
      public function adminUpdate(Request $request, $id)
      {
          $admin = Admin::findOrFail($id);

          // Validasi input
          $validatedData = $request->validate([
              'name' => 'required|string|max:255',
              'email' => 'required|email|unique:admin,email,' . $admin->id, // Update unique validation untuk tabel 'admins'
              'username' => 'required|string|unique:admin,username,' . $admin->id . '|max:50',
              'password' => 'nullable|string|min:8|confirmed',
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
          return redirect()->route('data.admin')->with('success', 'Admin berhasil diperbarui!');
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
        $currentAdmin = Auth::guard('admin')->user(); // Mendapatkan admin yang sedang login

        return view('admin.tambah_menu', compact('currentAdmin'));
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
        $currentAdmin = Auth::guard('admin')->user(); // Mendapatkan admin yang sedang login

        // Ambil data menu berdasarkan ID
        $menu = Menu::findOrFail($id);

        // Tampilkan halaman edit menu
        return view('admin.edit_menu', compact('menu', 'currentAdmin'));
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
    $currentAdmin = Auth::guard('admin')->user(); // Mendapatkan admin yang sedang login

    $orders = Order::all(); // Ambil semua data order

    // Kirim data ke view
    return view('admin.transaksi', compact('orders', 'currentAdmin'));
}


    // public function kontak()
    // {
    //     $currentAdmin = Auth::guard('admin')->user(); // Mendapatkan admin yang sedang login
    //     $kontak = Kontaks::where('id', 1)->first();
    //     return view('admin.kontak', [
    //         'title' => 'Kontak',
    //         'kontak' => $kontak
    //     ]);
    // }

    // public function update_kontak(Request $request, $id)
    // {

    //     $request->validate([
    //         'kontak' => 'required|numeric'
    //     ]);

    //     // Temukan kontak berdasarkan ID dan perbarui
    //     $kontak = Kontaks::findOrFail($id);
    //     $kontak->kontak = $request->input('kontak');
    //     $kontak->save();

    //     return redirect()->back()->with('success', 'Kontak berhasil diperbarui');
    // }

    public function login()
    {
        // Periksa apakah admin sudah login
    if (Auth::guard('admin')->check()) {
        return redirect()->route('admin')->with('info', 'Anda sudah login, redirecting to dashboard.');
    }

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
    
            // Ambil pengguna yang sedang login
            $admin = Auth::guard('admin')->user();
    
            // Pastikan $admin adalah model Admin
            if ($admin instanceof Admin) {
                $admin->last_login_at = now(); // Simpan waktu login
                $admin->save(); // Simpan ke database
            } else {
                drakify('error'); // Berikan notifikasi error
                return back()->withErrors(['loginError' => 'Terjadi kesalahan saat menyimpan data login.']);
            }
    
            // Berikan notifikasi sukses
            drakify('success');
    
            return redirect()->intended(route('admin'));
        }
    
        // Jika login gagal
        drakify('error');
        return back()->withErrors(['loginError' => 'Login gagal.']);
    }
    


    public function logout()
    {
        Auth::logout();

        request()->session()->invalidate();

        request()->session()->regenerateToken();

        return redirect('/');
    }

}

