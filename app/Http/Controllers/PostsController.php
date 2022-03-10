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
            'tweet' => 'required|max:100',
        ]);

        //Requestからデータの取得
        $tweet = $request->input('tweet');

        //現在ログイン中のユーザーidを取得
        $id = Auth::id();
        //一旦ランダムで
        // $id = mt_rand(1, 11);


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

        // //③既存ツイートの表示：user_id,posts,create_at,modified_at
        // $all_tweet = \DB::table('posts')->orderBy('create_at','desc')->get();
        // //④自分orフォローしている人のツイートだけを抽出する
        // $list = $all_tweet->whereIn('user_id',[$user_id,]);

        //データの取得,自分かフォローしている人だけ
        $list = \DB::table('posts')
                ->join('users','posts.user_id','=','users.id')
                ->join('follows','posts.user_id','follows.follower_id')
                ->select('users.username','users.images','posts.id','posts.user_id','posts.posts','posts.create_at')
                ->distinct()
                ->where('follows.follow_id',Auth::id())
                ->orWhere('users.id',Auth::id())
                ->orderBy('create_at','desc')
                ->get();

                // dd($list);

        //⑤編集モーダルへの読み込み用
        // $post = \DB::table('posts')->where('id', $id)->first();

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

        //データベースから呼び出した内容を送る
        return view('posts.index',[
            'list'=>$list,
            'username'=>$username,
            'user_id'=>$user_id,
            // 'post'=>$post,
            'count_follow'=>$count_follow,
            'count_follower'=>$count_follower,
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
