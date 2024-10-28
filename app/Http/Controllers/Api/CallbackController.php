<?php

namespace App\Http\Controllers\Api;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

class CallbackController extends Controller
{
    public function callback(Request $request)
    {
        // Dapatkan data dari callback
        $data = $request->all();

        // Log data untuk debugging
        Log::info('Midtrans Callback:', $data);

        // Ambil order_id dari data yang dikirim
        $orderId = $data['order_id'] ?? null;

        // Validasi order_id
        if (!$orderId) {
            return response()->json(['message' => 'Invalid order_id'], 400);
        }

        // Temukan order berdasarkan order_id
        $order = Order::where('id', $orderId)->first();

        // Jika order tidak ditemukan
        if (!$order) {
            return response()->json(['message' => 'Order not found'], 404);
        }

        // Update status berdasarkan status dari Midtrans
        switch ($data['transaction_status']) {
            case 'settlement':
                $order->status = 'paid';
                break;

            case 'expire':
                $order->status = 'expired';
                break;

            // Tambahkan case lain sesuai kebutuhan
            default:
                // Jika status lain, Anda bisa mengatur logika di sini
                break;
        }

        // Simpan perubahan status
        $order->save();

        // Kembalikan respons sukses
        return response()->json(['message' => 'Status updated successfully']);
    } public function handlecallback(Request $request)
    {
        // Dapatkan data dari callback
        $data = $request->all();

        // Log data untuk debugging
        Log::info('Midtrans Callback:', $data);

        // Ambil order_id dari data yang dikirim
        $orderId = $data['order_id'] ?? null;

        // Validasi order_id
        if (!$orderId) {
            return response()->json(['message' => 'Invalid order_id'], 400);
        }

        // Temukan order berdasarkan order_id
        $order = Order::where('id', $orderId)->first();

        // Jika order tidak ditemukan
        if (!$order) {
            return response()->json(['message' => 'Order not found'], 404);
        }

        // Update status berdasarkan status dari Midtrans
        switch ($data['transaction_status']) {
            case 'settlement':
                $order->status = 'paid';
                break;

            case 'expire':
                $order->status = 'expired';
                break;

            // Tambahkan case lain sesuai kebutuhan
            default:
                // Jika status lain, Anda bisa mengatur logika di sini
                break;
        }

        // Simpan perubahan status
        $order->save();

        // Kembalikan respons sukses
        return response()->json(['message' => 'Status updated successfully']);
    }
}
