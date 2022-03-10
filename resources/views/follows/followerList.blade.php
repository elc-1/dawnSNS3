@extends('layouts.login')

@section('content')

<!-- ここからフォローリストの画像を表示 -->
    @forelse($list as $list)
        <tr>
            <td><img src="images/{{ $list->images }}" alt="プロフィール画像"></td>
        </tr>

<!-- ここからつぶやきの表示をする -->
        <tr>
            <td>{{ $list->id }}</td>
            <td><img src="images/{{ $list->images }}" alt="プロフィール画像"></td>
            <td>{{ $list->posts }}</td>
            <td>{{ $list->create_at }}</td>
        </tr>
        <br>
    @empty
        <p>つぶやきはありません</p>
    @endforelse

    @endsection
