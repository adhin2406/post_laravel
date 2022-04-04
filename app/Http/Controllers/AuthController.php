<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function index()
    {
        $data = [
            "title" => "LOGIN - POSTT APP"
        ];

        return view("user.auth.login", $data);
    }

    public function daftar()
    {
        $data = [
            "title" => "DAFTAR - POSTT APP"
        ];

        return view("user.auth.daftar", $data);
    }

    public function handle_login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {

            return redirect()->intended('/')
                ->withSuccess('Kamu Berhasil Masuk');
        }
        return redirect("login")->withError('Maaf! email atau password salah');
    }

    public function handle_daftar(Request $request)
    {
        $this->validate($request, [
            'email'   => ['required', 'string', 'max:100', 'email', 'unique:user'],
            'nama'    => ['required', 'string', 'max:100'],
            'password' => ['required', 'min:8']
        ]);
        $save = $this->create($request->all());
        event(new Registered($save));
        Auth::loginUsingId($save->id_user);
        return redirect("/");
    }

    public function create($data)
    {
        return User::create([
            'email'    => $data['email'],
            'password' => Hash::make($data['password']),
            'nama'     => $data['nama']
        ]);
    }

    public function logout()
    {
        Session::flush();
        Auth::logout();

        return Redirect('login');
    }
}
