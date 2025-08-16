<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * ログインフォームを表示
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * ログイン処理
     */
    public function login(LoginRequest $request)
    {
        // バリデーション済みの値を取得
        $credentials = $request->validated();

        // remember の値を取得（チェックされているかどうか）
        $remember = $request->has('remember');

        // 認証試行
        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();

            return redirect()->intended(route('admin.index'));
        }

        // 認証失敗
        return back()->withErrors([
            'email' => 'メールアドレスかパスワードが正しくありません。',
        ])->onlyInput('email');
    }

    /**
     * ログアウト処理
     */
    public function logout()
    {
        Auth::logout();

        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect()->route('login');
    }
}
