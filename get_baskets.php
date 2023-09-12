<body>
<!-- Блок меню -->
<?php include("menu.php"); ?>

<?php
// получаем корзину конкретного пользователя
$stmt = pdo()->prepare("SELECT * FROM `basket` WHERE `user_id` LIKE '%" . $_SESSION['user_id'] . "%'");
$stmt->execute();
?>

<!-- Блок корзина -->
<div class="container-fluid p0 m0">
    <div class="row py-4 px-0 m0">
        <div style="margin-left: 13%" class="basket_title col-md-10 p0">КОРЗИНА</div>
        <div class="col-md-10 mx-auto py-4 basket_names">
            <div style="padding-left: 15%" class="col-md-4 inline bn">
                ТОВАР
            </div>
            <div style="text-align: right; padding-right: 10%;" class="col-sm-5 col-md-5 inline bn">
                КОЛИЧЕСТВО
            </div>
            <div style="text-align: right" class="col-sm-2 col-md-2 inline bn">
                СТОИМОСТЬ
            </div>
        </div>
        <?php
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC))// получаем все строки в цикле по одной
                {   // смотрим какой товар лежит в корзине и выводим информацию о нем из таблицы вина
                    $stmt1 = pdo()->prepare("SELECT * FROM `wine` WHERE `wine_id` LIKE '%" . $row['wine_id'] . "%'");
                    $stmt1->execute();
                    $wine = $stmt1->fetch(PDO::FETCH_ASSOC);
                    echo '<div style="line-height: 25px;" class="col-md-10 mx-auto">' .
                        '<div class="col-sm-4 col-md-4 basket_supp">' .
                        '<img class="wine_card_image" src="styles/img/каталог/' . $wine['wine_img_basket'] . '.png">' .
                            '<div class="text_around_img">'.
                                '<div class="textTitle_Basket">'.
                                    $wine['wine_name'] .
                                '</div>'.
                                '<div class="text_Basket">'.
                                    $wine['wine_full_name'] .
                                '</div>'.
                            '</div>'.
                        '</div>'.
                        '<div style="text-align: right; padding-right: 3%;" class="col-sm-4 col-md-4 inline baskets_qu">'.
                            '<input class="wine_quantity text-center" value="'. $row['wine_quantity']. '">'.
                        '</div>'.
                        '<div style="text-align: right" class="col-sm-3 col-md-3 inline baskets_price">'
                            .(int)$wine['wine_price']*(int)$row['wine_quantity']. " РУБ.".
                        '</div>'.
                        '</div>'.
                        '<div class="basket_names col-md-10 mx-auto"></div>';
                    // Считаем конечную цену без скидки, по всем товарам из корзины
                    $totalprice += (int)$wine['wine_price']*(int)$row['wine_quantity'];
                }
        ?>

        <div class="col-md-10 mx-auto total_without_discount">цена без скидки <?php echo $totalprice; ?> РУБ. <span> - 5%</span></div>
        <div class="col-md-10 mx-auto total">ИТОГО <?php echo $totalprice = $totalprice - ($totalprice/100)*5 ; ?> РУБ.</div>
        <div style="margin-left: 10%;" class="col-md-4 order_contact me-auto">
            <div class="order_title col-md-10 mx-auto">КОНТАКТНАЯ ИНФОРМАЦИЯ</div>
            <?php
            $stmt2 = pdo()->prepare("SELECT * FROM `users` WHERE `id` = :id");
            $stmt2->execute(['id' => $_SESSION['user_id']]);
            $user = $stmt2->fetch(PDO::FETCH_ASSOC);
            ?>
            <div class="mb-4 col-md-10 mx-auto ">
                <label for="phone" class="form-label">Телефон</label>
                <input type="text" value="<?php echo $user['phone']; ?>" class="form-control" id="phone1"
                       name="phone" readonly>
            </div>
            <div class="mb-4 col-md-10 mx-auto ">
                <label for="phone" class="form-label">ФИО</label>
                <input type="text"
                       value="<?php echo $user['first_name'] . " " . $user['username'] . " " . $user['third_name'] ?>"
                       class="form-control" id="phone1"
                       name="phone" readonly>
            </div>
            <div class="mb-4 col-md-10 mx-auto">
                <label for="email" class="form-label">Email</label>
                <input type="email" value="<?php echo $user['email']; ?>" class="form-control" id="email1"
                       name="email" readonly>
            </div>
            <div class="col-sm-12 col-md-10 mx-auto row variant">
                <div class="col-sm-6 col-md-4 inline">Вариант оплаты</div>
                <div class="col-sm-6 col-md-6 inline"><span style="font-size: 10px; color: #8C8C8C;">◯ </span> Наличными</div>

                <div class="col-sm-6 col-md-4 inline">Магазин</div>
                <div class="col-sm-6 col-md-6 inline"><span style="font-size: 10px; color: #8C8C8C;">◯ </span> Богомякова 27
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-5 ms-auto order_bottom my-4">
        <span class="mx-4">Обратите внимание на условия продажи</span>
        <button class="orderBtn"> <a href="do_order.php">ОФОРМИТЬ ЗАКАЗ</a></button>
    </div>
</div>
</div>


<!-- Блок footer -->
<?php include("footer.html"); ?>

</body>
