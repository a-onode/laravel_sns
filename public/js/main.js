'use strict';

$(function () {
    $('.options-button').each(function () {
        $(this).on('click', function () {
            let target = $(this).data('target');
            let menu = document.getElementById(target);

            // $(document).on('click', function () {
            //     $(menu).fadeOut().addClass('hidden');
            // });

            if ($(menu).hasClass('hidden')) {
                $(menu).fadeIn(100).removeClass('hidden');
                return false;
            } else {
                $(menu).fadeOut(100).addClass('hidden');
                return false;
            }
        });
    });
});

$(function () {
    $('.edit-tweet-button').each(function () {
        $(this).on('click', function () {
            let target = $(this).data('target');
            let modal = document.getElementById(target);
            $(modal).fadeIn(100);
        });
    });

    $('.close-modal-button').on('click', function () {
        $('.edit-modal').fadeOut(100);
        return false;
    });
});

$(function () {
    $('.delete-tweet-button').each(function () {
        $(this).on('click', function () {
            let target = $(this).data('target');
            let deleteModal = document.getElementById(target);
            $(deleteModal).fadeIn(100);
        });
    });

    $('.delete-close-button').each(function () {
        $(this).on('click', function () {
            let target = $(this).data('target');
            let deleteModal = document.getElementById(target);
            $(deleteModal).fadeOut(100);
            return false;
        });
    });
});

// $(function () {
//     let likeReviewId; //変数を宣言（なんでここで？）
//     $('.like-button').on('click', function () { //onはイベントハンドラー
//         let $this = $(this); //this=イベントの発火した要素＝iタグを代入
//         let tweetId = $this.data('favorite'); //iタグに仕込んだdata-review-idの値を取得

//         //ajax処理スタート
//         $.ajax({
//             headers: { //HTTPヘッダ情報をヘッダ名と値のマップで記述
//                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//             },  //↑name属性がcsrf-tokenのmetaタグのcontent属性の値を取得
//             url: '/favorites', //通信先アドレスで、このURLをあとでルートで設定します
//             method: 'POST', //HTTPメソッドの種別を指定します。1.9.0以前の場合はtype:を使用。
//             data: { //サーバーに送信するデータ
//                 'tweet_id': tweetId //いいねされた投稿のidを送る
//             },
//         })
//             //通信成功した時の処理
//             .done(function (data) {
//                 console.log(data); //likedクラスのON/OFF切り替え。
//             })
//             //通信失敗した時の処理
//             .fail(function () {
//                 console.log('fail');
//             });
//     });
// });
