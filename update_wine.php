<?php
// логика описана в delete_wine.php
require_once __DIR__ . '/boot.php';

$actual_link = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$query = parse_url($actual_link, PHP_URL_QUERY);
parse_str($query, $parts);

$stmt = pdo()->prepare("UPDATE `wine` SET `wine_name`=:wine_name,
                  `wine_full_name`=:wine_full_name,`wine_img`=:wine_img,`wine_img1`=:wine_img1,`wine_img_basket`=:wine_img_basket,
                  `wine_discription`=:wine_discription,`wine_price`=:wine_price,`quantity`=:quantity 
                  WHERE `wine_id` LIKE '%" . $parts['id'] . "%'");
$stmt->execute([
    'wine_name' => $_POST['wine_name'],
    'wine_full_name' => $_POST['wine_full_name'],
    'wine_img' => $_POST['wine_img'],
    'wine_img1' => $_POST['wine_img1'],
    'wine_img_basket' => $_POST['wine_img_basket'],
    'wine_discription' => $_POST['wine_discription'],
    'wine_price' => $_POST['wine_price'],
    'quantity' => $_POST['quantity'],
]);

flash('Информация успешно изменена');
header('Location: catalog.php');
die;
