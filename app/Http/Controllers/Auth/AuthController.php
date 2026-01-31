<?php

namespace App\Http\Controllers\Auth;

use App\Enums\AuthEnums;
use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest;
use App\Models\User;
use App\Repositories\AuthRepositoryEloquent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function postLogin(Request $request)
    {
        $messages = [
            'email.exists' => 'Email not found',
            'email.required' => 'Email is required',
            'email.email' => 'Email is not valid',
            'password.required' => 'Password is required',
            'password.min' => 'Password must be at least 6 characters',
        ];

        $request->validate([
            'email' => 'required|email|email:rfc,dns|exists:users,email',
            'password' => 'required|min:6'
        ], $messages);

        $user = User::where('email', $request->email)->where('password', Hash::make($request->password))->first();

        if (!$user && Auth::attempt($request->only('email', 'password'))) {
            $user = Auth::user();
        }
        if ($user && $user->hasRole(AuthEnums::User->value)) {
            Auth::login($user);
            return redirect()->route('root')->with('success', 'Login successfully');
        }
        return back()->withErrors([
            'email' => 'Email or password is incorrect',
        ]);
    }

    public function register()
    {
        return view('auth.register');
    }

    public function postRegister(AuthRequest $request, AuthRepositoryEloquent $authRepo)
    {
        $user = $authRepo->storeByRequest($request);
        $user->assignRole(AuthEnums::User);
        
        return to_route('login')->with('success', 'User register successfully');
    }

    public function logout(User $user)
    {
        Auth::logout();
        return to_route('root')->with('success', 'Logout successfully');
    }
}
