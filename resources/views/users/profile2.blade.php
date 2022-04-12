@extends('layouts.login')

@section('content')


@foreach ($user as $user)
    <!-- 単純にここで送られてきた$userがログイン者か、別ユーザーか判断する -->
    @if($user->id == Auth::id())
        <div class="wrap_form">

            <div class="profile_box1">
                <img src="/images/{{ $user->images }}" class="bigImg profileImg">
            </div>

            <div class="profile_box2">
                <p class="profile_tag">UserName</p>
                <br>
                <p class="profile_tag">MailAddress</p>
                <br>
                <p class="profile_tag">Password</p>
                <br>
                <p class="profile_tag">new Password</p>
                <br>
                <p class="profile_tag">Bio</p>
                <br>
                <p class="profile_tag adjust">Icon Image</p>
                <br>
            </div>

            <div class="profile_box3">

                <form action="/updateProfile" method="post" enctype="multipart/form-data">

                    {{ Form::text('username',$user->username,['class'=>'profile_form']) }}
                    @if($errors->has('username'))
                        {{ $errors->first('username') }}
                    @endif
                    <br>

                    {{ Form::text('mail',$user->mail,['class'=>'profile_form']) }}
                    @if($errors->has('mail'))
                        {{ $errors->first('mail') }}
                    @endif
                    <br>

                    <!-- 変更不可の表示のみのパスワードにする為、disabledを使用。値の送信も行わない。 -->
                    {{ Form::input('password','password',$user->password,['class'=>'profile_form','disabled']) }}
                    <br>

                    {{ Form::text('new_password','',['class'=>'profile_form']) }}
                    @if($errors->has('new_password'))
                        {{ $errors->first('new_password') }}
                    @endif
                    <br>

                    {{ Form::text('bio',$user->bio,['class'=>'profile_form bio']) }}
                    @if($errors->has('bio'))
                        {{ $errors->first('bio') }}
                    @endif
                    <br>

                    <input id="dummy_file" type="text" class="profile_form form_file">
                    <label for="filename">
                        <span class="browse_btn">ファイルを選択</span>
                        <input type="file" size="16" id="filename">
                    </label>
                    @if($errors->has('file'))
                        {{ $errors->first('file') }}
                    @endif

                    <button type="submit" class="update btn">更新</button>

                </form>
            </div>

        </div>
        <!-- たくさん繰り返されるので一回で止める -->
        @break
    @else
        <!-- ここにログインユーザー以外のプロフィールを表示 -->
        <!-- プロフィール部分だけは一回だけ表示 -->
        <div class="wrap_form">
            @if($loop->first)
                <div class="profile_box1">
                    <img src="/images/{{ $user->images }}" alt="プロフィール写真" class="bigImg profileImg">
                </div>

                <div class="profile_box2">
                    <p class="profile_tag">Name</p>
                    <p class="profile_tag">Bio</p>
                </div>

                <div class="profile_box4">
                    <p>{{ $user->username }}</p>
                    <br>
                    <p>{{ $user->bio }}</p>
                </div>

                <div class="btn_follow">
                    @if(in_array($user->id,$check))
                        <!-- フォロー外す -->
                        <a href="/{{$user->id}}/unFollow"><p class="btn">フォローをはずす</p></a>
                    @elseif($user->id == Auth::id())
                        <!-- 自分はフォローできないように何も表示しない -->
                    @else
                        <!-- フォローボタン -->
                        <a href="/{{$user->id}}/follow"><p class="btn">フォローする</p></a>
                    @endif
                </div>
            @endif
        </div>

        @if($loop->first)
            <hr class="separate">
        @endif

        <div class="wideBox1">
            <div class="wrapBox1">
                <!-- imageがnullならデフォルト画像を表示 -->
                <!-- issetはnullが偽 -->
                <!-- よくわからないアドレスが入ってるせいで判断がつかない -->
                @if(isset($user->images))
                    <a href="/{{ $user->id }}/profile"><img src="images/{{ $user->images }}" alt="プロフィール画像" class="bigImg"></a>
                @else
                    <a href="/{{ $user->id }}/profile"><img src="{{asset('/images/dawn.png')}}" alt="プロフィール画像" class="bigImg"></a>
                @endif
                <p>{{ $user->username }}</p>
                <p class="deployRight">{{ $user->create_at }}</p>
            </div>
            <div class="wrapBox2">
                <p>{{ $user->posts }}</p>
            </div>
        </div>

        <hr class="border">

    @endif
@endforeach

@endsection
