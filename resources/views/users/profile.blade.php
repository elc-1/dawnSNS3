@extends('layouts.login')

@section('content')

<div class='container'>

@foreach ($user as $user)
    <!-- $idが自分の場合 -->
    @if($user_id == $user->id)

        <img src="images/dawn.png">
        {!! Form::open(['url' => '/profile_update', 'method' => 'post']) !!}
        <div class="form-group">
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
                <td>{{ Form::text('new_password',$user->password,['class'=>'profile_newpassword']) }}</td>
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
                <td>Icon Image</td>
                <td>{{ Form::file('images',$user->images,['class'=>'profile_icon']) }}</td>
                @if($errors->has('images'))
                    {{ $errors->first('images') }}
                @endif
            </tr>
            {!! Form::submit('更新',['class' => 'update_button']) !!}
        </div>
        <button type="submit" class="btn btn-primary pull-right">更新</button>
        {!! Form::close() !!}



    <!-- 他人のプロフィールを表示する時 -->
    @else
        <img src="images/dawn.png">
        {!! Form::open(['url' => '/profile_update', 'method' => 'post']) !!}
        <div class="form-group">
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
                <td>{{ Form::text('new_password',$user->password,['class'=>'profile_newpassword']) }}</td>
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
                <td>Icon Image</td>
                <td>{{ Form::file('images',$user->images,['class'=>'profile_icon']) }}</td>
                @if($errors->has('images'))
                    {{ $errors->first('images') }}
                @endif
            </tr>
            {!! Form::input('更新',['class' => 'update_button']) !!}
            </div>
            <button type="submit" class="btn btn-primary pull-right">更新</button>
            {!! Form::close() !!}


    @endif

@endforeach
</div>

@endsection
