{{-- resources/views/contact/complete.blade.php --}}
@extends('layouts.app')

{{-- このページはページ上部の見出しを使わない --}}
@section('header') @endsection

{{-- このページ専用の CSS を読み込む（public/css/thanks.css） --}}
@section('css')
<link rel="stylesheet" href="{{ asset('css/thanks.css') }}">
@endsection

@section('content')
<div class="thanks-page">
    <div class="thanks-hero">
        <p class="thanks-message">お問い合わせありがとうございました</p>
        <a href="{{ route('contact.form') }}" class="btn-home">HOME</a>
    </div>
</div>
@endsection