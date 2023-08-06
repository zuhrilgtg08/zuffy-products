<?php

namespace App\Http\Controllers\Order;
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
                            ['status', '=', 'ordered']
        ])->get();

        $pay = Checkouts::all();

        $payment_link = null;
        $payment_status = null;
        $amount = 0;

        foreach($pay as $data) {
            $amount += ($data->harga_ongkir + $data->total_amount);
            $payment_link = $data->payment_link;
            $payment_status = $data->payment_status;
        }

        return view('pages.customer.payment', [
            'order' => $order,
            'payment_link' => $payment_link,
            'payment_status' => $payment_status,
            'amount' => $amount,
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

        foreach($order as $item) {
            $item->update(['status' => 'paid']);
            $item->checkout->update([
                'payment_link' => $response->invoice_url,
                'payment_status' => $response->status,
            ]);
        }

        return redirect()->back()->with('success', 'berhasil pay');
    }

    public function paymentCallback(Request $request)
    {
        $data = request()->all();
        dd($data);
        $status = $data['status'];
        $external_id = $data['external_id'];

        Checkouts::where('uuid', '=',  $external_id)->update([
            'payment_status' => $status
        ]);

        return response()->json($data);
    }
}
