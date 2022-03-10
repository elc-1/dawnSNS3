@extends('layouts.login')

<!-- タイトルとサブタイトル -->
@section('title','トップ画面')
@section('subtitle','Social Network Service')

@section('content')

<body>
    <!-- つぶやきフォーム -->
    <div id="formTweet">
        {!! Form::open(array('url' => '/tweet', 'method' => 'post')) !!}

        {{ Form::label('つぶやき') }}
        {{ Form::text('tweet',null,['class' => 'input', 'placeholder' => '何をつぶやこうか…？']) }}
        @if ($errors->has('tweet'))
        <h3>{{$errors->first('tweet')}}</h3>
        @endif
        {{ Form::submit('tweetする',['class' => 'btn']) }}
    </div>

    <!-- つぶやき表示 -->
    <div id="mutter">
        <!-- ここにIF文でデータを取ってきてから、フォロワーだけのつぶやきを表示するらしい -->
          <tr>
              <td>ユーザー</td>
              <td>つぶやき</td>
              <td>投稿時間</td>
          </tr>
          <br>
        @forelse($list as $list)
          <tr>
            <td><a href="/{{$list->user_id}}/profile"><img src="images/{{ $list->images }}" alt="プロフィール画像"></a></td>
            <td>{{ $list->user_id }}</td>
            <td>{{ $list->posts }}</td>
            <td>{{ $list->create_at }}</td>

            <!-- なぜ｛｛｝｝で囲んでいないかは、＠ifが＜?phpを含んでるから -->
            @if( $list->user_id  == Auth::id())


            <!-- 編集 -->
            <!-- モーダルを開くボタン -->
            <a href="" class="modal-open" data-target="modal{{ $list->id }}">
                <img src="images/edit.png" alt="鉛筆">
            </a>

            <!-- 暗転背景 -->
            <div class="overlay"></div>

            <!-- モーダルウィンドウ -->
            <div class="modal-window" id="modal{{ $list->id }}">
                <div class="inner">
                    {!! Form::open(array('url' => '/post/update', 'method' => 'post')) !!}
                    {!! Form::hidden('post_id',$list->id) !!}
                    {{ Form::text('update',$list->posts,['class' => 'input', 'required']) }}
                    <button type="submit" class="update-btn"><img src="images/edit.png" lat="鉛筆"></button>
                    {!! Form::close() !!}
                </div>
            </div>




            <!-- 削除ボタン -->
            <td><a href="/post/{{$list->id}}/delete" onclick="return confirm('このつぶやきを削除します。よろしいでしょうか？')"><img src="images/trash_h.png" alt="ゴミ箱"></a></td>
            <!-- 表示なしなので何もコードなし -->
            @endif
          </tr>
          <br>
        @empty
            <p>つぶやきはありません</p>
        @endforelse
    </div>
</body>

@endsection
