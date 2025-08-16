<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->id(); // bigint unsigned primary keyのidカラム

            // categoriesテーブルのidを参照する外部キー。unsignedBigIntegerで符号なしのbigint型に
            $table->unsignedBigInteger('category_id');

            $table->string('first_name');  // 名前（姓）
            $table->string('last_name');   // 名前（名）

            $table->tinyInteger('gender'); // 性別。1:男性 2:女性 3:その他

            $table->string('email');       // メールアドレス
            $table->string('tel');         // 電話番号
            $table->string('address');     // 住所
            $table->string('building')->nullable(); // 建物名（null許容）

            $table->text('detail');        // お問い合わせ内容詳細

            $table->timestamps();          // created_at、updated_at タイムスタンプ

            // 外部キー制約設定
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            // onDelete('cascade') は、関連するカテゴリが削除されたら問い合わせも削除される設定
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contacts');
    }
}
