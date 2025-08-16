<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
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
            'first_name'   => 'required',
            'last_name'    => 'required',
            'gender'       => 'required|in:1,2,3',
            'email'        => 'required|email',
            'tel'          => ['required', 'regex:/^\d{1,5}$/'],
            'address'      => 'required',
            'building'     => 'nullable|string',
            'detail'       => 'required|max:120',
            'category_id'  => 'required|exists:categories,id',
        ];
    }

    /**
     * エラーメッセージ
     */
    public function messages()
    {
        return [
            'first_name.required'  => '姓を入力してください',
            'last_name.required'   => '名を入力してください',
            'gender.required'      => '性別を選択してください',
            'gender.in'            => '性別の値が不正です',
            'email.required'       => 'メールアドレスを入力してください',
            'email.email'          => 'メールアドレスはメール形式で入力してください',
            'tel.required'         => '電話番号を入力してください',
            'tel.regex'            => '電話番号は5桁までの数字で入力してください',
            'address.required'     => '住所を入力してください',
            'detail.required'      => 'お問い合わせ内容を入力してください',
            'detail.max'           => 'お問合せ内容は120文字以内で入力してください',
            'category_id.required' => 'お問い合わせの種類を選択してください',
            'category_id.exists'   => 'お問い合わせの種類が不正です',
        ];
    }
}
