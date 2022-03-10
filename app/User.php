<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     * 可変項目：保存したいデータ＝データが変わってもいい物
     */
    protected $fillable = [
        'username', 'mail', 'password','bio','images',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'remember_token',
        'username',
        'mail',
        'password',
        'bio',
        'images',
        'created_at',
        'modified_at'
    ];

    /**
    * remember_tokenがカラムにないテーブルでAuth::logout時に存在しないremember_tokenが更新しようとしてエラーになるので無視する
    */
    public function setAttribute($key, $value)
    {
        if ($key !== $this->getRememberTokenName()) {
            parent::setAttribute($key, $value);
        }
    }

    // これでテーブルとの紐付けができる
    protected $table = 'users';

    //これでseederエラーをなくす
    public $timestamps = false;

}
