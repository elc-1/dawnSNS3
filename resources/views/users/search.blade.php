@extends('layouts.login')

@section('content')
  <!-- 検索窓の設置 -->
  <div id="search">
        {!! Form::open(array('url' => '/searching', 'method' => 'post')) !!}

        {{ Form::text('search',null,['class' => 'input', 'placeholder' => 'ユーザー名']) }}
        @if ($errors->has('search'))
          <h3>{{$errors->first('search')}}</h3>
        @endif
        <!-- 画像をボタンにできていない -->
        {{ Form::submit('検索する',['class' => 'btn']) }}
    </div>


  <!-- 検索ワードの表示 -->
  <div id="search_word">
      <!-- 検索ワードがあった時だけ吐き出す -->
      <!-- issetはnullが偽 -->
      @if(isset($search_word))
          <p>{{ $search_word }}</p>
      @endif
  </div>


  <!-- 検索結果が出るまではただの一覧表示 -->
  <!-- コントローラー側で処理するから、bladeではresultの表示だけ -->
  <div id="result">
      @forelse($result as $result)
        <div class="result_users">
          <tr>
              <td><a href="/{{$result->id}}/profile"><img src="images/{{ $result->images }}" alt="プロフィール画像"></a></td>
              <td>{{ $result->username }}</td>

              <!-- ボタンの切り替え -->
              <!-- idがフォローしている人か判断 -->
              <!-- 自分はフォローできないようにする -->
              @if(in_array($result->id,$check))
                <!-- フォロー外す -->
                <td><a href="/{{$result->id}}/unFollow"><p class="btn">フォローをはずす</p></td>
              @elseif($result->id == Auth::id())
                <!-- 自分はフォローできないように何も表示しない -->
              @else
                <!-- フォローボタン -->
                <td><a href="/{{$result->id}}/follow"><p class="btn">フォローする</p></a></td>
              @endif
          </tr>
          <br>
        </div>
      @empty
        <p>該当なし</p>
      @endforelse
  </div>

@endsection
