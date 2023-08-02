<?php

namespace App\Http\Controllers;

use App\Models\Keranjang;
use Illuminate\Support\Facades\View;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (auth()->user()) {
                $keranjang = Keranjang::where('user_id', auth()->user()->id)
                                       ->where('status', '=', 'unpaid')->get();
                View::share('cart', $keranjang);
                
                $orders = Keranjang::with('order', 'product')->where('user_id', '<>', 1)->where('status', 'unpaid')->get();
                View::share('order', $orders);
            }

            return $next($request);
        });
    }
}
