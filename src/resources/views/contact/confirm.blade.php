@extends('layouts.app')

{{-- ヘッダー余白は使わない --}}
@section('header') @endsection

{{-- このページ専用CSS --}}
@section('css')
<link rel="stylesheet" href="{{ asset('css/confirm.css') }}">
@endsection

@section('content')
@php
// 既存実装に合わせて $validated を使用
$genderText = [
1 => '男性',
2 => '女性',
3 => 'その他',
][$validated['gender'] ?? null] ?? '';

// カテゴリ名（そのままビューで取得：機能は現状維持）
$category = \App\Models\Category::find($validated['category_id']);
$categoryText = $category->content ?? '-';
@endphp

<div class="confirm-page">
    <h1 class="site-title">FashionablyLate</h1>
    <h2 class="page-title">Confirm</h2>

    <div class="confirm-card">
        <form method="POST" action="{{ route('contact.send') }}">
            @csrf

            <table class="confirm-table">
                <tbody>
                    <tr>
                        <th>お名前</th>
                        <td>{{ $validated['first_name'] }}　{{ $validated['last_name'] }}</td>
                    </tr>
                    <tr>
                        <th>性別</th>
                        <td>{{ $genderText }}</td>
                    </tr>
                    <tr>
                        <th>メールアドレス</th>
                        <td>{{ $validated['email'] }}</td>
                    </tr>
                    <tr>
                        <th>電話番号</th>
                        <td>{{ $validated['tel'] }}</td>
                    </tr>
                    <tr>
                        <th>住所</th>
                        <td>{{ $validated['address'] }}</td>
                    </tr>
                    <tr>
                        <th>建物名</th>
                        <td>{{ $validated['building'] ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>お問い合わせの種類</th>
                        <td>{{ $categoryText }}</td>
                    </tr>
                    <tr>
                        <th>お問い合わせ内容</th>
                        <td class="pre-wrap">{!! nl2br(e($validated['detail'])) !!}</td>
                    </tr>
                </tbody>
            </table>

            {{-- 値を保持（機能維持） --}}
            <input type="hidden" name="first_name" value="{{ $validated['first_name'] }}">
            <input type="hidden" name="last_name" value="{{ $validated['last_name'] }}">
            <input type="hidden" name="gender" value="{{ $validated['gender'] }}">
            <input type="hidden" name="email" value="{{ $validated['email'] }}">
            <input type="hidden" name="tel" value="{{ $validated['tel'] }}">
            <input type="hidden" name="address" value="{{ $validated['address'] }}">
            <input type="hidden" name="building" value="{{ $validated['building'] ?? '' }}">
            <input type="hidden" name="category_id" value="{{ $validated['category_id'] }}">
            <input type="hidden" name="detail" value="{{ $validated['detail'] }}">

            <div class="actions">
                <button type="submit" class="btn-primary">送信</button>
                <button type="button" class="btn-secondary" onclick="history.back()">修正</button>
            </div>
        </form>
    </div>
</div>
@endsection