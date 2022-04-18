<?php

namespace App\Http\Controllers;

use App\User;
use App\Follow;
use Illuminate\Http\Request;
//これを入れてAuthのユーザー情報を受け取る
use Illuminate\Support\Facades\Auth;
//これでValidatorが動く
use Illuminate\Support\Facades\Validator;

class UsersController extends Controller
{

    /**
     * 検索ページ
     * 表示のみ
     * $idを受け取って
     */
    public function search(){

        //①usernameの取得：username
        $username = Auth::user();
        //②user_idの取得：user_id
        $user_id = Auth::id();
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
        //⑧ユーザー一覧を返す
        $result = \DB::table('users')
                ->select('username','id','images')
                ->get();
                // dd($pre_result);
        //⑨チェック用のfollowerを取り出す
        $check1 = \DB::table('follows')
                ->where('follow_id',$user_id)
                ->select('follower_id')
                ->get()
                ->toArray();
                // dd($check1);
        $check = array_column($check1,'follower_id');
                // dd($check);

        // login.phpのユーザーアイコン用
        //コレクションで取得
        $my_img = \DB::table('users')
                  ->select('images')
                  ->where('id',Auth::id())
                  ->first();

        return view('users.search',[
            'username' => $username,
            'user_id' => $user_id,
            'count_follow' => $count_follow,
            'count_follower' => $count_follower,
            'result' => $result,
            'check' => $check,
            'my_img' => $my_img,
        ]);

    }

    /**
     * 検索機能
     * 引数は検索フォーム
     */
    public function searching(Request $request){

        //検索フォームの入力を抽出
        $search_word = $request->input('search');

        //①usernameの取得：username
        $username = Auth::user();
        //②user_idの取得：user_id
        $user_id = Auth::id();
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
        //⑨チェック用のfollowerを取り出す
        $check1 = \DB::table('follows')
                ->where('follow_id',$user_id)
                ->select('follower_id')
                ->get()
                ->toArray();
        $check = array_column($check1,'follower_id');

        // login.phpのユーザーアイコン用
        //コレクションで取得
        $my_img = \DB::table('users')
                  ->select('images')
                  ->where('id',Auth::id())
                  ->first();


        //入力ありの場合
        //issetはnullが偽
        if(isset($search_word)){
            //検索
            $result = \DB::table('users')
                ->where('username','like','%'.$search_word.'%')
                ->get();

            return view('users.search',[
                'search_word'=>$search_word,//ここにはnullが入ってる
                'username'=>$username,
                'result' => $result,
                'count_follow'=>$count_follow,
                'count_follower'=>$count_follower,
                'check'=>$check,
                'my_img' => $my_img,
            ]);
        }

        //未入力でユーザー一覧を返す
        $result = \DB::table('users')
                ->select('username','images','id')
                ->get();

        return view('users.search',[
            'search_word'=>$search_word,
            'username'=>$username,
            'result' => $result,
            'count_follow'=>$count_follow,
            'count_follower'=>$count_follower,
            'check'=>$check,
            'my_img' => $my_img,
        ]);
    }

    /**
     * フォローボタン
     *
     */
    public function follow($id){

        \DB::table('follows')->insert([
            'follow_id' => Auth::id(),
            'follower_id' => $id,
        ]);

        return redirect('/search');
    }

    /**
     * フォロー外すボタン
     *
     */
    public function unFollow($id){

        \DB::table('follows')
            ->where('follow_id',Auth::id())
            ->where('follower_id',$id)
            ->delete();

        return redirect('/search');
    }

    /**
     * プロフィール画面の表示
     */
    public function viewProfile()
    {
        $user = \DB::table('users')
                ->where('id', Auth::id())
                ->get();
        // dd($user);

        $hash_pass = \DB::table('users')
                ->where('id', Auth::id())
                ->select('password')
                ->first();

        //①username
        $username = Auth::user();

        //②フォローしている人のidの取得、カウント：int
        $follow = \DB::table('follows')
        ->where('follow_id',Auth::id())
        ->get(['follower_id']);
        $count_follow = count($follow);

        //③フォローされている人のidの取得、カウント：int
        $follower = \DB::table('follows')
        ->where('follower_id',Auth::id())
        ->get(['follow_id']);
        $count_follower = count($follower);

        // login.phpのユーザーアイコン用
        //コレクションで取得
        $my_img = \DB::table('users')
                  ->select('images')
                  ->where('id',Auth::id())
                  ->first();

        return view('users.profile2',[
            'user' => $user,
            'username' => $username,
            'count_follow' => $count_follow,
            'count_follower' => $count_follower,
            'hash_pass' => $hash_pass,
            'my_img' => $my_img,
        ]);
    }


    /**
     * ログイン者以外のプロフィール
     */
    public function viewOtherProfile($id)
    {
        $user = \DB::table('users')
                ->join('posts','users.id','=','posts.user_id')
                ->where('users.id',$id)
                ->select('users.id','users.username','users.mail','users.password','users.bio','users.images','posts.user_id','posts.posts','posts.create_at')
                ->get();
        // dd($user);
        //①username
        $username = Auth::user();

        //②フォローしている人のidの取得、カウント：int
        $follow = \DB::table('follows')
        ->where('follow_id',Auth::id())
        ->get(['follower_id']);
        $count_follow = count($follow);

        //③フォローされている人のidの取得、カウント：int
        $follower = \DB::table('follows')
        ->where('follower_id',Auth::id())
        ->get(['follow_id']);
        $count_follower = count($follower);

        //⑨チェック用のfollowerを取り出す
        $check1 = \DB::table('follows')
                ->where('follow_id',Auth::id())
                ->select('follower_id')
                ->get()
                ->toArray();
        $check = array_column($check1,'follower_id');

        // login.phpのユーザーアイコン用
        //コレクションで取得
        $my_img = \DB::table('users')
                  ->select('images')
                  ->where('id',Auth::id())
                  ->first();

        return view('users.profile2',[
            'user' => $user,
            'username' => $username,
            'count_follow' => $count_follow,
            'count_follower' => $count_follower,
            'check' => $check,
            'my_img' => $my_img,
        ]);
    }



    /**
     * プロフィールの編集処理
     */
    public function updateProfile(Request $request)
    {
        //validationルール
        $rules = [
            'username' => 'required|min:4|max:12',
            'mail' => 'required|email|min:4|max:20',
            //新しいパスワードと古いパスワードの判別ができていない
            'new_password' => 'nullable|min:4|max:12',
            'bio' => 'max:200',
        ];
        //エラーメッセージ
        $message = [
            'username.min' => 'ユーザー名は4文字以上で入力してください。',
            'username.max' => 'ユーザー名は12文字以内で入力してください。',
            'username.required' => 'ユーザー名は入力必須です。',
            'mail.min' => 'メールアドレスは４文字以上で入力してください。',
            'mail.max' => 'メールアドレスは12文字以内で入力してください。',
            'mail.required' => 'メールアドレスは入力必須です。',
            'mail.email' => 'アドレス形式で入力してください。',
            'new_password.min' => 'パスワードは４文字以上で入力してください。',
            'new_password.max' => 'パスワードは12文字以内で入力してください。',
            'bio.max' => '自己紹介文は200文字以内で入力してください。',
        ];


        //validatorを使用する
        $validator = Validator::make($request->all(), $rules, $message);

        //validationチェック
        if($validator->fails()) {
            return redirect('/viewProfile')
            ->withErrors($validator)
            ->withInput();
        };


        //入力データの取得
        $username = $request->input('username');
        $mail = $request->input('mail');
        $bio = $request->input('bio');
        //これは存在確認のために取得
        $prof_image = $request->file('prof_image');
        $new_password = $request->input('new_password');
        // dd($prof_image);

        //画像の更新があるのか確認する
        if(isset($prof_image))
        {
            //画像入力があった場合
            //imagesファイルに名前をそのまま保存する
            $file_name = $prof_image->getClientOriginalName();
            $prof_image->storeAs('', $file_name, 'public');
            // dd($file_name);ok

            // 更新処理
            \DB::table('users')
                ->where('id', Auth::id())
                ->update([
                    'images' => $file_name,
                ]);
        }else{
            //画像の入力が無かった場合
            //更新もいから何もしない
        };


        //new_passwordがあるかないかをissetで判断して、ないならそのまま今のパスワードを再登録
        //issetはnullでないのが真
        //何も変更しなくてもこれだとupdate_atが更新されてしまう
        if(isset($new_password))
        {
            //new_passwordがあった場合
            $new_password = $request->input('new_password');
            \DB::table('users')
                ->where('id', Auth::id())
                ->update([
                    'username' => $username,
                    'mail' => $mail,
                    'password' => $new_password,
                    'bio' => $bio,
                    'modified_at' => now(),
                ]);

            return redirect('/viewProfile');

        }else{
            //new_passwordが無かった場合
            //new_passwordは取得しない
            \DB::table('users')
                ->where('id', Auth::id())
                ->update([
                    'username' => $username,
                    'mail' => $mail,
                    'bio' => $bio,
                    'modified_at' => now(),
                ]);

            return redirect('/viewProfile');
        };

    }

};
