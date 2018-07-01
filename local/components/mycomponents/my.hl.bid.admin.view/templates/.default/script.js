// /**
//  * Created by Вован on 09.06.2018.
//  */
//
// $(document).ready(function(){
//
//     var data = {};
//     var check = $(".comment2").html();
//     if (typeof (check) !== 'undefined'){
//         $('#submit2').remove();
//     }
//     $('#submit2').click(function(){
//         data.comment = $(':input#comment').val();
//         data.entity_id = $('#admin_form').attr('data-ajax-entity-id');
//         data = JSON.stringify(data);
//
//         $.ajax({
//             url: '/local/components/mycomponents/my.hl.bid.admin.view/templates/ajax-handler.php',
//             type: 'POST',
//             data: 'data=' + data,
//             success: function(res){
//                 $('#submit2').remove();
//                 $('textarea').remove();
//                 $('td.comment').append(res);
//             },
//             fail: function(){
//                 $.fancybox("Ошибка");
//             }
//         });
//
//     });
//
// });