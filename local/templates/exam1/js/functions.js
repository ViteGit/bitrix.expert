$(document).ready(function () {
    lis = $(".nv_topnav>ul>li");
    LastSumm = 0;

    for (var i = 1; i < lis.length; i++) {
        LastSumm = LastSumm + $(lis[i]).width()
    }

    if (LastSumm > 600) {
        FreeSpace = 931 - LastSumm;
        k = FreeSpace / (lis.length - 1);
        kp = k / 2 + 28;
        $(".nv_topnav>ul>li:nth-child(1n+2)>a>span").css({"padding": "0 " + kp + "px"})
    }


    $(".nv_topnav .current").next("li").find("span").css({"border-left": "none"})
    $(".nv_topnav .current").prev("li").find("span").css({"border-right": "none"})

    setEqualHeight($(".il_li_itemlistgallery > li"));
    setEqualHeight($("#foo1 > li"));

});
$("#hd_singin_but_open").live('click', function () {
    $(".hd_loginform").css({"display": "block", "opacity": 0})
    $(".hd_loginform").animate({"opacity": 1}, 400)
    return false;
})
$(".hd_close_loginform").live('click', function () {
    $(".hd_loginform").animate({"opacity": 0}, 400)
    setTimeout(function () {
        $(".hd_loginform").css({'display': 'none'})
    }, 400)
    return false;
})
$(".sb_showchild").live('click', function () {
    ParentElement = $(this).parent("li");
    FindElement = ParentElement.find("ul");
    FindElement2 = ParentElement.find("ul li");

    garm($(this), ParentElement, FindElement, FindElement2);
})
$(".fl_showchild").live('click', function () {
    ParentElement = $(this).parents(".il_fl_filter");
    FindElement = ParentElement.find(".il_fl_field");
    FindElement2 = ParentElement.find(".il_fl_field>div");
    console.log(FindElement)

    garm($(this), ParentElement, FindElement, FindElement2);
    beforgarm($(this), ParentElement, FindElement, FindElement2)
})
$(".vc_showchild").live('click', function () {
    ParentElement = $(this).parent("li");
    FindElement = ParentElement.find("ul");
    FindElement2 = ParentElement.find("ul li");

    garm($(this), ParentElement, FindElement, FindElement2);
    beforgarm($(this), ParentElement, FindElement, FindElement2)
})
$(".vc_showchild-2").live('click', function () {
    ParentElement = $(this).parent("li");
    FindElement = ParentElement.find("ul");
    FindElement2 = ParentElement.find("ul li");

    garm($(this), ParentElement, FindElement, FindElement2);
    beforgarm($(this), ParentElement, FindElement, FindElement2)
})

function garm(clk, ParentElement, FindElement, FindElement2) {
    if (ParentElement.hasClass('open')) {
        FindElement.animate({'height': 0}, 400)
        FindElement2.animate({'opacity': 0}, 250)
        ParentElement.removeClass("open");
        ParentElement.addClass("close");
        console.log("1");
    } else {
        FindElement.removeAttr('style');
        FindElement2.css({'opacity': 1})
        ParentElement.removeClass("close");
        ParentElement.addClass("open");
        heightChildUl = FindElement.height();
        ParentElement.removeClass("open");
        ParentElement.addClass("close");
        FindElement.css({'height': 0})
        FindElement2.css({'opacity': 0})
        FindElement.animate({'height': heightChildUl + "px"}, 250);
        FindElement2.animate({'opacity': 1}, 400)
        ParentElement.removeClass("close");
        ParentElement.addClass("open");
        console.log("2");
    }
}

function beforgarm(clk, ParentElement) {
    if (ParentElement.hasClass('open')) {
        ParentElement.find(".vc_showchild").animate({'opacity': 0}, 100)
        ParentElement.find(".vc_showchild-2").animate({'opacity': 1}, 300)
        ParentElement.find(".vc_showchild").removeClass("open");
        ParentElement.find(".vc_showchild").addClass("close");
        ParentElement.find(".vc_showchild-2").removeClass("close");
        ParentElement.find(".vc_showchild-2").addClass("open");
    } else {
        ParentElement.find(".vc_showchild-2").animate({'opacity': 0}, 100)
        ParentElement.find(".vc_showchild").animate({'opacity': 1}, 300)
        ParentElement.find(".vc_showchild-2").removeClass("open");
        ParentElement.find(".vc_showchild-2").addClass("close");
        ParentElement.find(".vc_showchild").removeClass("close");
        ParentElement.find(".vc_showchild").addClass("open");
    }
}
function setEqualHeight(columns) {
    var tallestcolumn = 0;
    columns.each(function () {
        currentHeight = $(this).height();
        if (currentHeight > tallestcolumn) {
            tallestcolumn = currentHeight;
        }
    });
    columns.height(tallestcolumn);
}

$(document).ready(function () {
    $(".psedo").click(function (e) {
        e.preventDefault();

        var long = $(this).parent("td").find("span.long_text").toggleClass("shown", "hidden");
        var short = $(this).parent("td").find("span.short_text").toggleClass("hidden", "shown");

        if ($(this).text() === "читать полностью") {
            $(this).text("скрыть все");
        } else {
            $(this).text("читать полностью");

        }


    });
});


$(document).ready(function () {
    $("a#form").fancybox({
        'hideOnContentClick': false,
    });

    $("a#result").click(function (e) {
        e.preventDefault();
        var data = $(this).attr("href");
        $.ajax({
            url: "/local/templates/exam1/js/ajax/ajax-form.php",
            method: "GET",
            data: data,
        }).done(function (data) {
            $.fancybox(data);
        })
            .fail(function () {
                $.fancybox('Что-то пошло не так');
            })
    });

});


$(document).on('change', '#status_SIMPLE_FORM_1', function () {
    var comment = $("tr");
    comment = comment.slice(-2);
    if ($("#status_SIMPLE_FORM_1 :selected").val() === '4') {
        comment.removeClass("hidden");

    } else {
        comment.addClass("hidden");
    }

    if (!$('#status_SIMPLE_FORM_1').hasClass('hidden')) {
        $("textarea").prop('required', true);
    }
});


// $(document).ajaxComplete(function () {
//     var comment = $("tr");
//     comment = comment.slice(-2);
//     comment.addClass("hidden");
// });
//
//
//


// var didScroll = false;
// var ajax = true;
// var data = [];
//
// $(window).scroll(function () {
//     didScroll = true;
// });
//
//
// setInterval(function () {
//     if (didScroll) {
//         didScroll = false;
//
//         data = checkPosition();
//         data = JSON.stringify(data);
//         sendAjax(data, "POST", "/local/templates/exam1/js/ajax/counter-update.php");
//     }
// }, 500);
//
//
// function checkPosition() {
//     var data = [];
//     var news = document.getElementsByClassName("elem");
//
//     for (var index = 0; index < news.length; index++) {
//
//         var solHeight = (news[index].getBoundingClientRect().bottom - news[index].getBoundingClientRect().top) / 100 * 30;
//         var solWidth = (news[index].getBoundingClientRect().right - news[index].getBoundingClientRect().left) / 100 * 30;
//
//         var elemPos = {
//             top: window.pageYOffset + news[index].getBoundingClientRect().top + solHeight,
//             left: window.pageXOffset + news[index].getBoundingClientRect().left + solWidth,
//             right: window.pageXOffset + news[index].getBoundingClientRect().right - solWidth,
//             bottom: window.pageYOffset + news[index].getBoundingClientRect().bottom - solHeight,
//         };
//
//         var windowPos = {
//             top: window.pageYOffset,
//             left: window.pageXOffset,
//             right: window.pageXOffset + document.documentElement.clientWidth,
//             bottom: window.pageYOffset + document.documentElement.clientHeight,
//         };
//
//         if (elemPos.top < windowPos.bottom &&
//             elemPos.bottom > windowPos.top &&
//             elemPos.left < windowPos.right &&
//             elemPos.right > windowPos.left) {
//             data.push($(news[index]).attr("data-id"));
//         }
//     }
//
//     return data;
// }
//
// function sendAjax(data, type, url) {
//     $.ajax({
//         type: type,
//         url: url,
//         data: "data=" + data,
//         success: function (data) {
//             //console.log(data);
//         },
//         fail: function () {
//             $.fancybox("We're sorry");
//         }
//     });
// }


var debug = function (d) {
    console.clear();
    console.log(d);
}




