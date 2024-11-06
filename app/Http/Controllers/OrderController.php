<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Order;
use Midtrans\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Events\NewOrderCreated;


class OrderController extends Controller
{
    public function confirm($id)
{
    $menu = Menu::findOrFail($id);
    return view('confirm', compact('menu'));
}

public function process(Request $request)
{
    $request->validate([
        'menu_id' => 'required|exists:menu,id',
        'customer_name' => 'required|string',
        'customer_phone' => 'required|string',
        'customer_address' => 'required|string',
        'quantity' => 'required|integer|min:1', // Validasi jumlah
    ]);

    // Ambil menu untuk mendapatkan harganya
    $menu = Menu::findOrFail($request->menu_id);

    // Hitung total harga berdasarkan jumlah item yang dibeli
    $totalPrice = $menu->harga * $request->quantity;

    // Simpan data pesanan ke database
    $order = Order::create([
        'menu_id' => $request->menu_id,
        'customer_name' => $request->customer_name,
        'customer_phone' => $request->customer_phone,
        'customer_address' => $request->customer_address,
        'status' => 'pending',
        'quantity' => $request->quantity,
        'total_price' => $totalPrice,
    ]);

    

    // Arahkan ke halaman detail
    return redirect()->route('order.details', $order->id);
}


public function details($id)
{
    $order = Order::findOrFail($id);

// Konfigurasi Midtrans
\Midtrans\Config::$serverKey = config('midtrans.server_key');
\Midtrans\Config::$isProduction = config('midtrans.is_production');
\Midtrans\Config::$isSanitized = config('midtrans.is_sanitized');
\Midtrans\Config::$is3ds = config('midtrans.is_3ds');


    // Membuat order_id yang unik (misalnya dengan menambahkan timestamp atau menggunakan UUID)
    $uniqueOrderId = $order->id . '-' . time();

    // Membuat transaksi untuk mendapatkan Snap Token
    $params = [
        'transaction_details' => [
            'order_id' => $uniqueOrderId, // Gunakan ID yang unik
            'gross_amount' => $order->menu->harga * $order->quantity, // Hitung total harga
        ],
        'customer_details' => [
            'first_name' => $order->customer_name,
            'phone' => $order->customer_phone,
            'address' => $order->customer_address,
        ],
    ];

    // Mendapatkan Snap Token dari Midtrans
    $snapToken = \Midtrans\Snap::getSnapToken($params);

    // Kirim token dan order ke view
    return view('details', compact('order', 'snapToken'));
}



public function handleCallback(Request $request)
{
 // Ambil data dari notifikasi Midtrans
 Log::info('Menerima notifikasi dari Midtrans', $request->all());

 // Proses notifikasi
 $notification = $request->all();
 $orderId = $notification['order_id'];
 $status = $notification['transaction_status'];
 $fraud = $notification['fraud_status'];

 // Cari order berdasarkan ID
 $order = Order::where('id', explode('-', $orderId)[0])->first();

 if ($status == 'capture') {
     // Jika pembayaran berhasil
     if ($fraud == 'accept') {
         $order->status = 'Sudah Dibayar';
         Log::info('Pembayaran berhasil', ['order_id' => $orderId]);
     } else {
         $order->status = 'failed';
         Log::warning('Pembayaran ditolak oleh sistem', ['order_id' => $orderId]);
     }
 } elseif ($status == 'settlement') {
     $order->status = 'Sudah Dibayar';
     Log::info('Pembayaran diselesaikan', ['order_id' => $orderId]);
 } elseif ($status == 'pending') {
     $order->status = 'pending';
     Log::info('Pembayaran masih pending', ['order_id' => $orderId]);
 } elseif ($status == 'deny') {
     $order->status = 'failed';
     Log::warning('Pembayaran ditolak', ['order_id' => $orderId]);
 }

 // Simpan status order
 $order->save();

 return response()->json(['status' => 'success']);
}


public function orderSuccess(Request $request)
{
    // // Mendapatkan order_id dari parameter query
    // $orderId = $request->query('order_id');

    // // Ambil order berdasarkan ID
    // $order = Order::findOrFail($orderId);

    // // Update status menjadi 'paid'
    // $order->status = 'paid';
    // $order->save();

    // Kirim order ke view
    return view('order_success');
}



}
