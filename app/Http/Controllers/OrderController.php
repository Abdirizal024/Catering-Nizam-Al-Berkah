<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Order;
use Midtrans\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Events\NewOrderNotification;


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
            'status' => 'Pending',
            'quantity' => $request->quantity,
            'total_price' => $totalPrice,
        ]);

        // Trigger event setelah pesanan dibuat
        event(new NewOrderNotification($order));

        // Arahkan ke halaman detail
        return redirect()->route('order.details', $order->id);
    }


    public function details($id, Request $request)
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

    public function invoice($id)
    {
        // Logika untuk menampilkan invoice berdasarkan ID
        $order = Order::findOrFail($id);

        // Jika pesanan tidak ditemukan atau statusnya tidak sesuai, kembali ke dashboard dengan pesan error
        if (!$order) {
            return redirect()->route('dashboard')->with('error', 'Pesanan tidak ditemukan.');
        }

        // Tampilkan halaman invoice dengan data pesanan
        return view('invoice', compact('order'));
    }




    public function handleCallback(Request $request)
{
    // Log data dari notifikasi Midtrans
    Log::info('Menerima notifikasi dari Midtrans', $request->all());

    // Ambil notifikasi dari Midtrans
    $notification = $request->all();
    $orderId = $notification['order_id'];
    $status = $notification['transaction_status'];
    $fraud = $notification['fraud_status'] ?? null; // Fraud status mungkin tidak ada untuk metode tertentu
    $paymentMethod = $notification['payment_type']; // Metode pembayaran (qris, bank transfer, dll)
    $transactionId = $notification['transaction_id'] ?? null; // ID transaksi Midtrans
    $bank = $notification['va_numbers'][0]['bank'] ?? $notification['payment_type']; // Bank untuk bank transfer atau metode lainnya

    // Cari order berdasarkan ID
    $order = Order::where('id', explode('-', $orderId)[0])->first();

    if (!$order) {
        Log::error('Order tidak ditemukan', ['order_id' => $orderId]);
        return response()->json(['status' => 'error', 'message' => 'Order tidak ditemukan'], 404);
    }

    // Proses status transaksi
    if ($status === 'capture') {
        // Untuk kartu kredit, status capture dapat berupa accept atau challenge
        if ($fraud === 'accept') {
            $order->status = 'Sudah Dibayar';
            $order->paid_at = now(); // Simpan waktu pembayaran
        } else {
            $order->status = 'Failed'; // Transaksi fraud
            Log::warning('Transaksi ditandai sebagai fraud', ['order_id' => $orderId]);
        }
    } elseif ($status === 'settlement') {
        $order->status = 'Sudah Dibayar';
        $order->paid_at = now(); // Simpan waktu penyelesaian pembayaran
    } elseif ($status === 'pending') {
        $order->status = 'Pending';
        $order->paid_at = null; // Hapus waktu pembayaran jika sebelumnya ada
    } elseif ($status === 'deny') {
        $order->status = 'Failed';
        $order->paid_at = null;
    } elseif ($status === 'expire') {
        $order->status = 'Expired';
        $order->paid_at = null;
    } elseif ($status === 'cancel') {
        $order->status = 'Cancelled';
        $order->paid_at = null;
    }

    // Simpan detail pembayaran
    $order->payment_method = $paymentMethod;
    $order->transaction_id = $transactionId;
    $order->bank = $bank;

    // Simpan perubahan pada database
    $order->save();

    Log::info('Status order diperbarui', [
        'order_id' => $orderId,
        'status' => $order->status,
        'payment_method' => $paymentMethod,
        'transaction_id' => $transactionId,
        'bank' => $bank,
    ]);

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
