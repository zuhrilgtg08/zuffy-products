<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Categories;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function index()
    {
        return view('pages.customer.csCategory.index', [
            'listCategory' => Categories::get(['id', 'uuid', 'name_category', 'slug']),
            'product' => Product::get(),
        ]);
    }
}
