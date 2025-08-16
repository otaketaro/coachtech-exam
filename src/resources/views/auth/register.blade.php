@extends('layouts.app')

@section('title', 'Register')

{{-- このページだけ body にクラスを付与して背景を切り替える --}}
@section('body_class', 'is-register-page')

{{-- ページ専用CSS（public/css/register.css を読み込む） --}}
@section('css')
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection

{{-- レイアウトのヘッダー枠：タイトル＋右上loginリンク --}}
@section('header')
<div class="fl-header">
    <h1 class="fl-page-title">Register</h1>
    <a href="{{ route('login') }}" class="fl-login-link">login</a>
</div>
@endsection

@section('content')
<div class="fl-auth-register">
    <div class="fl-auth-register__card">
        <form method="POST" action="{{ route('register') }}" novalidate>
            @csrf

            <div class="fl-auth-register__group">
                <label for="name" class="fl-auth-register__label">お名前</label>
                <input id="name" name="name" type="text" value="{{ old('name') }}"
                    placeholder="例：山田　太郎"
                    class="fl-auth-register__input @error('name') is-invalid @enderror" required autofocus>
                @error('name') <p class="fl-auth-register__error">{{ $message }}</p> @enderror
            </div>

            <div class="fl-auth-register__group">
                <label for="email" class="fl-auth-register__label">メールアドレス</label>
                <input id="email" name="email" type="email" value="{{ old('email') }}"
                    placeholder="例：test@example.com"
                    class="fl-auth-register__input @error('email') is-invalid @enderror" required>
                @error('email') <p class="fl-auth-register__error">{{ $message }}</p> @enderror
            </div>

            <div class="fl-auth-register__group">
                <label for="password" class="fl-auth-register__label">パスワード</label>
                <input id="password" name="password" type="password"
                    placeholder="例：coachtech1106"
                    class="fl-auth-register__input @error('password') is-invalid @enderror" required>
                @error('password') <p class="fl-auth-register__error">{{ $message }}</p> @enderror
            </div>

            <div class="fl-auth-register__actions">
                <button type="submit" class="fl-auth-register__btn">登録</button>
            </div>
        </form>
    </div>
</div>
@endsection