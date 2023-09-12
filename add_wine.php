<?php

require_once __DIR__ . '/boot.php';

// Проверим, не занято ли наименование вина
$stmt = pdo()->prepare("SELECT * FROM `wine` WHERE `wine_name` = :wine_name");
$stmt->execute(['wine_name' => $_POST['wine_name']]);
if ($stmt->rowCount() > 0) {
    flash('Наименование вина должно быть уникальным!');
    header('Location: catalog.php'); // Возврат
    die; // Остановка выполнения скрипта
}


// Добавим вино
$stmt = pdo()->prepare("INSERT INTO `wine`( `wine_name`, `wine_full_name`, `wine_img`, `wine_img1`,`wine_img_basket`, `wine_discription`, `wine_price`, `quantity`) 
VALUES (:wine_name,:wine_full_name,:wine_img,:wine_img1,:wine_img_basket,:wine_discription, :wine_price, :quantity)");
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
flash('Товар успешно добавлен');
header('Location: catalog.php');
