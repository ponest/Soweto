<?php

namespace Modules\Auth\Http\Controllers;

use App\Helpers\General;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Modules\Auth\Models\User;

class AuthController extends Controller
{

    public function index()
    {
        $params['errorMsg'] = "";
        return view('auth::index', $params);
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        $data = $request->only('email', 'password');
        $user = User::where('email', '=', $data['email'])->first();
        $pass = '12345';

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            if (Hash::check($pass, $user->password)) {
                session(['email' => $user->email]);
                return redirect()->route('change-pass');
            }
            $request->session()->regenerate();
            $notification = General::customMessage("Successfully Logged In", "success");
            return redirect()->route('dashboard')->with($notification);
        }

        $params['errorMsg'] = "The provided credentials are incorrect.";
        return view('auth::index', $params);
    }

    public function dashboard()
    {
        return view('auth::dashboards.main');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login.index');
    }

    public function changePasswordView()
    {
        $params['errorMsg'] = "";
        return view('auth::users.change_password', $params);
    }

    public function changePassword(Request $request)
    {
        $email = session('email');
        $data = $request->all();

        // Validate password strength
        $request->validate([
            'password' => [
                'required',
                'confirmed', // Ensures 'password' matches 'password_confirmation'
                Password::min(8) // Minimum length of 8
                ->mixedCase() // Requires uppercase and lowercase letters
                ->letters() // Requires at least one letter
                ->numbers() // Requires at least one number
                ->symbols() // Requires at least one special character
                ->uncompromised(), // Checks against known data breaches
            ],
        ]);

        // Retrieve user
        $user = User::where('email', $email)->first();

        // Update password
        $user->password = Hash::make($data['password']);
        $user->update();

        $notification = General::customMessage("Password Changed Successfully", "success");
        return redirect()->route('dashboard')->with($notification);
    }
}
