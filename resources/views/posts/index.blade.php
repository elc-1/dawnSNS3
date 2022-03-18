@extends('layouts.login')

<!-- タイトルとサブタイトル -->
@section('title','トップ画面')
@section('subtitle','Social Network Service')

@section('content')

<body>
    <!-- つぶやきフォーム -->
    <div id="formTweet">
        {!! Form::open(array('url' => '/tweet', 'method' => 'post')) !!}

        <!-- ここに画像を入れたい -->
        {{ Form::label('つぶやき') }}
        {{ Form::text('tweet',null,['class' => 'tweet', 'placeholder' => '何をつぶやこうか…？']) }}
        @if ($errors->has('tweet'))
        <h3>{{$errors->first('tweet')}}</h3>
        @endif
        <button type="submit" class="post_btn"><img src="images/post.png" alt="鉛筆"></button>

        {!! Form::close() !!}
    </div>

    <hr class="separate">

    <!-- つぶやき表示 -->
    <div id="mutterBox">
        @forelse($list as $list)
            <div class="wideBox1">
                <div class="wrapBox1">
                    <a href="/{{ $list->id }}/profile"><img src="images/{{ $list->images }}" alt="プロフィール画像" class="bicImg"></a>
                    <p>{{ $list->username }}</p>
                    <p class="deployRight">{{ $list->create_at }}</p>
                </div>
                <div class="wrapBox2">
                    <p>{{ $list->posts }}</p>
                </div>
            </div>

            <!-- ここからがfollowListと異なる部分 -->
            <div class="wideBox2">
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
                    <a href="/post/{{$list->id}}/delete" onclick="return confirm('このつぶやきを削除します。よろしいでしょうか？')" class="delete-btn"><img src="images/trash_h.png" alt="ゴミ箱"></a>
                    <!-- 表示なしなので何もコードなし -->
                @endif
            </div>
            <hr class="border">
        @empty
            <p>つぶやきはありません。</p>
        @endforelse
    </div>
</body>

@endsection
