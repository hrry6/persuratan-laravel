<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class AuthController extends Controller
{
    public function __construct()
    {
        //$this->middleware('isAdmin')->except(['login','logout']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        if(!Auth::user())
        {
            return view('Login.login');
        }else{
            return redirect()->to('dashboard/surat');
        }
    }

    public function login(Request $request){
        $akun = $request->validate(
            [
                'username' => ['required'],
                'password' => ['required']
            ]
            );
        if(Auth::attempt($akun))
        {
            $request->session()->regenerate();
            return redirect()->to('dashboard/surat');
        }
        else
        {
            return redirect()->to('/');
        }
    }

    public function logout(){
        Auth::logout();
        return redirect()->to('/');
    }
}