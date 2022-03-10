<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //これでテーブルとの紐付けができる
    protected $table = 'posts';

    //可変項目＝保存したい値＝データが変わってもいい物
    protected $fillable =
    [
        'user_id',
        'posts',
        'created_at'
    ];
}
