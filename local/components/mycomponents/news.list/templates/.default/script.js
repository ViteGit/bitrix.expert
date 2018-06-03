/**
 * Created by Вован on 02.06.2018.
 */


$(document).ready(function () {
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