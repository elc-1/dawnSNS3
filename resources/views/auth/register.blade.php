@extends('layouts.logout')

@section('content')

{!! Form::open() !!}

<div class="wrap">

<p>新規ユーザー登録</p>

    <div class="wrap2">
    {{ Form::label('UserName') }}
    {{ Form::text('username',null,['class' => 'input']) }}

    {{ Form::label('MailAdress') }}
    {{ Form::text('mail',null,['class' => 'input']) }}

    {{ Form::label('Password') }}
    {{ Form::text('password',null,['class' => 'input']) }}

    {{ Form::label('Password confirm') }}
    {{ Form::text('password-confirm',null,['class' => 'input']) }}

    {{ Form::submit('REGISTER',['class' => 'btn']) }}
    </div>

<p><a href="/login">ログイン画面へ戻る</a></p>

</div>

{!! Form::close() !!}


@endsection
