$(document).ready(function () {
    var city = [];

    $('#country').on('change', function () {
        var val = $(this).val();

        $('.ru, .mol, .ukr').css({"display": "none"});

        $.ajax({
            url: myajax.url, //url, к которому обращаемся
            type: "POST",
            data: "action=get_country_field&country=" + val, //данные, которые передаем. Обязательно для action указываем имя нашего хука
            success: function (data) {
                $('.country-box').html(data);
            }
        });
    });

    $('#myWizard').wizard();

    $('.btn-next').on('click', function () {
        var step = $('#myWizard').wizard('selectedItem').step;
        if (step == 2) {
            $('.btn-next').attr('disabled', 'disabled');
        }
    });

    $('#show-modal').on('click', function () {
        $('.myModalWrap').toggle();
    });

    /*$('.myModalWrap').on('click', function(){
     $('.myModalWrap').toggle();
     });*/

    $(document).on('click', '#close-modal', function () {
        $('.myModalWrap').hide();
    });

    $('#send_user_info').on('click', function () {
        var post = $('#user_form').serialize();
        var url = post + "&action=add_user_aj";
        console.log(post);
        $.ajax({
            url: myajax.url, //url, к которому обращаемся
            type: "POST",
            data: url, //данные, которые передаем. Обязательно для action указываем имя нашего хука
            dataType: 'json',
            success: function (data) {
                console.log(data);
                var num = data['mark'];
                var mark = parseInt(num);
                if (!isNaN(mark)) {
                    temp_user_id = mark;
                    $('#user_form').html(post.unserialize);
                    $('.btn-next').removeAttr("disabled");
                    alert("Данные сохранены.")
                }
                else {
                    alert('Произошла ошибка, попробуйте ввести данные снова или обратитесь к админстатору.')
                }
            }
        });
    });

    $('#send_address_info').on('click', function () {
        var post = $('#address_form').serialize();
        var url = post + "&action=add_address_aj&temp_user_id=" + temp_user_id;

        alert(url);

        $.ajax({
            url: myajax.url, //url, к которому обращаемся
            type: "POST",
            data: url, //данные, которые передаем. Обязательно для action указываем имя нашего хука
            dataType: 'json',
            success: function (data) {
                console.log(data);
                if (data['mark'] == true) {
                    $('#address_form').html(post.unserialize);
                    $('.btn-next').removeAttr("disabled");
                    alert("Данные сохранены.")
                }
                else {
                    alert('Произошла ошибка, попробуйте ввести данные снова или обратитесь к админстатору.')
                }
            }
        });
    });

    $('#confirm').on('click', function () {
        if ($('#confirm').is(":checked")) {
            $('.btn-next').removeAttr("disabled");
        }
        else {
            $('.btn-next').attr('disabled', 'disabled');
        }
    });

    $(document).on('click', '.ui-menu-item', function () {
        var region_id = $("#region").val();
        alert(region_id);
        $.ajax({
            url: myajax.url, //url, к которому обращаемся
            type: "POST",
            data: "action=city&region=" + region_id, //данные, которые передаем. Обязательно для action указываем имя нашего хука
            success: function (data) {
                //возвращаемые данные попадают в переменную data
                un_data = $.parseJSON(data);
                $.each(un_data, function (index, value) {
                    city.push(value);
                });
                //$(".debug").html(data);
            }
        });
    });


    $(document).on('click', '.parent-link', function () {
        $(this).parent().next('.child-ul').toggle();
        return false;
    });

    $(document).on('click', '.no-child', function () {
        var text = $(this).html();
        $('#okved').append('<p class="okved-el">' + text + '</p>');
        $('#okved-wiz').append('<p class="okved-el">' + text + '</p>');
        return false;
    });

    $(function () {
        var region = [];

        $.ajax({
            url: myajax.url, //url, к которому обращаемся
            type: "POST",
            data: "action=region", //данные, которые передаем. Обязательно для action указываем имя нашего хука
            success: function (data) {
                //возвращаемые данные попадают в переменную data
                un_data = $.parseJSON(data);

                $.each(un_data, function (index, value) {
                    region.push(value);
                });
            }
        });

        $('#region').autocomplete({
            source: region
        })

        $('#city').autocomplete({
            source: city
        })

    });
});
