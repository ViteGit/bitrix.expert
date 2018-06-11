/**
 * Created by Вован on 08.06.2018.
 */

$(document).ready(function () {

    $("table").on("click", "tr", function () {
        var id = $(this).attr('data-id');

        $.ajax({
            type: "GET",
            url: '/local/components/mycomponents/my.hl.bid.admin.list/templates/.default/ajax-to-view.php',
            data: 'id=' + id,
            success: function (res) {
                $.fancybox(res);

            },
            fail: function () {
                $.fancybox('Ошибка');
            }
        });

        $(document).ajaxComplete(function () {
            var comment;
            var data = {};
            var check = $(".comment2").html();
            if (typeof (check) !== 'undefined') {
                $('#submit2').remove();
            }
            $('#submit2').click(function () {
                data.comment = $(':input#comment').val();
                data.entity_id = $('#admin_form').attr('data-ajax-entity-id');
                datas = JSON.stringify(data);

                if (data.comment !== '') {

                console.log(data);
                    $.ajax({
                        url: '/local/components/mycomponents/my.hl.bid.admin.view/templates/ajax-handler.php',
                        type: 'POST',
                        data: 'data=' + datas,
                        success: function (res) {
                            $('#submit2').remove();
                            $('textarea').remove();
                            $('td.comment').append(res);
                        },
                        fail: function () {
                            $.fancybox("Ошибка");
                        }
                    });
                }
            });

        });

        console.log(id);
    });

});



