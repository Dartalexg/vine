// faq кнопка смены плюса на минус и открытия блока с текстом
$('.faq1').click(function () {
    $(".block_with_text_1").fadeToggle(100);   //открываем блок с тексом
    $(".plus1").toggleClass('active');         //меняем класс на актив(css свойство .plus1.active) - скрывается плюс
    $(".minus1").toggleClass('active');        //аналогично показываем минус
});

$('.faq2').click(function () {
    $(".block_with_text_2").fadeToggle(100);
    $(".plus2").toggleClass('active');
    $(".minus2").toggleClass('active');
});

$('.faq3').click(function () {
    $(".block_with_text_3").fadeToggle(100);
    $(".plus3").toggleClass('active');
    $(".minus3").toggleClass('active');
});

$('.faq4').click(function () {
    $(".block_with_text_4").fadeToggle(100);
    $(".plus4").toggleClass('active');
    $(".minus4").toggleClass('active');
});

// форма для редактирования вина
$('.editWine').click(function () {
    $('#editWine_form').arcticmodal({
        closeOnOverlayClick: false,
        closeOnEsc: true
    });
});

// открытие мобильного меню
$('.openMenu').click(function () {
    $(".mobile-content").fadeToggle(100);
});

// инициализация слайдера

$(document).ready(function(){
    const slider = $("#slider").owlCarousel({
        loop:true,
        nav:true,
        items:1,
    });
});

// функция окрытия модального окна
(function ($) {
    $(function () {

        // Проверим, есть ли запись в куках о посещении посетителя
        // Если запись есть - ничего не делаем
        if (!$.cookie('was')) {

            // Покажем всплывающее окно
            $('#boxUserFirstInfo').arcticmodal({
                closeOnOverlayClick: false,
                closeOnEsc: true
            });

        }

        // Запомним в куках, что посетитель к нам уже заходил
        $.cookie('was', true, {
            expires: 365,
            path: '/'
        });


    })
})(jQuery)

// при клике на кнопку "нет 18 лет" - закрываем окно
$('#exit').click(function () {
    window.close();                                                                 // закрываем окно
    document.cookie = 'was' + '=;expires=Thu, 01 Jan 1970 00:00:01 GMT;';           // удаляем куки, чтобы спросить при заходе еще раз (Не будет работать если открыть вкладку через ctrl+T - открывать всегда по чистой ссылке)
});


// кнопка регистрации нового пользователя
$('.registerButton').click(function () {
    $('#registerUser').arcticmodal({
        closeOnOverlayClick: false,
        closeOnEsc: true
    });
});

// кнопка авторизации
$('.enterButton').click(function () {
    $('#enterUser').arcticmodal({
        closeOnOverlayClick: false,
        closeOnEsc: true
    });
});

// кнопка добавления вина в товар
$('.addWine').click(function () {
    $('#add_wine').arcticmodal({
        closeOnOverlayClick: false,
        closeOnEsc: true
    });
});

// кнопки добавления/убавления количества вина в корзину
$(document).ready(function() {
    $('body').on('click', '.number-minus, .number-plus', function(){
        var $row = $(this).closest('.number');
        var $input = $row.find('.number-text');
        var step = $row.data('step');
        var val = parseFloat($input.val());
        if ($(this).hasClass('number-minus')) {
            val -= step;
        } else {
            val += step;
        }
        $input.val(val);
        $input.change();
        return false;
    });

    $('body').on('change', '.number-text', function(){
        var $input = $(this);
        var $row = $input.closest('.number');
        var step = $row.data('step');
        var min = parseInt($row.data('min'));
        var max = parseInt($row.data('max'));
        var val = parseFloat($input.val());
        if (isNaN(val)) {
            val = step;
        } else if (min && val < min) {
            val = min;
        } else if (max && val > max) {
            val = max;
        }
        $input.val(val);
    });
});

// вступить в клубную систему
$('#myScroll').click(function () {
    element = document.getElementById("myElementToScroll")
    element.scrollIntoView(true);
})

// кнопка оформить заказ
$('.orderBtn').click(function () {
    alert("Ваш заказ успешно оформлен! В ближайшее время с вами свяжется оператор.")
})
