/**
 * Created by Вован on 02.06.2018.
 */


$(document).ready(function () {

    var didScroll = false;
    var ajax = true;
    var data = [];

    $(window).scroll(function () {
        didScroll = true;
    });


    setInterval(function () {
        if (didScroll) {
            didScroll = false;

            data = checkPosition();
            data = JSON.stringify(data);
            sendAjax(data, "POST", "/local/templates/exam1/js/ajax/counter-update.php");
        }
    }, 500);


    function checkPosition() {
        var data = [];
        var news = document.getElementsByClassName("elem");

        for (var index = 0; index < news.length; index++) {

            var solHeight = (news[index].getBoundingClientRect().bottom - news[index].getBoundingClientRect().top) / 100 * 30;
            var solWidth = (news[index].getBoundingClientRect().right - news[index].getBoundingClientRect().left) / 100 * 30;

            var elemPos = {
                top: window.pageYOffset + news[index].getBoundingClientRect().top + solHeight,
                left: window.pageXOffset + news[index].getBoundingClientRect().left + solWidth,
                right: window.pageXOffset + news[index].getBoundingClientRect().right - solWidth,
                bottom: window.pageYOffset + news[index].getBoundingClientRect().bottom - solHeight,
            };

            var windowPos = {
                top: window.pageYOffset,
                left: window.pageXOffset,
                right: window.pageXOffset + document.documentElement.clientWidth,
                bottom: window.pageYOffset + document.documentElement.clientHeight,
            };

            if (elemPos.top < windowPos.bottom &&
                elemPos.bottom > windowPos.top &&
                elemPos.left < windowPos.right &&
                elemPos.right > windowPos.left) {
                data.push($(news[index]).attr("data-id"));
            }
        }

        return data;
    }

    function sendAjax(data, type, url) {
        $.ajax({
            type: type,
            url: url,
            data: "data=" + data,
            success: function (data) {
                //console.log(data);
            },
            fail: function () {
                $.fancybox("We're sorry");
            }
        });
    }




    $("a#show_more").click(function (e) {

        var btn =  $("a#show_more");
        var elem = $(".elem");
        var bx_ajax_id = btn.attr('data-ajax-id');
        var block_id = "#comp_" + bx_ajax_id;
        var data = [];

        $.each(elem, function (index, value) {
           data.push($(value).attr("data-id"));
        });

        data = JSON.stringify(data);

        $.ajax({
            url: window.location.href,
            type: "POST",
            data: "data=" + data,
        }).done(function (data) {
            $("#btn_" + bx_ajax_id).remove();
            $(block_id).append(data);
        }).fail(function () {
            alert("Вот беда");
        })

    });
});