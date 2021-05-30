<?php

namespace App\Http\Controllers\Auth;

use App\Events\Logined;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/admin';

    public function __construct()
    {
        $this->middleware('throttle:5, 1')->only('login');
        $this->middleware('guest')->except('logout');
    }

    public function username()
    {
        return 'email'; // Login with Email
    }

    protected function authenticated(Request $request, $user)
    {
        // Last Login
        event(new Logined());

        $user->update([
            'last_login_ip' => $request->getClientIp()
        ]);

        $request->session()->flash('welcome_msg', __("admin.welcome"));
    }
}
