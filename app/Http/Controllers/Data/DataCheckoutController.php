<?php

namespace App\Http\Controllers\Data;
use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use App\Models\Checkouts;
use App\Models\Keranjang;
use Illuminate\Http\Request;

class DataCheckoutController extends Controller
{
    public function list()
    {
        $checkouts = Keranjang::with(['product', 'checkout', 'user'])
                                ->where('user_id', '<>', 1)
                                ->where('status', 'paid')
                                ->get();

        return view('pages.dashboard.adminOrder.index', [
            'checkouts' => $checkouts,
        ]);
    }

    public function detail(string $uuid)
    {
        $data = Checkouts::join('keranjangs', 'checkouts.id', '=', 'keranjangs.checkout_id')
                         ->join('provinces', 'checkouts.province_id', '=' ,'provinces.id')
                         ->join('cities', 'checkouts.destination_id', '=', 'cities.id')
                         ->join('users', 'users.id', '=', 'keranjangs.user_id')
                         ->join('products', 'products.id', '=', 'keranjangs.product_id')
                         ->where([
                            ['users.status_type', '=', 'customer'],
                            ['checkouts.uuid', '=', $uuid]
                         ])->get([
                            'products.name_product as nama_product',
                            'products.price_product as harga_product',
                            'checkouts.payment_link as bukti_pembayaran',
                            'checkouts.payment_status as order_status',
                            'checkouts.harga_ongkir as harga_ongkir',
                            'checkouts.layanan_ongkir as layanan_ongkir',
                            'checkouts.courier as kurir',
                            'checkouts.alamat as alamat_tujuan',
                            'checkouts.weight as total_berat',
                            'checkouts.total_amount as amount',
                            'checkouts.uuid as uuid',
                            'keranjangs.quantity as jumlah',
                            'users.name as nama_user',
                            'users.email as email_user',
                            'users.phone as phone',
                            'provinces.name_province as provinsi',
                            'cities.nama_kab_kota as kota',
                         ]);

        return view('pages.dashboard.adminOrder.detail', ['data' => $data]);
    }

    public function print()
    {
        $data = Keranjang::with(['product', 'checkout', 'user'])
                        ->where('status', '=', 'paid')->where('user_id', '<>', 1)->get();
        $pdf = PDF::loadView('pages.dashboard.adminOrder.print', ['data' => $data]);
        $pdf->setPaper('legal', 'landscape');
        return $pdf->download("data_Order_customer " . date('d-m-Y') . '.pdf');
    }
}
