<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index()
    {
        return view('pages.customer.auth.register');
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'username' => 'required|unique:users|max:255',
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'create_password' => 'required|min:8',
            'password' => 'required|same:create_password|min:8',
        ]);

        $validate['password'] = Hash::make($validate['password']);

        $data = User::create($validate);

        if($data) {
            return redirect()->route('login')->with('success', 'Now, your account has been created. Please Login!');
        } else {
            return redirect()->back()->with('fail', 'Sory something wrong. Please check again!');
        }
    }
}
