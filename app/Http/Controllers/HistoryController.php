<?php

namespace App\Http\Controllers;
use App\Models\Keranjang;
use App\Models\Checkouts;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

class HistoryController extends Controller
{
    public function list()
    {
        $list = Keranjang::with(['product', 'checkout', 'user'])
                         ->where('user_id', '=', Auth::user()->id)
                         ->where('status', '=', 'paid')
                         ->orderBy('id', 'ASC')->get();

        return view('pages.customer.history.list', [
            'list' => $list,
        ]);
    }

    public function detail(string $uuid)
    {
        $checkouts = Checkouts::where('uuid', '=', $uuid)->first();
        $keranjang = Keranjang::with(['product'])->where('checkout_id', '=', $checkouts->id)
                               ->where('status', '=', 'paid')->get();

        return view('pages.customer.history.detail', [
            'checkout' => $checkouts,
            'keranjang' => $keranjang,
        ]);
    }

    public function print(string $id)
    {
        $datas = Keranjang::with(['checkout', 'product'])->where('checkout_id', '=', $id)->get();
        $pdf = PDF::loadView('pages.customer.history.print', ['datas' => $datas]);
        return $pdf->stream();
    }
}
