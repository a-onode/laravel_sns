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

$(function () {
    $('.favorite-button').on('click', function () { //onはイベントハンドラー
        let tweetId = $(this).data('favorite');

        //ajax処理スタート
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '/favorites', //通信先アドレス
            method: 'POST', //HTTPメソッド
            data: { //サーバーに送信するデータ
                'tweet_id': tweetId //いいねされた投稿のidを送る
            },
        })
            //通信成功した時の処理
            .done(function (data) {
                console.log(data); //likedクラスのON/OFF切り替え。
            })
            //通信失敗した時の処理
            .fail(function () {
                console.log('fail');
            });
    });
});
