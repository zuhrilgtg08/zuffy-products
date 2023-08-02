<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\FlareClient\Http\Exceptions\NotFound;

class LoginController extends Controller
{
    public function index()
    {
        return view('pages.customer.auth.login');
    }

    public function authenticate(request $request)
    {
        $validate = $request->validate([
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => 'required|min:8',
        ]);

        if(Auth::attempt($validate)) {
            $request->session()->regenerate();

            if(Auth::user()->status_type == 'admin') {
                return redirect()->intended('/admin/manage_dashboard');
            } else {
                return redirect()->intended('/home'); 
            }
        }

        return redirect()->back()->with('fail', 'Something email or password wrong, please correct again!');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
