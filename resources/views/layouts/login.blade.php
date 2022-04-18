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
                    <p class="username">{{ $username->username }}さん</p>

                    <ul class="gnavi">
                        <li><a href="/index">HOME</a></li>
                        <!-- auth認証のユーザーidがまだ入っていない -->
                        <li><a href="/viewProfile">プロフィール編集</a></li>
                        <li><a href="/logout">ログアウト</a></li>
                    </ul>

                    <div class="menu-trigger">
                        <span></span>
                        <span></span>
                    </div>

                    <img class="userImg" src="{{ asset('storage/'.$my_img->images) }}">
                </div>
            </div>
        </div>
    </header>





    <div id="row">
        <div id="container">
            @yield('content')
        </div >
        <div id="side-bar">
            <div class="bar-up">
                <p>{{ $username->username }}さんの</p>
                <div class="wrap-bar">
                    <p>フォロー数</p>
                    <p class="count">{{ $count_follow }}名</p>
                    <br>
                    <a href="/followList"><p class="list btn">フォローリスト</p></a>
                    <br>
                    <p>フォロワー数</p>
                    <p class="count">{{ $count_follower }}名</p>
                    <br>
                    <a href="/followerList"><p class="list btn">フォロワーリスト</p></a>
                </div>
            </div>

            <hr>

            <div class="bar-down">
                <a href="/search"><p class="search btn">ユーザー検索</p></a>
            </div>
        </div>
    </div>
    <footer>
    </footer>
    <!-- <script src="JavaScriptファイルのURL"></script>
    <script src="JavaScriptファイルのURL"></script> -->
</body>
</html>
