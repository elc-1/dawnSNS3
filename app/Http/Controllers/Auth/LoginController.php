<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

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

    /**
     * Where to redirect users after login.
     * ログインした後の表示
     * @var string
     */
    //homeから変更
    protected $redirectTo = '/index';

    /**
     * Create a new controller instance.
     * Auth::routes();はここに飛んでくる
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * ログアウト処理
     * ログアウト後の表示画面はログイン画面
     */
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
