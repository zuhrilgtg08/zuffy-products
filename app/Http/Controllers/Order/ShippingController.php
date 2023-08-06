<?php

namespace App\Http\Controllers\Order;

use App\Models\Alamat;
use App\Models\Cities;
use App\Models\Keranjang;
use App\Models\Provinces;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Checkouts;
use Illuminate\Support\Facades\Auth;

class ShippingController extends Controller
{
    public function getCity(string $id)
    {
        $data = Cities::where('province_id', '=', $id)->get(['id', 'nama_kab_kota', 'province_id']);
        return response()->json($data);
    }

    public function cekOngkir(string $destination, $weight, string $courier)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.rajaongkir.com/starter/cost",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "origin=444&destination=$destination&weight=$weight&courier=$courier",
            CURLOPT_HTTPHEADER => array(
                "content-type: application/x-www-form-urlencoded",
                "key: 91dd56b26cc7b9a58d9c1112b28d9244"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            $response = json_decode($response, true);
            $data_ongkir = $response['rajaongkir']['results'];
            return json_encode($data_ongkir);
        }
    }

    public function create()
    {
        $keranjang = Keranjang::with(['product'])->where([
                                ['user_id', '=', Auth::user()->id],
                                ['status', '<>', ['ordered', 'paid']]
                            ])->get();
        $alamat = Alamat::with(['user'])->where('user_id', '=', Auth::user()->id)->first(['id', 'user_id', 'provinsi_id', 'kota_id', 'keterangan_alamat']);
        $kota = Cities::where('province_id', '=', $alamat->provinsi_id)->get(['id', 'nama_kab_kota', 'province_id']);
        $provinsi = Provinces::get(['id', 'name_province']);
        $totalWeight = 0;
        $totalAmount = 0;
        $quantity = 0;

        foreach($keranjang as $data) {
            $quantity += $data->quantity;
            $totalWeight += $data->product->weight_product * $data->quantity;
            $totalAmount += $data->product->price_product * $data->quantity;
        }

        return view('pages.customer.shipping', [
            'alamat' => $alamat,
            'provinsi' => $provinsi,
            'kota' => $kota,
            'weight' => $totalWeight,
            'total_amount' => $totalAmount,
            'quantity' => $quantity,
        ]);
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'province_id' => 'required',
            'destination_id' => 'required',
            'courier' => 'required|string|max:150',
            'weight' => 'numeric|required|min:1',
            'harga_ongkir' => 'required|numeric|integer',
            'layanan_ongkir' => 'required|string',
            'total_amount' => 'required|numeric|integer',
            'alamat' => 'required|string',
        ]);

        $shipping = Checkouts::create($validate);

        $datas = Keranjang::with(['checkout', 'product'])->where([
                                ['user_id', '=', Auth::user()->id],
                                ['status', '<>', ['ordered', 'paid']]
                            ])->get();

        foreach($datas as $data) {
            $data->product->update([
                'stock_product' => $data->product->stock_product - $data->quantity,
            ]);

            $data->update([
                'checkout_id' => $shipping->id,
                'status' => 'ordered'
            ]);
        }

        if($shipping) {
            return redirect()->route('checkout.create')->with('success', 'Your product has been ordered, Please payment now!');
        } else {
            return redirect()->back()->with('fail', 'Something when wrong, please correct order again!');
        }
    }
}
