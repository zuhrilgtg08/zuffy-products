<?php

namespace App\Http\Controllers;

use App\Models\Keranjang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function list()
    {
        $list = Keranjang::with(['user', 'product'])->where([
                            ['user_id', '=', Auth::user()->id],
                            ['status', '=', 'onList']
                        ])->get();
        $qty = 0;
        $amount = 0;
        foreach ($list as $data) {
            if($data->quantity >= $data->product->stock_product) {
                $amount += $data->product->stock_product * $data->product->price_product;
                $qty += $data->product->stock_product;
            } else {    
                $amount += $data->quantity * $data->product->price_product;
                $qty += $data->quantity;
            }
        }
        
        return view('pages.customer.cartList', [
            'qty' => $qty,
            'list' => $list,
            'amount' => $amount,
        ]);
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'product_id' => 'required',
        ]);

        $datas = Keranjang::with('product')->where('product_id', '=', $request->product_id)->get();

        foreach ($datas as $data) {
            if($data->quantity > $data->product->stock_product) {
                $data['quantity'] = $data->quantity;
                return redirect()->route('keranjang.list')->with('fail', 'Sory, you ordered more than the available product stock limit!');
            } else {
                $data->quantity;
            }
        }

        $cartCheck = Keranjang::where([
                            ['product_id', '=', $request->product_id],
                            ['user_id', '=', Auth::user()->id],
                            ['status', '<>', 'paid']
                        ])->first();
        
        $cartDatas = Keranjang::with('product')->where([
                            ['product_id', '=', $request->product_id],
                            ['user_id', '=', Auth::user()->id]
                        ])->get();

        if($cartCheck) {
            if(($request->quantity + $cartDatas[0]->quantity) > $cartDatas[0]->product->stock_product) 
                return redirect()->route('keranjang.list')->with('fail', 'Sory, you ordered more than the available product stock limit!');
            
            if($request->quantity) {
                $cartCheck->update(['quantity' => $cartCheck->quantity + $request->quantity]);
            } else {
                $cartCheck->update(['quantity' => $cartCheck->quantity + 1]);
            }

            $validate['user_id'] = Auth::user()->id;
            $validate['status'] = 'onList';
            $validate['checkout_id'] = 0;
        } else {
            foreach ($cartDatas as $data) {
                if($data->product_id) {
                    $validate['user_id'] = Auth::user()->id;
                    $validate['quantity'] = $request->quantity;
                    $validate['status'] = 'onList';
                    $validate['checkout_id'] = 0;
                }
            }

            $validate['user_id'] = Auth::user()->id;
            $validate['quantity'] = $request->quantity;
            $validate['status'] = 'onList';
            $validate['checkout_id'] = 0;
            Keranjang::create($validate);
        }
        return redirect()->route('keranjang.list')->with('success', 'Your order has been added to the cart!');
    }

    public function update(Request $request, string $id)
    {
        $validate = [
            'quantity' => $request->quantity,
        ];

        if ($validate['quantity'] <= 0 || $request->quantity <= 0) {
            Keranjang::findOrFail($id)->delete();
            return redirect()->route('keranjang.list')->with('fail', 'Your order has been deleted to the cart!');
        } else {
            Keranjang::findOrFail($id)->update($validate);
            return redirect()->route('keranjang.list')->with('success', 'Your order has been updated to the cart!');
        }
    }

    public function destroy(string $id)
    {
        Keranjang::findOrFail($id)->delete();
        return redirect()->route('keranjang.list')->with('fail', 'Your order has been deleted to the cart!');
    }
}
