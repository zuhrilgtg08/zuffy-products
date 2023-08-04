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
                $cart = Keranjang::where('user_id', auth()->user()->id)
                                       ->where('status', '=', 'onList')->get();
                View::share('cart', $cart);
                
                $orders = Keranjang::with(['checkout', 'product'])->where('user_id', '<>', 1)->where('status', 'onList')->get();
                View::share('orders', $orders);
            }

            return $next($request);
        });
    }
}
