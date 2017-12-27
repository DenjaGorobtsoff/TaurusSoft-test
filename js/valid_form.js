$(document).ready(function(){
    $('.add_form').each(function(){
        var form = $(this),
            btn = form.find('.btn_add_user');
        //Проверка на заполненность формы
        function checkInput(){
            form.find('.user_input').each(function(){

                if($(this).val() !=''){
                    $(this).removeClass('field_empty').next().html('');
                } else {
                    $(this).addClass('field_empty');
                }
            });
        }
        //Проверка валидации регулярным выражением
        function checkValidation(){
            var input_name = /^[a-zA-Zа-яА-Я-]+\s?[a-zA-Zа-яА-Я-]+$/;
            var input_address = /^[\d]{5}\,\s[А-Я]{1}[а-я]+\,\s[А-Яа-я-]+\,\s[а-я-]+\.(\s)?[А-Яа-я]+\,\s[\d]{1,3}\/?([\d]{1,3})?$/;

            if(input_name.test($('.name_input').val()) || $('.name_input').val()==''){
                $('.name_input').removeClass('error_valid').prev().html('');
            } else {
                $('.name_input').addClass('error_valid');
            }

            if(input_address.test($('.address_input').val()) || $('.address_input').val()==''){
                $('.address_input').removeClass('error_valid').prev().html('');
            } else {
                $('.address_input').addClass('error_valid');
            }

        }

        //подсветка незаполненных полей формы

        function ifEmptyField(){


            if($('.name_input').val() ==''){
                $('.field_empty').css('border-color','red');
                $('.name_input')
                    .next()
                    .html('Поле "Name" обязательно для заполнения')
                    .css('color','red');

            }

            if($('.address_input').val() ==''){
                $('.field_empty').css('border-color','red');
                $('.address_input')
                    .next()
                    .html('Поле "Address" обязательно для заполнения')
                    .css('color','red');

            }
            // Через 2 секунды удалить подсветку
            setTimeout(function(){
                $('.field_empty').removeAttr('style');
            },2000);
        }
        function ifErrorValid(){
//
            if ($('.name_input').hasClass('error_valid')){
                $('.error_valid').css('border-color','red');
                $('.name_input')
                    .prev()
                    .html('You are mistaken! A name can only contain letters')
                    .css('color','red');
            }
            if ($('.address_input').hasClass('error_valid')){
                $('.error_valid').css('border-color','red');
                $('.address_input')
                    .prev()
                    .html('You are mistaken! Please look at the example')
                    .css('color','red');
            }
            // Через 2 секунды удалить подсветку
            setTimeout(function(){
                $('.error_valid').removeAttr('style');
            },2000);
        }


        // Проверка в реальном времени
        setInterval(function(){
            //Функции проверки полей на заполненность
            checkInput();
            checkValidation();
        },500);

        // Событие клика по кнопке отправить
        btn.click(function(){
            if($('input').hasClass('field_empty') || $('input').hasClass('error_valid')) {
                // подсвечиваем незаполненные поля и форму не отправляем, если есть незаполненные поля
                ifEmptyField();
                ifErrorValid();
                return false;
            }else{
                // Все хорошо, все заполнено, отправляем форму
                form.submit();

            }
        });

    });

});
