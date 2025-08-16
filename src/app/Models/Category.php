<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    // テーブル名を指定（省略可。Laravelの規約通りなら不要）
    // protected $table = 'categories';

    // 代入可能なカラムを指定（必要に応じて）
    protected $fillable = ['content'];
}
