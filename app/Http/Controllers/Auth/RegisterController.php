<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
//これを入れてAuthのユーザー情報を受け取る
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;



    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *  新規登録のバリデーション
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'username' => 'required|min:4|max:12',
            'mail' => 'required|email|min:4|max:12|unique:users',
            'password' => 'required|min:4|max:12',
            'password-confirm' => 'required|min:4|max:12|same:password',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'username' => $data['username'],
            'mail' => $data['mail'],
            'password' => bcrypt($data['password']),
        ]);
    }

    /**
     * 新規登録後の表示
     */
    public function redirectPath()
    {
        return 'added';
    }

    /**
     * ルート用
     */
    public function added()
    {
        $user = Auth::user();
        return view('auth.added', [
            'user' => $user,
        ]);
    }

    /**
     * 無理やりだけど、新規登録後の遷移先変更は
     * これでオーバーライドできているらしい
     */
    // public function register(Request $request)
    // {
    //     $this->validator($request->all())->validate();
    //     event(new Registered($user = $this->create($request->all())));
    //     return redirect(route('added'));
    // }
}
