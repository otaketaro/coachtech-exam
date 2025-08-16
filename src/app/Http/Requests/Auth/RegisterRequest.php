<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * 誰でも送信できるようにする
     */
    public function authorize()
    {
        return true;
    }

    /**
     * バリデーションルール
     */
    public function rules()
    {
        return [
            'name'                  => ['required', 'string', 'max:255'],
            'email'                 => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password'              => ['required', 'string', 'min:8', 'confirmed'],
        ];
    }

    /**
     * エラーメッセージ
     */
    public function messages()
    {
        return [
            'name.required'         => 'お名前を入力してください',
            'email.required'        => 'メールアドレスを入力してください',
            'email.email'           => 'メールアドレスは「ユーザー名@ドメイン」形式で入力してください',
            'email.unique'          => 'このメールアドレスは既に登録されています',
            'password.required'     => 'パスワードを入力してください',
            'password.min'          => 'パスワードは8文字以上で入力してください',
            'password.confirmed'    => 'パスワード確認が一致しません',
        ];
    }
}
