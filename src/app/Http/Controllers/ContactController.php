<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest; // フォームリクエストを使用
use App\Models\Category;
use App\Models\Contact;

class ContactController extends Controller
{
    /**
     * お問い合わせフォームの入力画面を表示
     */
    public function showForm()
    {
        $categories = Category::all(); // カテゴリー一覧を取得
        return view('contact.form', compact('categories'));
    }

    /**
     * 確認画面を表示（フォームリクエストでバリデーション済み）
     */
    public function confirm(ContactRequest $request)
    {
        // バリデーション済みデータを取得
        $validated = $request->validated();

        // 確認画面に渡す
        return view('contact.confirm', compact('validated'));
    }

    /**
     * 送信処理
     */
    public function send(ContactRequest $request)
    {
        // バリデーション済みデータを取得
        $validated = $request->validated();

        // データベースに保存
        Contact::create($validated);

        // 送信完了ページへリダイレクト
        return redirect()->route('contact.complete');
    }

    /**
     * サンクスページ表示
     */
    public function complete()
    {
        return view('contact.complete');
    }
}
