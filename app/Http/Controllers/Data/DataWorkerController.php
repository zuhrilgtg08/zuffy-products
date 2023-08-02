<?php

namespace App\Http\Controllers\Data;

use App\Models\Cities;
use App\Models\Worker;
use App\Models\Provinces;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class DataWorkerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.dashboard.adminWorker.index', [
            'worker' => Worker::get(),
        ]);
    }

    public function getCity(string $id)
    {
        $cities = Cities::where('province_id', '=', $id)->get(['id', 'nama_kab_kota']);
        return response()->json($cities);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.dashboard.adminWorker.create',[
            'provinsi' => Provinces::get(['id', 'name_province']),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'fullname' => 'required|string|max:255',
            'username' => 'required|string|unique:workers',
            'w_provinsi_id' => 'required',
            'w_kota_id' => 'required',
            'tgl_lahir' => 'required|date_format:Y-m-d',
            'bio_worker' => 'string|required',
            'w_ket_alamat' => 'string|max:255|required',
            'image_profile_worker' => 'file|mimes:jpg,jpeg,png|max:2048',
        ]);

        if($request->file('image_profile_worker')) {
            $validateData['image_profile_worker'] = $request->file('image_profile_worker')->store('image-workers');
        }

        $worker = Worker::create($validateData);

        if($worker) {
            return redirect()->route('admin.workers.index')->with('success', 'Success, now the new worker has been added!');
        } else {
            return redirect()->back()->with('fail','Something error, please correct again!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('pages.dashboard.adminWorker.detail', [
            'worker' => Worker::findOrFail($id),
            'provinsi' => Provinces::get(['id', 'name_province']),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('pages.dashboard.adminWorker.edit', [
            'worker' => Worker::findOrFail($id),
            'provinsi' => Provinces::get(['id', 'name_province']),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validateData = $request->validate([
            'fullname' => 'required|string|max:255',
            'username' => 'required|string|unique:workers',
            'w_provinsi_id' => 'required',
            'w_kota_id' => 'required',
            'tgl_lahir' => 'required|date_format:Y-m-d',
            'bio_worker' => 'string|required',
            'w_ket_alamat' => 'string|max:255|required',
            'image_profile_worker' => 'file|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->file('image_profile_worker')) {
            if ($request->oldImage) {
                Storage::delete($request->oldImage);
            }
            $validateData['image_profile_worker'] = $request->file('image_profile_worker')->store('image-workers');
        }

        $worker = Worker::findOrFail($id)->update($validateData);

        if ($worker) {
            return redirect()->back()->with('success', 'Success, now the worker has been updated!');
        } else {
            return redirect()->back()->with('fail', 'Something error, please correct again!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $worker = Worker::find($id);

        if ($worker->image_profile_worker) {
            Storage::delete($worker->image_profile_worker);
        }

        $worker->delete();
    
        return redirect()->route('admin.workers.index')->with('remove', 'Removed, now the worker has been deleted!');
    }
}
