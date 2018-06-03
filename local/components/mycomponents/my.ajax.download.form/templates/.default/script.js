/**
 * Created by Вован on 29.05.2018.
 */

$(document).ready(function () {

    $("form#ajax-form").submit(function () {

        var form = $("form#ajax-form");
        var file = $("#img").prop("files")[0];
        var data = new FormData();
        data.append("file", file);

        if (file !== undefined) {
            $.ajax({
                dataType: 'text',
                cache: false,
                contentType: false,
                processData: false,
                url: window.location.href,
                type: "POST",
                data: data,
                success: function (res) {
                    $("#aply").prop("disabled", true);
                    $("#img").remove();
                    $("#link").append(res);
                },
                fail: function () {
                    alert("все плохо");
                },
            })
        }
    });

});