@extends('layouts.login')

@section('content')


@foreach ($user as $user)
    <!-- 単純にここで送られてきた$userがログイン者か、別ユーザーか判断する -->
    @if($user->id == Auth::id())
        <div class="form-group">
        {!! Form::open(['url' => '/updateProfile', 'method' => 'post']) !!}
                <tr>
                    <td>UserName</td>
                    <td>{{ Form::text('username',$user->username,['class'=>'profile_name']) }}</td>
                    @if($errors->has('username'))
                        {{ $errors->first('username') }}
                    @endif
                </tr>
                <br>
                <tr>
                    <td>MailAddress</td>
                    <td>{{ Form::text('mail',$user->mail,['class'=>'profile_mail']) }}</td>
                    @if($errors->has('mail'))
                        {{ $errors->first('mail') }}
                    @endif
                </tr>
                <br>
                <tr>
                    <td>Password</td>
                    <!-- 変更不可の表示のみのパスワードにする為、disabledを使用。値の送信も行わない。 -->
                    <td>{{ Form::text('password',$user->password,['class'=>'profile_pass','disabled']) }}</td>
                </tr>
                <br>
                <tr>
                    <td>new Password</td>
                    <td>{{ Form::text('new_password','',['class'=>'profile_newpassword']) }}</td>
                    @if($errors->has('new_password'))
                        {{ $errors->first('new_password') }}
                    @endif
                </tr>
                <br>
                <tr>
                    <td>Bio</td>
                    <td>{{ Form::text('bio',$user->bio,['class'=>'profile_bio']) }}</td>
                    @if($errors->has('bio'))
                        {{ $errors->first('bio') }}
                    @endif
                </tr>
                <br>
                <tr>
                    <!-- アイコンの画像を読み込む -->
                </tr>
                {!! Form::submit('更新',['class' => 'update_button']) !!}
        {!! Form::close() !!}
        </div>
        <!-- たくさん繰り返されるので一回で止める -->
        @break
    @else
        <!-- ここにログインユーザー以外のプロフィールを表示 -->
        <!-- プロフィール部分だけは一回だけ表示 -->
        @if($loop->first)
        <div id="otherProfile">
            <div class="profile_images">
                <p><img src="/images/{{ $user->images }}" alt="プロフィール写真"></p>
            </div>
            <div class="username">
                <p>Name</p>
                <P>{{ $user->username }}</P>
            </div>
            <div class="bio"><p>Bio</p>
                <p>{{ $user->bio }}</p>
            </div>
            <div class="btn_follow">
                @if(in_array($user->id,$check))
                    <!-- フォロー外す -->
                    <td><a href="/{{$user->id}}/unFollow"><p class="btn">フォローをはずす</p></td>
                @elseif($user->id == Auth::id())
                    <!-- 自分はフォローできないように何も表示しない -->
                @else
                    <!-- フォローボタン -->
                    <td><a href="/{{$user->id}}/follow"><p class="btn">フォローする</p></a></td>
                @endif
            </div>
        </div>
        @endif

        <div id="viewTweet">
            <tr>
                <td><a href="/{{$user->user_id}}/profile"><img src="images/{{ $user->images }}" alt="プロフィール画像"></a></td>
                <td>{{ $user->user_id }}</td>
                <td>{{ $user->posts }}</td>
                <td>{{ $user->create_at }}</td>
            </tr>
        </div>
    @endif
@endforeach

@endsection
