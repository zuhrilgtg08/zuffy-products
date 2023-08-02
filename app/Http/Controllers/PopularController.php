<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Reviews;
use Illuminate\Http\Request;

class PopularController extends Controller
{
    public function index()
    {
        $data = Product::with('reviews')->latest()->get();

        $review = $data->map(function ($query) {
            $ratings = Reviews::where('product_id', $query->id)->get();
            if ($ratings->count() == 0) {
                $query->rating = 0;
            } else {
                $total = $ratings->sum('rating') / $ratings->count();
                $query->rating = $total;
            }

            return $query;
        });

        $popular = $review->filter(fn ($product) => $product->rating > 3);
        
        return view('pages.customer.popular', ['popular' => $popular]);
    }
}
