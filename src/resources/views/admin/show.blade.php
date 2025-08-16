@extends('layouts.app')

@section('title','お問い合わせ詳細')
@section('body_class','is-admin-page')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin.css') }}">
@endsection

@section('header')
<div class="fl-admin-header">
    <h1 class="fl-admin-title">お問い合わせ詳細</h1>
</div>
@endsection

@section('content')
<div class="fl-admin fl-show">
    <div class="fl-card">
        <dl class="fl-show-grid">
            <dt>ID</dt>
            <dd>{{ $contact->id }}</dd>
            <dt>お名前</dt>
            <dd>{{ $contact->last_name }} {{ $contact->first_name }}</dd>
            <dt>性別</dt>
            <dd>{{ $contact->gender_text }}</dd>
            <dt>メールアドレス</dt>
            <dd>{{ $contact->email }}</dd>
            <dt>電話番号</dt>
            <dd>{{ $contact->tel }}</dd>
            <dt>住所</dt>
            <dd>{{ $contact->address }}</dd>
            <dt>建物名</dt>
            <dd>{{ $contact->building }}</dd>
            <dt>お問い合わせの種類</dt>
            <dd>{{ $contact->category->content ?? '-' }}</dd>
            <dt>お問い合わせ内容</dt>
            <dd class="fl-pre">{{ $contact->detail }}</dd>
            <dt>作成日</dt>
            <dd>{{ $contact->created_at }}</dd>
        </dl>

        <div class="fl-show-actions">
            <a href="{{ route('admin.index') }}" class="fl-btn fl-btn-outline">一覧に戻る</a>

            <form action="{{ route('admin.destroy', $contact->id) }}" method="POST" class="fl-inline"
                onsubmit="return confirm('削除しますか？');">
                @csrf
                @method('DELETE')
                <button type="submit" class="fl-btn fl-btn-danger">削除</button>
            </form>
        </div>
    </div>
</div>
@endsection