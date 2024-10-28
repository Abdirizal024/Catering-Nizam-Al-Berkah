<?php

namespace App\Http\Controllers;

use Midtrans\Config;
use App\Models\Order;
use Illuminate\Http\Request;
use Midtrans\Transaction;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    public function __construct()
    {
        // Set Midtrans Configuration
        Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        Config::$isProduction = false; // Set to true for production
        Config::$isSanitized = true;
        Config::$is3ds = true;
    }

    // Callback function
    public function callback(Request $request)
    {
        // Get JSON response from Midtrans
        $notification = json_decode($request->getContent(), true);

        // Get the transaction status and order ID
        $transactionStatus = $notification['transaction_status'];
        $orderId = $notification['order_id'];

        // Find the order by its ID
        $order = Order::findOrFail($orderId);

        // Check transaction status
        if ($transactionStatus == 'capture' || $transactionStatus == 'settlement') {
            // Update the order status to 'paid'
            $order->status = 'paid';
        } elseif ($transactionStatus == 'expire') {
            // Update the order status to 'expired'
            $order->status = 'expired';
        } elseif ($transactionStatus == 'cancel' || $transactionStatus == 'deny') {
            // Update the order status to 'failed'
            $order->status = 'failed';
        }

        // Save the updated order status
        $order->save();

        return response()->json(['message' => 'Notification handled successfully'], 200);
    }


}
