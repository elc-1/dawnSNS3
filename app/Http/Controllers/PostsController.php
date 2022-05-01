<?php

namespace App\Http\Controllers;

use App\Post;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
//これを入れてAuthのユーザー情報を受け取る
use Illuminate\Support\Facades\Auth;


class PostsController extends Controller
{
    /**
     * ツイート
     * Requestには入力された内容が入っている
     * それをここで受け取ってからテーブルに登録する
     * これもうまくpostsテーブルに登録できてる
     */
    public function tweet(Request $request){

        // バリデーションチェック
        $request->validate([
            'tweet' => 'required|max:150',
        ]);

        //Requestからデータの取得
        $tweet = $request->input('tweet');

        //現在ログイン中のユーザーidを取得
        $id = Auth::id();

        //これがデータベースへの登録
        //左側にカラム名
        \DB::table('posts')->insert([
            'user_id' => $id,
            'posts' => $tweet,
        ]);

        return redirect('index');
    }



    /**
     * ユーザー情報の表示
     * つぶやきのデータ取得
     * フォロワーのデータも取得
     */
    public function index(){
        //ここでのPostとかUserはデータベース名でもなく、『モデル名』
        //Modelとの接続
        // 目的：内容物

        //①usernameの取得：username
        $username = Auth::user();

        //②user_idの取得：user_id
        $user_id = Auth::id();

        //データの取得,自分かフォローしている人だけ
        //distinctは重複削除
        $list = \DB::table('users')
                ->join('posts','users.id','=','posts.user_id')
                ->leftJoin('follows','users.id','=','follows.follower_id')
                ->select('users.username','users.images','posts.user_id','posts.posts','posts.create_at','posts.id')
                ->where('follows.follow_id', Auth::id())
                ->orWhere('posts.user_id', Auth::id())
                ->orderBy('create_at','desc')
                ->distinct()
                ->get();

                // dd($list);

        //⑥フォローしている人のidの取得、カウント：int
        $follow = \DB::table('follows')
        ->where('follow_id',$user_id)
        ->get(['follower_id']);
        $count_follow = count($follow);

        //⑦フォローされている人のidの取得、カウント：int
        $follower = \DB::table('follows')
        ->where('follower_id',$user_id)
        ->get(['follow_id']);
        $count_follower = count($follower);

        //ツイートフォームへの表示用画像の取得
        // login.phpのユーザーアイコン用
        //コレクションで取得
        $my_img = \DB::table('users')
                  ->select('images')
                  ->where('id',Auth::id())
                  ->first();

                //   dd($my_img);

        //データベースから呼び出した内容を送る
        return view('posts.index',[
            'list'=>$list,
            'username'=>$username,
            'user_id'=>$user_id,
            // 'post'=>$post,
            'count_follow'=>$count_follow,
            'count_follower'=>$count_follower,
            'my_img'=>$my_img,
        ]);
    }


    /**
     * ツイートの削除処理
     * これはうまく動作してる
     */
     public function delete($id)
    {
        \DB::table('posts')
            ->where('id', $id)
            ->delete();

        return redirect('/index');
    }

    /**
     * ツイートの編集処理
     */
    public function update(Request $request)
    {
        $post_id = $request->input('post_id');
        $up_post = $request->input('update');
        // dd($up_post);
        \DB::table('posts')
            ->where('id', $post_id)
            ->update(
                ['posts' => $up_post]
            );

        return redirect('/index');
    }

}
