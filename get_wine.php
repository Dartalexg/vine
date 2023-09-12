<body>
<!-- Блок меню -->
<?php include("menu.php"); ?>

<?php

$actual_link = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$query = parse_url($actual_link, PHP_URL_QUERY);
parse_str($query, $parts);
$stmt = pdo()->prepare("SELECT * FROM `wine` WHERE `wine_id` LIKE '%" . $parts['id'] . "%'");
$stmt->execute(['wine_id' => $_SESSION['wine_id']]);
$wine = $stmt->fetch(PDO::FETCH_ASSOC);
$stmt = pdo()->prepare("SELECT * FROM `users` WHERE `id` = :id");
$stmt->execute(['id' => $_SESSION['user_id']]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);
$url_update = "update_wine.php?id={$wine['wine_id']}"
?>
<!-- Блок контакты -->
<div class="container-fluid p0 m0">
    <div class="row py-4 px-0 m0">
        <?php if ($user['admin'] == 1) { ?>

            <?php echo '<div class="deleteWine"><a href="delete_wine.php?id=' . $wine['wine_id'] . '">' . "Удалить" . '</a></div>' .
                '<button class="editWine">Редактировать</button>' ?>
        <?php } else {
        } ?>
        <?php
        echo
            '<div style="margin-left: auto"  class="col-md-4 p0">' .
            '<img class="wine_card_image" src="styles/img/каталог/' . $wine['wine_img1'] . '.png">' .
            '</div>' .
            '<div style="margin-right: auto; position: relative row"  class="col-md-4 p0">' .
            '<div class="wine_card col-sm-12 col-md-6">' .
            '<div class="wine_name">' .
            $wine['wine_name'] .
            '</div>' .
            '<div class="wine_full_name">' .
            $wine['wine_full_name'] .
            '</div>' .
            '<div class="wine_card_bottom">' .
            '<div class="wine_price">' .
            $wine['wine_price'] . " РУБ." .
            '</div>' .
            '<form class="zns" method="POST" action="do_add.php?id=' . $wine['wine_id'] . '">
            <div class="number" data-step="1" data-min="1"  data-max="' . $wine['quantity'] . '">
                                    <input class="number-text" type="text" id="quantity" name="quantity"  value="1">
                                    <div class="number-controls">
                                    <img class="number-plus m0" src="styles/img/up.png" alt="">
                                    <img class="number-minus m0" src="styles/img/down.png" alt="">
                                    </div>
                                </div>
                                <button type="submit" class="to_basket">В КОРЗИНУ</button>  
            </form>
                             </div>' .
            '</div>' .
            '</div>' .
            '</div>' .
            '<div class="col-md-8 mx-auto wine_card_discription">' .
            $wine['wine_discription'] .
            '</div>'
        ?>
        <!-- Модальное окно добавить вино -->
        <div style="display: none;">
            <div class="box-modal editWine_form mx-auto" id="editWine_form">
                <!-- Форма для отправки информации в бд -->
                <form method="post" action="<?php echo $url_update?>">
                <div class="registrationTitle"><span>Редактировать вино</span></div>

                <div class="mb-4 col-md-12 mx-auto">
                    <label for="wine_name" class="form-label">Наименование вина</label>
                    <input type="text" class="form-control" id="wine_name" name="wine_name"
                           value="<?php echo $wine['wine_name']; ?>" required>
                </div>
                <div class=" mb-4 col-md-12 mx-auto">
                    <label for="wine_full_name" class="form-label">Развернутое наименование</label>
                    <input type="text" class="form-control" id="wine_full_name" name="wine_full_name"
                           value="<?php echo $wine['wine_full_name']; ?>" required>
                </div>
                <div class=" mb-4 col-md-12 mx-auto">
                    <label for="wine_img" class="form-label">Фото в каталоге</label>
                    <input type="text" class="form-control" id="wine_img" name="wine_img"
                           value="<?php echo $wine['wine_img']; ?>" required>
                </div>
                <div class="mb-4 col-md-12 mx-auto">
                    <label for="wine_img1" class="form-label">Фото в карточке</label>
                    <input type="text" class="form-control" id="wine_img1" name="wine_img1"
                           value="<?php echo $wine['wine_img1']; ?>" required>
                </div>
                <div class="mb-4 col-md-12 mx-auto">
                    <label for="wine_img1" class="form-label">Фото в корзине</label>
                    <input type="text" class="form-control" id="wine_img_basket" name="wine_img_basket"
                           value="<?php echo $wine['wine_img_basket']; ?>" required>
                </div>
                <div class=" mb-4 col-md-12 mx-auto">
                    <label for="wine_discription" class="form-label">Описание</label>
                    <textarea style="height: 150px!important; text-align: left" type="text" class="form-control"
                              id="wine_discription" name="wine_discription"
                    ><?php echo $wine['wine_discription']; ?></textarea>
                </div>
                <div class=" mb-4 col-md-12 mx-auto">
                    <label for="wine_price" class="form-label">Цена</label>
                    <input type="text" class="form-control" id="wine_price" name="wine_price"
                           value="<?php echo $wine['wine_price']; ?>" required>
                </div>
                <div class=" mb-4 col-md-12 mx-auto">
                    <label for="quantity" class="form-label">Количество</label>
                    <input type="text" class="form-control" id="quantity" name="quantity"
                           value="<?php echo $wine['quantity']; ?>" required>
                </div>

                <div style=" text-align: center">
                    <button type="submit" class="btn acceptEnter">Сохранить</button>
                </div>
                </form>
            </div>
        </div>

    </div>
</div>

<!-- Блок footer -->
<?php include("footer.html"); ?>

</body>
