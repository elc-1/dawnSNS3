@extends('layouts.logout')

@section('content')

{!! Form::open() !!}

<div class="wrap">

<p>新規ユーザー登録</p>

    <div class="wrap2">
    {{ Form::label('UserName') }}
    {{ Form::text('username',null,['class' => 'input']) }}
    @if ($errors->has('username'))
        <h3>{{$errors->first('username')}}</h3>
    @endif

    {{ Form::label('MailAdress') }}
    {{ Form::text('mail',null,['class' => 'input']) }}
    @if ($errors->has('mail'))
        <h3>{{$errors->first('mail')}}</h3>
    @endif

    {{ Form::label('Password') }}
    {{ Form::text('password',null,['class' => 'input']) }}
    @if ($errors->has('password'))
        <h3>{{$errors->first('password')}}</h3>
    @endif

    {{ Form::label('Password confirm') }}
    {{ Form::text('password-confirm',null,['class' => 'input']) }}
    @if ($errors->has('password-confirm'))
        <h3>{{$errors->first('password-confirm')}}</h3>
     @endif

    {{ Form::submit('REGISTER',['class' => 'btn']) }}
    </div>

<p><a href="/login">ログイン画面へ戻る</a></p>

</div>

{!! Form::close() !!}


@endsection
