<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $correo = $request->input('correo');
        $credentials = [
            'correo' => $correo,
            'password' => $request->input('password'),
        ];
        if (!Auth::attempt($credentials)) {
            return redirect()->back()->withErrors(['Autenticación fallida. Intente de nuevo.']);
        }
        $user = Auth::user();
        if ($user->roles_id === 1) {
            return redirect()->route('home');
        } else {
            return redirect()->route('taskxUser');
        }
    }
}
