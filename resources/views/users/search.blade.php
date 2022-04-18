@extends('layouts.login')

@section('content')
  <!-- 検索窓の設置 -->
  <div id="search">
      <div class="search_form">
        {!! Form::open(array('url' => '/searching', 'method' => 'post')) !!}

        {{ Form::text('search',null,['class' => 'input', 'placeholder' => 'ユーザー名']) }}
        <!-- 画像をボタンにできていない -->
        {!! Form::submit('🔎',['class' => 'search_btn']) !!}
        {!! Form::close() !!}
      </div>

      <!-- 検索ワードの表示 -->
      <div class="search_word">
          <!-- 検索ワードがあった時だけ吐き出す -->
          <!-- issetはnullが偽 -->
          @if(isset($search_word))
              <p>検索ワード：{{ $search_word }}</p>
          @endif
      </div>
  </div>

  <hr class="separate">


  <!-- 検索結果が出るまではただの一覧表示 -->
  <!-- コントローラー側で処理するから、bladeではresultの表示だけ -->
  <div id="result">
      @forelse($result as $result)
        <div class="result_user">
            <a href="/{{$result->id}}/profile"><img class="bigImg" src="{{ asset('storage/'.$result->images) }}" alt="プロフィール画像"></a>
            <p class="result_username">{{ $result->username }}</p>

            <!-- ボタンの切り替え -->
            <!-- idがフォローしている人か判断 -->
            <!-- 自分はフォローできないようにする -->
            @if(in_array($result->id,$check))
              <!-- フォロー外す -->
              <p class="btn unfollow"><a href="/{{$result->id}}/unFollow">フォローをはずす</a></p>
            @elseif($result->id == Auth::id())
              <!-- 自分はフォローできないように何も表示しない -->
            @else
              <!-- フォローボタン -->
              <p class="btn follow"><a href="/{{$result->id}}/follow">フォローする</a></p>
            @endif
            <br>
        </div>
      @empty
        <p>該当なし</p>
      @endforelse
</div>

@endsection
