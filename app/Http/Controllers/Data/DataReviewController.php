<?php

namespace App\Http\Controllers\Data;
use App\Models\Product;
use App\Models\Reviews;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DataReviewController extends Controller
{
    public function index()
    {
        $data = Product::with('reviews')->latest()->get();

        $review = $data->map(function ($query) {
            $ratings = Reviews::where('product_id', $query->id)->get();
            if($ratings->count() == 0) {
                $query->rating = 0;
            } else {
                $total = $ratings->sum('rating') / $ratings->count();
                $query->rating = $total;
            }

            return $query;
        });

        $list = $review->filter(fn($product) => $product->rating >= 1);

        return view('pages.dashboard.adminReview.index', [
            'list' => $list
        ]);
    }

    public function detail(string $uuid)
    {
        $product = Product::where('uuid', $uuid)->first();
        $data = Reviews::join('products', 'products.id', '=', 'reviews.product_id')
                        ->join('users', 'users.id', 'reviews.user_id')
                        ->where('products.uuid', $uuid)
                        ->get([
                            'users.name',
                            'users.image_profile',
                            'users.email',
                            'users.job',
                            'reviews.rating',
                            'reviews.coments'
                        ]);
                        
        return view('pages.dashboard.adminReview.detail', [
            'data' => $data,
            'product' => $product,
        ]);
    }

    public function destroy(string $id)
    {
        Reviews::where('product_id', $id)->delete();
        return redirect()->route('admin.reviews.index')->with('remove', 'Review this product has been deleted!');
    }
}
