//ハンバーガーメニュー
$(function () {
  $('.menu-trigger').click(function () { //メニューボタンタップ後の処理
    $(this).toggleClass('active'); //クリックした要素に「.active」要素を付与
    $('.gnavi').css('display', 'block');//「.gnavi」要素の非表示を表示する
    if ($(this).hasClass('active')) { //もしクリックした要素に「.active」要素があれば
      $('.gnavi').addClass('active'); //「.active」要素を付与
    } else {                            //「.active」要素が無ければ
      $('.gnavi').removeClass('active'); //「.active」要素を外す
    }
  });
});



//モーダル表示
$(function () {
  $('.modal-open').each(function () {
    $(this).on('click', function () {
      //モーダルidの取得
      var target = $(this).data('target'); //クリックされたボタンのidを取得
      var modal = document.getElementById(target); //丸々コードを抽出
      console.log(modal); //デバッグ用、コンソールに表示
      $(modal).fadeIn();//背景とモーダルをフェードイン
      $('.overlay').fadeIn();
      $('body').addClass('no_scroll'); // 背景固定させるクラス付与
      return false; //それ以降の処理は無効にする
    });
  });

  //背景も押したら消えるようにする
  $('.overlay').on('click', function () {
    $('.overlay, .modal-window').fadeOut();//背景とモーダルのフェードアウト
    $('body').removeClass('no_scroll');// 背景固定させるクラス削除
    return false; //それ以降の処理は無効にする
  });
});
