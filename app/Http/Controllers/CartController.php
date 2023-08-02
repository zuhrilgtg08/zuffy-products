<?php

namespace App\Http\Controllers;

use App\Models\Keranjang;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function list()
    {
        return view('pages.customer.cartList');
    }

    public function store(Request $request)
    {

    }

    public function update(Request $request, string $id)
    {

    }

    public function destroy(string $id)
    {
        
    }
}
