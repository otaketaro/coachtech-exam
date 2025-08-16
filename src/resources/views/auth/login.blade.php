{{-- resources/views/auth/login.blade.php --}}
@extends('layouts.app')

{{-- ヘッダー枠は使わない --}}
@section('header') @endsection

{{-- このページ専用CSS --}}
@section('css')
<link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection

@section('content')
<div class="login-page">
    {{-- 上部バー（サイトタイトル＋register） --}}
    <div class="login-topbar">
        <div class="brand">FashionablyLate</div>
        <a href="{{ route('register') }}" class="btn-outline">register</a>
    </div>

    {{-- 見出し --}}
    <h1 class="login-title">Login</h1>

    {{-- カード --}}
    <div class="login-card">
        <form method="POST" action="{{ route('login.post') }}">
            @csrf

            {{-- メールアドレス --}}
            <div class="form-group">
                <label for="email" class="form-label">メールアドレス</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}"
                    placeholder="例: test@example.com"
                    class="form-input @error('email') is-invalid @enderror" required autofocus>
                @error('email')
                <p class="form-error">{{ $message }}</p>
                @enderror
            </div>

            {{-- パスワード --}}
            <div class="form-group">
                <label for="password" class="form-label">パスワード</label>
                <input id="password" type="password" name="password"
                    placeholder="例: coachtechno6"
                    class="form-input @error('password') is-invalid @enderror" required>
                @error('password')
                <p class="form-error">{{ $message }}</p>
                @enderror
            </div>

            {{-- ボタン --}}
            <div class="actions">
                <button type="submit" class="btn-primary">ログイン</button>
            </div>
        </form>
    </div>
</div>
@endsection{{-- resources/views/auth/login.blade.php --}}
@extends('layouts.app')

{{-- ヘッダー枠は使わない --}}
@section('header') @endsection

{{-- このページ専用CSS --}}
@section('css')
<link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection

@section('content')
<div class="login-page">
    {{-- 上部バー（サイトタイトル＋register） --}}
    <div class="login-topbar">
        <div class="brand">FashionablyLate</div>
        <a href="{{ route('register') }}" class="btn-outline">register</a>
    </div>

    {{-- 見出し --}}
    <h1 class="login-title">Login</h1>

    {{-- カード --}}
    <div class="login-card">
        <form method="POST" action="{{ route('login.post') }}">
            @csrf

            {{-- メールアドレス --}}
            <div class="form-group">
                <label for="email" class="form-label">メールアドレス</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}"
                    placeholder="例: test@example.com"
                    class="form-input @error('email') is-invalid @enderror" required autofocus>
                @error('email')
                <p class="form-error">{{ $message }}</p>
                @enderror
            </div>

            {{-- パスワード --}}
            <div class="form-group">
                <label for="password" class="form-label">パスワード</label>
                <input id="password" type="password" name="password"
                    placeholder="例: coachtechno6"
                    class="form-input @error('password') is-invalid @enderror" required>
                @error('password')
                <p class="form-error">{{ $message }}</p>
                @enderror
            </div>

            {{-- ボタン --}}
            <div class="actions">
                <button type="submit" class="btn-primary">ログイン</button>
            </div>
        </form>
    </div>
</div>
@endsection