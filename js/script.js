$(document).ready(function(){
   $('#country').on('change', function(){
       var val = $(this).val();

       $('.ru, .mol, .ukr').css({"display" : "none"});

       $.ajax({
           url: myajax.url, //url, к которому обращаемся
           type: "POST",
           data: "action=get_country_field&country="+val, //данные, которые передаем. Обязательно для action указываем имя нашего хука
           success: function(data){
               $('.country-box').html(data);
           }
       });
   });

    $('#myWizard').wizard();

    $('.btn-next').on('click', function(){
        var step = $('#myWizard').wizard('selectedItem').step;
        if(step == 2){
            $('.btn-next').attr('disabled', 'disabled' );
        }
    });

    $('#send_user_info').on('click', function(){
        var post = $('#user_form').serialize();
        post = post + "&action=add_user_aj";
        console.log(post);
        $.ajax({
            url: myajax.url, //url, к которому обращаемся
            type: "POST",
            data: post, //данные, которые передаем. Обязательно для action указываем имя нашего хука
            success: function(data){
                $('#user_form').html(data);
                $('.btn-next').removeAttr("disabled");
            }
        });
    });

    $('#confirm').on('click', function () {
        if($('#confirm').is(":checked")){
            $('.btn-next').removeAttr("disabled");
        }
        else {
            $('.btn-next').attr('disabled', 'disabled' );
        }
    });

    $(function() {

        $('#region').autocomplete({
            source: region
        })
    });
});
