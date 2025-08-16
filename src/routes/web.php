<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\RegisterController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// フォーム入力画面
Route::get('/', [ContactController::class, 'showForm'])->name('contact.form');

// 確認画面
Route::post('/confirm', [ContactController::class, 'confirm'])->name('contact.confirm');

// 送信処理（完了ページにリダイレクト）
Route::post('/send', [ContactController::class, 'send'])->name('contact.send');

// サンクスページ（完了ページ）
Route::get('/thanks', [ContactController::class, 'complete'])->name('contact.complete');

// ユーザ登録ページ
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// ログインページ
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
// ログイン処理（POST）
Route::post('/login', [LoginController::class, 'login'])->name('login.post');
// ★ 追加：ログアウト（ヘッダー右上の「logout」用）
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// 認証済み専用の管理画面ルート
Route::middleware(['auth'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/admin/{id}', [AdminController::class, 'show'])->name('admin.show');
    Route::delete('/admin/{id}', [AdminController::class, 'destroy'])->name('admin.destroy');
});
