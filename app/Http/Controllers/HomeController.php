<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Reviews;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $allData = Product::join('reviews as review', 'review.product_id', '=', 'products.id')
                          ->join('users as user', 'review.user_id', '=', 'user.id')
                          ->select([
                            'products.id as id',
                            'user.image_profile as user_image',
                            'user.job as user_job',
                            'user.name as user_name',
                            'review.coments as comments',
                          ])->get();

        $rows = $allData->map(function($query) {
            $rate = Reviews::where('product_id', $query->id)->get();
            if ($rate->count() == 0) {
                $query->rating = 0;
            } else {
                $total = $rate->sum('rating') / $rate->count();
                $query->rating = $total;
            }

            return $query;
        });

        $data = $rows->filter(fn ($value) => $value->rating >= 2.5);

        return view('pages.index', [
            'review' => $data,
            'data' => Product::latest()->filter(request(['search']))->paginate(6)->withQueryString(),
        ]);
    }

    public function detailProduct(string $uuid)
    {
        $data = Product::with('reviews')->where('uuid', '=', $uuid)->first();

        $dataReview = Reviews::where([
                            ['product_id', '=', $data->id],
                            ['user_id', '=', Auth::user()->id],
                        ])->get();

        $komentar = null;
        foreach ($dataReview as $val) {
            $komentar = $val->coments;
        }

        return view('pages.customer.detailProduct', [
            'data' => $data,
            'review' =>  $dataReview,
            'komentar' => $komentar,
        ]);
    }

    public function addReviews(Request $request)
    {
        $review = Reviews::where([
                            ['product_id', $request->product_id],
                            ['user_id', Auth::user()->id],
                        ])->first();

        if($review !== null) {
            $review->update([
                'rating' => $request->rating,
                'coments' => $request->coments,
            ]);
            return redirect()->back()->with('success', 'Your review has been updated!');
        } else {
            $review = Reviews::create([
                'user_id' => Auth::user()->id,
                'product_id' => $request->product_id,
                'rating' => $request->rating,
                'coments' => $request->coments
            ]);
            return redirect()->back()->with('success', 'Your review has been created one!');
        }
    }
}
