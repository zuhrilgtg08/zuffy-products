<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Alamat;
use App\Models\Cities;
use App\Models\Provinces;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class SettingCustomerController extends Controller
{
    public function profile(string $username)
    {
        $data = User::with(['alamat'])->where('username', $username)->first();
        $provinsi = Provinces::get(['id', 'name_province']);
        $kota = Cities::join('provinces', 'provinces.id', '=', 'cities.province_id')
                        ->get(['cities.id', 'cities.nama_kab_kota', 'cities.province_id']);
        $dataAlamat = Alamat::where('user_id', '=', Auth::user()->id)->latest()->first();
        
        return view('pages.customer.profile.edit', [
            'data' => $data,
            'provinsi' => $provinsi,
            'kota' => $kota,
            'dataAlamat' => $dataAlamat,
        ]);
    }

    public function listKota(string $id)
    {
        $cities = Cities::where('province_id', '=', $id)->get(['id', 'nama_kab_kota']);
        return response()->json($cities);
    }

    public function dataAlamat(Request $request, string $id)
    {
        $validate = $request->validate([
            'user_id' => 'required',
            'provinsi_id' => 'required',
            'kota_id' => 'required',
            'keterangan_alamat' => 'string|required'
        ]);

        if(Auth::user()->status_type !== 'admin') $validate['user_id'] = Auth::user()->id;

        $alamat = Alamat::where('user_id', '=', Auth::user()->id)->latest()->first();

        if($alamat == null) {
            Alamat::create($validate);
            return redirect()->back()->with('success', 'Data address has been created!');
        } else {
            Alamat::where('user_id', $id)->update($validate);
            return redirect()->back()->with('success', 'Data address has been updated!');
        }
    }

    public function update(Request $request, string $id)
    {
        $data = User::findOrFail($id);
        $validate = $request->validate([
            'name' => 'nullable|string|max:255',
            'username' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'phone' => 'nullable|numeric|min:1',
            'tgl_lahir' => 'date_format:Y-m-d|nullable',
            'job' => 'string|nullable|max:255',
            'image_profile' => 'file|mimes:jpg,jpeg,png|max:2048',
            'about_only' => 'string|required',
            'agama' => 'string|max:255',
        ]);

        if ($request->file('image_profile')) {
            if ($request->oldImage) {
                Storage::delete($request->oldImage);
            }
            $validate['image_profile'] = $request->file('image_profile')->store('images-customer');
        }

        $phone = $request->phone;
        if ($phone) {
            $result = sprintf("%s-%s-%s", substr($phone, 0, 4), substr($phone, 4, 4), substr($phone, 8));
            $validate['phone'] = $result;
        }

        $data->update($validate);

        if($data) {
            return redirect()->back()->with('success', 'Now your profile data has been updated!');
        } else {
            return redirect()->back()->with('fail', 'Sory something when wrong. Please correct again!');
        }
    }

    public function updatePwd(Request $request, string $id)
    {
        $data = User::findOrFail($id);

        $request->validate([
            'current_password' => 'required|string|min:8',
            'create_password' => 'required|string|min:8',
            'confirm_password' => 'required|same:create_password|string|min:8'
        ]);

        if ($data) {
            if (Hash::check($request->current_password, $data->password)) {
                if ($request->create_password == $request->confirm_password) {
                    User::find($id)->update([
                        'password' => Hash::make($request->create_password)
                    ]);
                    return redirect()->back()->with('success', 'Password has been changes!');
                } else {
                    return redirect()->back()->with('fail', 'Sory new password not same with confimr password!');
                }
            } else {
                return redirect()->back()->with('fail', 'Password is not changes. Please correct again!');
            }
        }
    }
}