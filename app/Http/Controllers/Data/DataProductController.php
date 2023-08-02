<?php

namespace App\Http\Controllers\Data;

use App\Models\Worker;
use App\Models\Product;
use App\Models\Categories;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class DataProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.dashboard.adminProduct.index', [
            'products' => Product::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.dashboard.adminProduct.create', [
            'categories' => Categories::get(),
            'workers' => Worker::get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'name_product' => 'required|string',
            'weight_product' => 'required|numeric|min:1',
            'category_id' => 'required|max:255',
            'worker_id' => 'required|max:255',
            'stock_product' => 'required|numeric|min:1',
            'price_product' => 'required|integer|min:1000',
            'desc_product' => 'string|required',
            'image_product' => 'file|mimes:png,jpeg,jpg|max:2040'
        ]);

        if($request->file('image_product')) {
            $validateData['image_product'] = $request->file('image_product')->store('image-products');
        }

        $validateData['excerpt'] = Str::limit(strip_tags($request->desc_product), 100);

        $product = Product::create($validateData);

        if ($product) {
            return redirect()->route('admin.products.index')->with('success', 'Success, now the new product has been created!');
        } else {
            return redirect()->back()->with('fail', 'Something error, please correct again!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('pages.dashboard.adminProduct.detail', [
            'detail' => Product::findOrFail($id)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('pages.dashboard.adminProduct.edit', [
            'category' => Categories::get(['id', 'name_category']),
            'worker' => Worker::get(['id', 'fullname']),
            'oneProduct' => Product::findOrFail($id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validateData = $request->validate([
            'name_product' => 'required|string',
            'weight_product' => 'required|numeric|min:1',
            'category_id' => 'required|max:255',
            'worker_id' => 'required|max:255',
            'stock_product' => 'required|numeric|min:1',
            'price_product' => 'required|integer|min:1000',
            'desc_product' => 'string|required',
            'image_product' => 'file|mimes:png,jpeg,jpg|max:2040'
        ]);

        if ($request->file('image_product')) {
            if ($request->oldImage) {
                Storage::delete($request->oldImage);
            }
            $validateData['image_product'] = $request->file('image_product')->store('image-products');
        }

        $validateData['excerpt'] = Str::limit(strip_tags($request->desc_product), 100);

        $product = Product::findOrFail($id)->update($validateData);

        if($product) {
            return redirect()->back()->with('success', 'Success, now this product has been updated!');
        } else {
            return redirect()->back()->with('fail', 'Something error, please correct again!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::find($id);

        if($product->image_product) {
            Storage::delete($product->image_product);
        }

        $product->delete();

        return redirect()->route('admin.products.index')->with('remove', 'Removed, now the product has been deleted!');
    }
}
