<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
    <!--IEブラウザ対策-->
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="ページの内容を表す文章" />
    <title></title>
    <link rel="stylesheet" href="{{ asset('/css/reset.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/style.css') }}">
    <!--スマホ,タブレット対応-->
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <!--サイトのアイコン指定-->
    <link rel="icon" href="画像URL" sizes="16x16" type="image/png" />
    <link rel="icon" href="画像URL" sizes="32x32" type="image/png" />
    <link rel="icon" href="画像URL" sizes="48x48" type="image/png" />
    <link rel="icon" href="画像URL" sizes="62x62" type="image/png" />
    <!--iphoneのアプリアイコン指定-->
    <link rel="apple-touch-icon-precomposed" href="画像のURL" />
    <!--OGPタグ/twitterカード-->
    <!-- javaScriptの読み込み -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="{{ asset('/js/script.js') }}"></script>
</head>
<body>
    <header>
        <div id = "head">
            <h1 class="logo"><a href="/index"><img src="{{ asset('/images/main_logo.png') }}"></a></h1>
            <div id="userWrap">
                <div id="user">
                    <p class="container">{{ $username->username }}さん
                        <nav class="gnavi">
                            <ul>
                                <li class="nav-item"><a href="/index">ホーム</a></li>
                                <!-- auth認証のユーザーidがまだ入っていない -->
                                <li class="nav-item"><a href="/viewProfile">プロフィール</a></li>
                                <li class="nav-item"><a href="/logout">ログアウト</a></li>
                            </ul>
                        </nav>
                        <div class="menu-trigger">
                            <span></span>
                            <span></span>
                        </div>
                        <img class="userImg" src="{{ asset('/images/dawn.png') }}">
                    </p>
                </div>
            </div>
        </div>
    </header>





    <div id="row">
        <div id="container">
            @yield('content')
        </div >
        <div id="side-bar">
            <div id="confirm">
                <p>{{ $username->username }}さんの</p>
                <div>
                <p>フォロー数</p>
                <!-- ここはControllerから配列で送ってきてないから、変数をそのままおけばいい -->
                <p>{{ $count_follow }}名</p>
                </div>
                <p class="btn"><a href="/followList">フォローリスト</a></p>
                <div>
                <p>フォロワー数</p>
                <!-- ここも配列ではなくただの変数 -->
                <p>{{ $count_follower }}名</p>
                </div>
                <p class="btn"><a href="/followerList">フォロワーリスト</a></p>
            </div>
            <p class="btn"><a href="/search">ユーザー検索</a></p>
        </div>
    </div>
    <footer>
    </footer>
    <!-- <script src="JavaScriptファイルのURL"></script>
    <script src="JavaScriptファイルのURL"></script> -->
</body>
</html>
