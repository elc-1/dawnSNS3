@extends('layouts.logout')

@section('content')

{!! Form::open() !!}
<div class="wrap">

    <p>DAWNSNSへようこそ</p>

        <div class="wrap2">
        {{ Form::label('MailAdress') }}
        {{ Form::text('mail',null,['class' => 'input']) }}
        @if ($errors->has('mail'))
            <h3>{{$errors->first('mail')}}</h3>
        @endif

        {{ Form::label('password') }}
        {{ Form::password('password',['class' => 'input']) }}
        @if ($errors->has('password'))
            <h3>{{$errors->first('password')}}</h3>
        @endif

        {{ Form::submit('LOGIN',['class' => 'btn']) }}
        </div>

    <p><a href="/register">新規ユーザーの方はこちら</a></p>

</div>
{!! Form::close() !!}

@endsection
