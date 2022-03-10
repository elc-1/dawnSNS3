<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


/*----------ログアウト中のページ----------*/
// //ログイン画面表示のみ
// Route::get('/login', 'Auth\LoginController@viewLogin')->name('viewLogin');
// //ログイン処理のみ
// Route::post('/store', 'Auth\LoginController@exeLogin')->name('exeLogin');


//新規登録画面の表示、データ送信
Route::get('/register', 'Auth\RegisterController@viewRegister');

//新規登録完了画面、データの受け取り
Route::get('/added', 'Auth\RegisterController@added');


/*----------ログイン中のページ----------*/
//top画面の表示
Route::get('/index','PostsController@index');

//投稿
Route::post('/tweet','PostsController@tweet');

//投稿の編集
Route::post('/post/update','PostsController@update');

//投稿削除処理
Route::get('/post/{id}/delete','PostsController@delete');



//フォローリストを表示する
Route::get('/followList','FollowsController@followList');
//フォロワーリストを表示する
Route::get('/followerList','FollowsController@followerList');

//フォローするボタン
Route::get('/{id}/follow','UsersController@follow');
//フォローを外すボタン
Route::get('/{id}/unFollow','UsersController@unFollow');


//マイプロフィール画面表示のみ
Route::get('/viewProfile','UsersController@viewProfile');
//マイプロフィール更新
Route::post('/updateProfile','UsersController@updateProfile');
//他ユーザープロフィール画面表示
Route::get('/{id}/profile','UsersController@viewOtherProfile');


//ユーザー検索画面表示のみ
Route::get('/search','UsersController@search');
//検索ボタン
Route::post('/searching','UsersController@searching');


//ログアウト処理
Route::get('/logout','Auth\LoginController@logout');

Auth::routes();
