<!doctype html>
<html lang="ru">
<!-- Блок меню -->
<?php include("boot.php"); ?>
<?php


$user = null;
// Провека залогинен ли пользователь
if (check_auth()) {
    // Получим данные пользователя по сохранённому идентификатору
    $stmt = pdo()->prepare("SELECT * FROM `users` WHERE `id` = :id");
    $stmt->execute(['id' => $_SESSION['user_id']]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>

<head>
    <!-- Кодировка веб-страницы -->
    <meta charset="utf-8">
    <!-- Настройка viewport -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="styles/jquery.arcticmodal-0.3/jquery.arcticmodal-0.3.css">
    <!-- arcticModal тема отображения -->
    <link rel="stylesheet" href="styles/jquery.arcticmodal-0.3/themes/simple.css">
    <!-- Подключение css bootstrap -->
    <link rel="stylesheet" href=
    "https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css"/>
    <!-- Подключение своих стилей -->
    <link rel="stylesheet" href="styles/style.css">
    <!-- Карусель для слайдера в каталоге -->
    <link rel="stylesheet" href="styles/OwlCarousel2-2.3.4/dist/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="styles/OwlCarousel2-2.3.4/dist/assets/owl.theme.default.min.css">
    <!-- Bootstrap CSS (jsDelivr CDN) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- Заголовок сайта (вкладки) -->
    <title>wineVibe</title>
</head>

<!-- Меню сайта - стандартный вид ul, li -->
<!-- Классы container-fluid, row, col-6 и тд. добавлены для адаптивности сайта из Bootstrap -->
<!-- Подробнее про bootstrap и grid разметку https://bootstrap-4.ru/docs/4.0/layout/grid/ -->
<!-- mx - margin по горизонтали my - margin по вертикали py - аналогично, только отступы внутренние -->
<!-- Подробнее про отступы https://bootstrap-4.ru/docs/5.0/utilities/spacing/ -->
<div class="container-fluid row menu py-2 m0">                              <!-- Классы grid-разметки bootstrap -->
    <div class="container-fluid col-12 my-auto">
        <ul>
            <li class="logo col-2 mx-auto"><a href="index.php">              <!-- Ссылки на страницы -->
                    <span class="first">   WINE </span>
                    <span class="second"> VIBE</span>
                </a></li>
            <li class="col-1"><a href="catalog.php">Каталог</a></li>
            <li class="col-1"><a href="salesTerms.php">Условия продажи</a></li>
            <li class="col-1"><a href="about.php">О компании</a></li>
            <li class="col-1"><a href="clubProgramm.php">Клубная программа</a></li>
            <li class="col-1"><a href="contacts.php">Контакты</a></li>
            <li class="col-2">
                <img class="mapIcon" src="styles/img/значки/map.png">Чита
                <?php if ($user) { ?>
                    <a href="profile.php"><img class="userIcon" src="styles/img/значки/user.png"></a>
                <form style="display: inline;" action="get_baskets.php">
                    <button style="border: none; background: white;" type="submit">
                    <img class="basketIcon" src="styles/img/значки/basket.png">
                    </button>
                </form>
                    <form style="display: inline;" action="do_logout.php">
                        <button style="border: none; background: white;" type="submit">
                            <img class="Icon25 exitButton" src="styles/img/значки/enter.png">
                        </button>
                    </form>
                <?php } else { ?>
                    <img class="Icon25 registerButton" src="styles/img/значки/register.png">
                    <img class="Icon25 enterButton" src="styles/img/значки/enter.png">
                <?php } ?>
            </li>
        </ul>
    </div>
</div>

<!-- Модальное окно с вопросом о совершеннолетии -->
<div style="display: none;">
    <div class="box-modal hello" id="boxUserFirstInfo">
        <span>Данный сайт содержит контент, предназначенный для лиц старше 18 лет.</span> <br>
        <span>Вам уже есть 18?</span>
        <button style="border: none" class="yes arcticmodal-close">ДА</button>
        <button style="border: none" class="exit" id="exit">НЕТ</button>
    </div>
</div>
<!-- Вывод алертов -->
<?php flash(); ?>
<!-- Модальное окно с регистрацией -->
<div style="display: none;">
    <div class="box-modal register mx-auto" id="registerUser">
        <!-- Форма для отправки информации в бд -->
        <form method="post" action="do_register.php">
            <div class="registrationTitle"><span>РЕГИСТРАЦИЯ</span></div>
            <div class="col-md-12 mx-auto row">
                <div class="mb-4 col-md-12 mx-auto">
                    <label for="username" class="form-label">Введите фамилию</label>
                    <input type="text" class="form-control" id="username" name="username" required>
                </div>
            </div>

            <div class="col-md-12 mx-auto row">
                <div class="mb-4 col-md-6 mx-auto">
                    <label for="first_name" class="form-label">Введите имя</label>
                    <input type="text" class="form-control" id="first_name" name="first_name" required>
                </div>
                <div class="mb-4 col-md-6 mx-auto ">
                    <label for="third_name" class="form-label">Введите отчество</label>
                    <input type="text" class="form-control" id="third_name" name="third_name" required>
                </div>
            </div>

            <div class="col-md-12 mx-auto row">
                <div class="mb-4 col-md-6 mx-auto">
                    <label for="email" class="form-label">Введите email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="mb-4 col-md-6 mx-auto ">
                    <label for="phone" class="form-label">Введите номер телефона</label>
                    <input type="text" class="form-control" id="phone" name="phone" required>
                </div>
            </div>

            <div class="col-md-12 mx-auto row">
                <div class="mb-4 col-md-6 mx-auto">
                    <label for="password" class="form-label">Введите пароль</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <div class="mb-4 col-md-6 mx-auto ">
                    <label for="passwordCheck" class="form-label">Подтвердите пароль</label>
                    <input type="password" class="form-control" id="passwordCheck" name="passwordCheck" required>
                </div>
            </div>

            <div style="text-align: center">
                <button type="submit" class="btn acceptRegister">Зарегистрироваться</button>
            </div>
            <div class="box-modal_close arcticmodal-close">Закрыть</div>

        </form>

    </div>
</div>

<!-- Модальное окно авторизация -->
<div style="display: none;">
    <div class="box-modal register mx-auto" id="enterUser">
        <!-- Форма для отправки информации в бд -->
        <form method="post" action="do_login.php">

            <div class="registrationTitle"><span>АВТОРИЗАЦИЯ</span></div>


            <div class="mb-4 col-md-12 mx-auto">
                <label for="emailEnter" class="form-label">Введите email</label>
                <input type="text" class="form-control" id="emailEnter" name="emailEnter" required>
            </div>
            <div class="mb-4 col-md-12 mx-auto">
                <label for="passwordEnter" class="form-label">Введите пароль</label>
                <input type="password" class="form-control" id="passwordEnter" name="passwordEnter" required>
            </div>


            <div style="text-align: center">
                <button type="submit" class="btn acceptEnter">Войти</button>
            </div>
            <div class="box-modal_close arcticmodal-close">Закрыть</div>

        </form>

    </div>
</div>

<!-- Мобильное меню -->
<div class="mobile-wrapper">
    <img class="openMenu" src="styles/img/menu1.png">
        <div class="mobile-content">
                <ul class="nav-links text-center">
                    <li class="col-3 mx-auto"><a href="index.php">Главная</a></li>
                    <li class="col-3 mx-auto"><a href="catalog.php">Каталог</a></li>
                    <li class="col-3 mx-auto"><a href="salesTerms.php">Условия продажи</a></li>
                    <li class="col-3 mx-auto"><a href="about.php">О компании</a></li>
                    <li class="col-3 mx-auto"><a href="clubProgramm.php">Клубная программа</a></li>
                    <li class="col-3 mx-auto"><a href="contacts.php">Контакты</a></li>
                    <li class="col-6 mx-auto">
                        <img class="mapIcon" src="styles/img/значки/map.png">Чита
                        <?php if ($user) { ?>
                            <a href="profile.php"><img class="userIcon" src="styles/img/значки/user.png"></a>
                            <form style="display: inline;" action="get_baskets.php">
                                <button style="border: none; background: white;" type="submit">
                                    <img class="basketIcon" src="styles/img/значки/basket.png">
                                </button>
                            </form>
                            <form style="display: inline;" action="do_logout.php">
                                <button style="border: none; background: white;" type="submit">
                                    <img class="Icon25 exitButton" src="styles/img/значки/enter.png">
                                </button>
                            </form>
                        <?php } else { ?>
                            <img class="Icon25 registerButton" src="styles/img/значки/register.png">
                            <img class="Icon25 enterButton" src="styles/img/значки/enter.png">
                        <?php } ?>
                    </li>
                </ul>
        </div>

</div>

