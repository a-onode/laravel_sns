'use strict';

$(function () {
    $('.options-button').each(function () {
        $(this).on('click', function () {
            let target = $(this).data('target');
            let menu = document.getElementById(target);

            $(document).on('click', function () {
                $(menu).fadeOut().addClass('hidden');
            });

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

