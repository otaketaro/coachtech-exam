<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'gender',
        'email',
        'tel',
        'address',
        'building',
        'detail',
        'category_id',
    ];

    /**
     * カテゴリー情報のリレーション
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * 性別の文字列化
     */
    public function getGenderTextAttribute()
    {
        return match ($this->gender) {
            1 => '男性',
            2 => '女性',
            default => 'その他',
        };
    }
}
