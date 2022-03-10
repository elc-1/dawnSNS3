<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
    //これでテーブルとの紐付けができる
    protected $table = 'follows';

    //可変項目＝保存したい値＝データが変わってもいい物
    protected $fillable =
    [
        'follow_id',
        'follower_id',
        'created_at'
    ];
}
