<?php

namespace App\Http\Controllers\Data;
use App\Models\Categories;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Cviebrock\EloquentSluggable\Services\SlugService;

class DataCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.dashboard.adminCategory.index', [
            'categories' => Categories::get(['id', 'uuid', 'name_category', 'slug'])
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.dashboard.adminCategory.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'name_category' => 'required|string|unique:categories',
            'slug' => 'required|string'
        ]);

        $category = Categories::create($validateData);

        if($category) {
            return redirect()->route('admin.categories.index')->with('success', 'Now the category has been added!');
        } else {
            return redirect()->back()->with('fail', 'Sory, something wrong. Please correct again!');
        }   
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('pages.dashboard.adminCategory.edit', [
            'category' => Categories::findOrFail($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validateData = $request->validate([
            'name_category' => 'required|string|unique:categories',
            'slug' => 'required|string'
        ]);

        $category = Categories::findOrFail($id)->update($validateData);

        if($category) {
            return redirect()->back()->with('success', 'Success, now this category has been updated!');
        } else {
            return redirect()->back()->with('fail', 'Something error, please correct again!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Categories::find($id)->delete();
        return redirect()->route('admin.categories.index')->with('remove', 'Removed, now the category has been deleted!');
    }

    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(Categories::class, 'slug', $request->title);
        return response()->json(['slug' => $slug]);
    }
}
