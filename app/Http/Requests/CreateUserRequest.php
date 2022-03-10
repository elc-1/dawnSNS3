<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


// 新規ユーザー登録のバリデーションを行うクラス
class CreateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     * バリデーションのルールを記載する
     * @return array
     */
    public function rules()
    {
        return [
            'username' => 'required|max:20',
            'mail' => 'required|email|max:100',
            'password' => 'required|min:6|confirmed',
        ];
    }
}
