<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Order;
use Midtrans\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


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
    // Konfigurasi Midtrans
    \Midtrans\Config::$serverKey = config('midtrans.server_key');

            // Proses callback
        Log::info('Midtrans callback received: ', $request->all());
    
    // Ambil data dari callback Midtrans
    $orderId = $request->input('order_id');
    $statusCode = $request->input('status_code');
    $grossAmount = $request->input('gross_amount');
    $signatureKey = $request->input('signature_key');

    // Buat signature yang valid dari data yang diterima menggunakan SHA512
    $serverSignatureKey = hash('sha512', $orderId . $statusCode . $grossAmount . \Midtrans\Config::$serverKey);

    // Verifikasi signature
    if ($signatureKey !== $serverSignatureKey) {
        Log::warning('Invalid signature for order ID: ' . $orderId);
        return response()->json(['status' => 'error', 'message' => 'Invalid signature'], 403);
    }

    // Lakukan update status pesanan sesuai status dari Midtrans
    $order = Order::where('order_id', $orderId)->first();
    if (!$order) {
        return response()->json(['status' => 'error', 'message' => 'Order not found'], 404);
    }

    switch ($statusCode) {
        case '200': // Payment Success
            $order->status = 'Paid';
            break;
        case '202': // Payment Denied
            $order->status = 'Denied';
            break;
        case '407': // Payment Pending
            $order->status = 'Pending';
            break;
        default:
            $order->status = 'Unknown';
            break;
    }

    $order->save();

    return response()->json(['status' => 'success', 'message' => 'Callback processed']);
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
