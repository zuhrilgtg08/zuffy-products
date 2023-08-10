<?php

namespace App\Http\Controllers\Order;
use Xendit\Invoice;
use App\Models\Checkouts;
use App\Models\Keranjang;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class CheckoutsController extends Controller
{
    public function create()
    {
        $order = Keranjang::with(['product', 'checkout', 'user'])->where([
                            ['user_id', '=', Auth::user()->id],
                            ['status', '=', 'ordered'],

        ])->get();

        $pay = Checkouts::get();

        $name_user = null;
        $email_user = null;
        $courier = null;
        $price_shipping = 0;
        $payment_link = null;
        $payment_status = null;
        $amount = 0;

        foreach($order as $item) {
            $name_user = $item->user->name;
            $email_user = $item->user->email;
        }

        foreach($pay as $data) {
            $amount = ($data->harga_ongkir + $data->total_amount);
            $payment_link = $data->payment_link;
            $payment_status = $data->payment_status;
            $courier = $data->courier;
            $price_shipping = $data->harga_ongkir;
        }

        return view('pages.customer.payment', [
            'order' => $order,
            'payment_link' => $payment_link,
            'payment_status' => $payment_status,
            'amount' => $amount,
            'price_shipping' => $price_shipping,
            'courier' => $courier,
            'name_user' => $name_user,
            'email_user' => $email_user,
        ]);
    }

    public function storePayment(Request $request)
    {
        $order = Keranjang::with(['checkout'])->get();
        $uuid = null;
        foreach ($order as $data) {
            $uuid = $data->checkout->uuid;
        }
        $secret_key = 'Basic ' . config('xendit.key_auth');
        $external_id = $uuid;
        $data_request = Http::withHeaders(['Authorization' => $secret_key])
            ->post('https://api.xendit.co/v2/invoices', [
                'external_id' => $external_id,
                'amount' => $request->amount,
                'payment_methods' => [
                    'BCA', 'BNI', 'BRI', 'MANDIRI', 
                    'ALFAMART', 'INDOMARET', 'OVO', 'DANA'
                ],
            ]);

        $response = $data_request->object();

        $checkouts = Checkouts::get();

        foreach($checkouts as $item) {
            if($item->payment_status !== 'PAID' || $item->payment_status == null) {
                $item->update([
                    'payment_link' => $response->invoice_url,
                    'payment_status' => $response->status,
                ]);
            } 
        }

        return redirect()->back()->with('success', 'berhasil pay');
    }

    public function paymentCallback(Request $request)
    {
        $data = $request->all();
        $status = $data['status'];
        $external_id = $data['external_id'];
        $cart = Keranjang::with(['checkout'])->get();

        foreach($cart as $item) {
            if($item->status === 'ordered') {
                $item->update([
                    'status' => 'paid'
                ]);
            }

            if($item->checkout->uuid == $external_id) {
                $item->checkout->update([
                    'payment_status' => $status
                ]);
            }

            return redirect()->back()->with('success', 'berhasil payment!');
        }
        return response()->json($data);
    }
}
