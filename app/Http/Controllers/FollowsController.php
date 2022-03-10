<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//これを入れてAuthのユーザー情報を受け取る
use Illuminate\Support\Facades\Auth;

class FollowsController extends Controller
{
    /**
     * フォローリストの表示
     */
    public function followList()
    {
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


        // followerListとは結合条件が違う。最終的にはfollows.follower_idが欲しいんだから、users.idと繋げることになる
        //④フォローしている人のid,images,posts,create_at
        $list = \DB::table('users')
                ->join('follows','users.id','=','follows.follower_id')
                ->join('posts','users.id','=','posts.user_id')
                ->select('users.id','users.images','posts.create_at','posts.posts')
                ->where('follows.follow_id',Auth::id())
                ->orderBy('create_at','desc')
                ->get();
                // dd($list);

        return view('follows.followList',[
            'list'=>$list,
            'username'=>$username,
            'count_follow'=>$count_follow,
            'count_follower'=>$count_follower,
        ]);
    }

    /**
     * フォロワーリストの表示
     */
    public function followerList()
    {
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

        //④フォローされている人のid,images,posts,create_at
        $list = \DB::table('users')
                ->join('follows','users.id','=','follows.follow_id')
                ->join('posts','users.id','=','posts.user_id')
                ->select('users.id','users.images','posts.create_at','posts.posts')
                ->where('follows.follower_id',Auth::id())
                ->orderBy('create_at','desc')
                ->get();
                // dd($list);

        return view('follows.followList',[
            'list'=>$list,
            'username'=>$username,
            'count_follow'=>$count_follow,
            'count_follower'=>$count_follower,
        ]);
    }

}
