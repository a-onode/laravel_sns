'use strict';

$(function () {
    $('.options-button').each(function () {
        $(this).on('click', function () {
            let target = $(this).data('target');
            let dropMenu = $('#' + target);
            // drop-menuを表示
            if (dropMenu.hasClass('hidden')) {
                dropMenu.fadeIn(200).removeClass('hidden');
                $('#overlay').removeClass('hidden');
            } else {
                dropMenu.fadeOut(200).addClass('hidden');
                $('#overlay').addClass('hidden');
                $('#overlay').addClass('hidden');
            }
            // options-buttonやdrop-menuの枠外がクリックされた場合の処理
            $(document).mouseup(function (e) {
                if ($('#overlay').is(e.target) && !$(e.target).hasClass('options-button')) {
                    dropMenu.fadeOut(200).addClass('hidden');
                    $('#overlay').addClass('hidden');
                }
            });
        });
    });
});

$(function () {
    $('.edit-tweet-button').each(function () {
        $(this).on('click', function () {
            let target = $(this).data('target');
            let modal = document.getElementById(target);
            $(modal).fadeIn(200);
        });
    });

    $('.close-modal-button').on('click', function () {
        $('.edit-modal').fadeOut(200);
        return false;
    });
});

$(function () {
    $('.delete-tweet-button').each(function () {
        $(this).on('click', function () {
            let target = $(this).data('target');
            let deleteModal = document.getElementById(target);
            $(deleteModal).fadeIn(200);
        });
    });

    $('.delete-close-button').each(function () {
        $(this).on('click', function () {
            let target = $(this).data('target');
            let deleteModal = document.getElementById(target);
            $(deleteModal).fadeOut(200);
            return false;
        });
    });
});

$(function () {
    $(document).on('click', '.favorite-button', function () { //onはイベントハンドラー
        let favoriteTweetId = $(this).data('favorite');
        let svg = $(this).children('svg');
        let p = $(this).children('p');
        let button = $(this);

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '/favorites', //通信先アドレス
            method: 'POST', //HTTPメソッド
            data: { //サーバーに送信するデータ
                'tweet_id': favoriteTweetId //いいねされた投稿のidを送る
            },
        })
            .done(function (data) {
                button.removeClass('favorite-button');
                button.addClass('unfavorite-button');
                svg.removeClass('text-gray-400 group-hover:text-gray-500');
                svg.addClass('text-yellow-400 group-hover:text-yellow-500');
                p.html('お気に入り解除');
            })
            .fail(function () {
                console.log('fail');
            });
    });
});

$(function () {
    $(document).on('click', '.unfavorite-button', function () {
        let unFavoriteTweetId = $(this).data('favorite');
        let svg = $(this).children('svg');
        let p = $(this).children('p');
        let button = $(this);

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '/favorites/' + unFavoriteTweetId,
            method: 'POST',
            data: {
                'tweet_id': unFavoriteTweetId,
                '_method': 'DELETE'
            },
        })
            .done(function (data) {
                button.removeClass('unfavorite-button');
                button.addClass('favorite-button');
                svg.removeClass('text-yellow-400 group-hover:text-yellow-500');
                svg.addClass('text-gray-400 group-hover:text-gray-500');
                p.html('お気に入り');
            })
            .fail(function () {
                console.log('fail');
            });
    });
});

//Close flash message
$(function () {
    $('#close-message-button').on('click', function () {
        $('#flash-message').fadeOut(100);
    });

    setTimeout(function () {
        $('#flash-message').fadeOut(100);
    }, 5000);
});

