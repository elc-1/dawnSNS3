@extends('layouts.login')

@section('content')

<div id="followImg">
    <p class="listHeader">FollowList</p>
    <div class="viewImg">
        @forelse($img as $img)
            <a href="/{{ $img->id }}/profile"><img src="images/{{ $img->images }}" alt="プロフィール画像" class="bicImg"></a>
        @empty
            <p>フォローしている人はいません。</p>
        @endforelse
    </div>
</div>

<hr class="separate">

<div id="mutterBox">
    @forelse($list as $list)
    <div class="wrapperBox">
        <div class="wrapBox1">
            <a href="/{{ $list->id }}/profile"><img src="images/{{ $list->images }}" alt="プロフィール画像" class="bicImg"></a>
            <p>{{ $list->username }}</p>
            <p class="deployRight">{{ $list->create_at }}</p>
        </div>
        <div class="wrapBox2">
            <p>{{ $list->posts }}</p>
        </div>
    </div>
    <hr class="border">
    @empty
        <p>つぶやきはありません。</p>
    @endforelse
</div>

@endsection
