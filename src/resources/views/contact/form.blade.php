@extends('layouts.app')

{{-- ヘッダー枠は使わない（上の余白を消す） --}}
@section('header') @endsection

{{-- このページ専用CSS --}}
@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
<div class="contact-page">

    {{-- サイトタイトル --}}
    <h1 class="site-title">FashionablyLate</h1>

    {{-- ページタイトル --}}
    <h2 class="page-title">Contact</h2>

    <div class="contact-card">
        <form method="POST" action="{{ route('contact.confirm') }}">
            @csrf

            {{-- お名前（姓・名） --}}
            <div class="row">
                <label class="label">お名前 <span class="req">※</span></label>
                <div class="field">
                    <div class="name-split">
                        <input type="text" name="first_name" placeholder="例：山田" value="{{ old('first_name') }}">
                        <input type="text" name="last_name" placeholder="例：太郎" value="{{ old('last_name') }}">
                    </div>
                    @error('first_name') <p class="error">{{ $message }}</p> @enderror
                    @error('last_name') <p class="error">{{ $message }}</p> @enderror
                </div>
            </div>

            {{-- 性別 --}}
            <div class="row">
                <label class="label">性別 <span class="req">※</span></label>
                <div class="field">
                    <div class="radios">
                        <label class="radio"><input type="radio" name="gender" value="1" {{ old('gender','1')=='1'?'checked':'' }}> 男性</label>
                        <label class="radio"><input type="radio" name="gender" value="2" {{ old('gender')=='2'?'checked':'' }}> 女性</label>
                        <label class="radio"><input type="radio" name="gender" value="3" {{ old('gender')=='3'?'checked':'' }}> その他</label>
                    </div>
                    @error('gender') <p class="error">{{ $message }}</p> @enderror
                </div>
            </div>

            {{-- メールアドレス --}}
            <div class="row">
                <label class="label">メールアドレス <span class="req">※</span></label>
                <div class="field">
                    <input type="email" name="email" placeholder="例：test@example.com" value="{{ old('email') }}">
                    @error('email') <p class="error">{{ $message }}</p> @enderror
                </div>
            </div>

            {{-- 電話番号（機能はそのまま単一input） --}}
            <div class="row">
                <label class="label">電話番号 <span class="req">※</span></label>
                <div class="field">
                    <input type="text" name="tel" placeholder="例：08012345678" value="{{ old('tel') }}" maxlength="5" pattern="\d{1,5}">
                    @error('tel') <p class="error">{{ $message }}</p> @enderror
                </div>
            </div>

            {{-- 住所 --}}
            <div class="row">
                <label class="label">住所 <span class="req">※</span></label>
                <div class="field">
                    <input type="text" name="address" placeholder="例：東京都渋谷区千駄ヶ谷1-2-3" value="{{ old('address') }}">
                    @error('address') <p class="error">{{ $message }}</p> @enderror
                </div>
            </div>

            {{-- 建物名 --}}
            <div class="row">
                <label class="label">建物名</label>
                <div class="field">
                    <input type="text" name="building" placeholder="例：千駄ヶ谷マンション101" value="{{ old('building') }}">
                </div>
            </div>

            {{-- お問い合わせの種類 --}}
            <div class="row">
                <label class="label">お問い合わせの種類 <span class="req">※</span></label>
                <div class="field">
                    <div class="select-wrap">
                        <select name="category_id">
                            <option value="">選択してください</option>
                            @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id')==$category->id ? 'selected':'' }}>
                                {{ $category->content }}
                            </option>
                            @endforeach
                        </select>
                        <span class="select-arrow">▼</span>
                    </div>
                    @error('category_id') <p class="error">{{ $message }}</p> @enderror
                </div>
            </div>

            {{-- お問い合わせ内容 --}}
            <div class="row">
                <label class="label">お問い合わせ内容 <span class="req">※</span></label>
                <div class="field">
                    <textarea name="detail" rows="5" maxlength="120" placeholder="お問い合わせ内容をご記載ください">{{ old('detail') }}</textarea>
                    @error('detail') <p class="error">{{ $message }}</p> @enderror
                </div>
            </div>

            {{-- 送信ボタン --}}
            <div class="actions">
                <button type="submit" class="btn-primary">確認画面へ</button>
            </div>
        </form>
    </div>
</div>
@endsection