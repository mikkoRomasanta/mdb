<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    // protected $redirectTo = '/';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function username()
    {
        return 'emp_id';
    }

    public function redirectTo(){
         // User role
        $role = Auth::user()->role; 
        $status = Auth::user()->status;

        if($status === 'TEMP'){
            return 'change-password';
        }
        
        switch ($role) {
            case 'USER':
                    return 'change-password';
                break;
            case 'ADMIN':
                    return '/';
                break; 
            default:
                    return '/'; 
                break;
        }
    }
}
