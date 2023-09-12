<body>
<!-- Блок меню -->
<?php include("menu.php"); ?>

<?php
$mysqli = mysqli_connect("127.0.0.1", "root", "", "wine_db");
$stmt = pdo()->prepare("SELECT * FROM `users` WHERE `id` = :id");
$stmt->execute(['id' => $_SESSION['user_id']]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

$actual_link = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";                                              // получаем текущую ссылку
$query = parse_url($actual_link, PHP_URL_QUERY);                                                      // парсим
parse_str($query, $parts);                                                                               // $parts забирает параметр search из ссылки
if (!empty($parts['search'])) {                                                                                 // если поиск не пустой
    $result = $mysqli->query("SELECT * FROM `wine` WHERE `wine_name` LIKE '%" . $parts['search'] . "%'"); // запрос на выборку по поиску
}
else{
    $result = $mysqli->query('SELECT * FROM `wine`');                                                     // если поиск пустой выборка состоит из всех записей
}
?>

<!-- Блок каталог -->
<div style="background:#EFEFEF; padding-bottom: 3%" class="catalogMain container-fluid px-0 m0">
    <div class="container-fluid row p0 m0">
        <div class="owl-carousel owl-theme p0" id="slider">
            <img src="styles/img/каталог/slide1.PNG" alt="">
            <img src="styles/img/каталог/slide2.PNG" alt="">
        </div>
        <?php if ($user['admin'] == 1) { ?> <div class="addWine">Добавить товар</div> <?php } ?>
        <div class="col-md-10 row mx-auto my-4">
            <div class="container">
                <form style="width: 50%;" class="mx-auto" method="get" action="catalog.php?search=">
                    <input type="search" name="search" id="search" placeholder="Найти...">
                    <button type="submit">Поиск</button>
                </form>
            </div>
            <?php
            while ($row = $result->fetch_assoc())// получаем все строки в цикле по одной
            {
                echo '<div class="col-sm-12 col-md-3  wine-card p0">' .
                    '<img class="wine_image" width="200" height="200" src="styles/img/каталог/' . $row['wine_img'] . '.png">' . // Вывод картинки
                    '<div class="wine_about">' .
                    '<a href="get_wine.php?id=' . $row['wine_id'] . '" class="wine-title">'. $row['wine_name'] . '</a>' .     // По url передаем id вина для того чтобы вывести информацию о конкретном объекте
                    '<div class="wine-full-name">' . $row['wine_full_name'] . '</div>' .                                        // Вывод наименования
                    '<div class="wine-price">' . $row['wine_price'] . " РУБ." . '</div>' .                                       // Вывод цены
                    '<div class="wine_bottom">
                         <form method="POST" action="do_add.php?id=' . $row['wine_id'] . '">
                        <div class="number" data-step="1" data-min="1" data-max="' . $row['quantity'] . '">
                            <input class="number-text" type="text" id="quantity" name="quantity" value="1">
                            <div class="number-controls">
                            <img class="number-plus m0" src="styles/img/up.png" alt="">
                            <img class="number-minus m0" src="styles/img/down.png" alt="">
                            </div>
                        </div>
                        <button type="submit" class="to_basket">В КОРЗИНУ</button>
                        </form>
                     </div>' .
                    '</div>' .
                    '</div>';
            }
            ?>
        </div>
    </div>
</div>

<!-- Модальное окно добавить вино -->
<div style="display: none;">
    <div class="box-modal add_wine mx-auto" id="add_wine">
        <!-- Форма для отправки информации в бд -->
        <form method="post" action="add_wine.php">

            <div class="registrationTitle"><span>Добавить товар</span></div>


            <div class="mb-4 col-md-12 mx-auto">
                <label for="wine_name" class="form-label">Наименование вина</label>
                <input type="text" class="form-control" id="wine_name" name="wine_name" required>
            </div>
            <div class="mb-4 col-md-12 mx-auto">
                <label for="wine_full_name" class="form-label">Развернутое наименование</label>
                <input type="text" class="form-control" id="wine_full_name" name="wine_full_name" required>
            </div>
            <div class="mb-4 col-md-12 mx-auto">
                <label for="wine_img" class="form-label">Фото в каталоге</label>
                <input type="text" class="form-control" id="wine_img" name="wine_img" required>
            </div>
            <div class="mb-4 col-md-12 mx-auto">
                <label for="wine_img1" class="form-label">Фото в карточке</label>
                <input type="text" class="form-control" id="wine_img1" name="wine_img1" required>
            </div>
            <div class="mb-4 col-md-12 mx-auto">
                <label for="wine_img1" class="form-label">Фото в корзине</label>
                <input type="text" class="form-control" id="wine_img_basket" name="wine_img_basket" required>
            </div>
            <div class="mb-4 col-md-12 mx-auto">
                <label for="wine_discription" class="form-label">Описание</label>
                <input type="text" class="form-control" id="wine_discription" name="wine_discription" required>
            </div>
            <div class="mb-4 col-md-12 mx-auto">
                <label for="wine_price" class="form-label">Цена</label>
                <input type="text" class="form-control" id="wine_price" name="wine_price" required>
            </div>
            <div class="mb-4 col-md-12 mx-auto">
                <label for="quantity" class="form-label">Количество</label>
                <input type="text" class="form-control" id="quantity" name="quantity" required>
            </div>


            <div style="text-align: center">
                <button type="submit" class="btn acceptEnter">Добавить</button>
            </div>
            <div class="box-modal_close arcticmodal-close">Закрыть</div>

        </form>

    </div>
</div>

<!-- Блок footer -->
<?php include("footer.html"); ?>

</body>