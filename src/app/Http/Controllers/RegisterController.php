<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    /**
     * 新規登録フォームの表示
     */
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    /**
     * ユーザー登録処理
     */
    public function register(RegisterRequest $request)
    {
        // フォームリクエストでバリデーション済みデータを取得
        $validated = $request->validated();

        // ユーザー作成
        $user = User::create([
            'name'     => $validated['name'],
            'email'    => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        // ログイン処理
        Auth::login($user);

        // ダッシュボードへリダイレクト
        return redirect()->route('dashboard');
    }
}