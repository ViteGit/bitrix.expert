/**
 * Created by Вован on 06.06.2018.
 */


$(document).ready(function () {

    var error = false;
    $("#aply").click(function(e){
        var name = $("#fullname").val();
        var phone = $("#phone").val();
        var price = $("#desired_price").val();
        if (name === '' || phone  === ''|| price === ''){
                e.preventDefault();
                if (error === false) {
                    $("tfoot").append('<div style="color:red">Заполните все поля</div>');
                    error = true;
                }
        } else {
            $.fancybox('Мы вам сообщим свое решение');
        }
    });


    $("#wanna_cheaper").fancybox({
       // 'scrolling': 'no',
        'autoDimensions': true,
        //'easingIn': 'easeOutBack',
        //'easingOut': 'easeInBack',
        'hideOnContentClick': false,
    });
});
