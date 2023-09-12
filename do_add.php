<?php
// логика описана в delete_wine.php
require_once __DIR__.'/boot.php';
$actual_link = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";                                              // получаем текущую ссылку
$query = parse_url($actual_link, PHP_URL_QUERY);                                                      // парсим
parse_str($query, $parts);

$stmt = pdo()->prepare("INSERT INTO `basket`(`user_id`, `wine_id`, `wine_quantity`) 
VALUES ('{$_SESSION['user_id']}', '{$parts['id']}', '{$_POST['quantity']}') ");
$stmt->execute([
    'user_id' => $_SESSION['user_id'],
    'wine_id' => $parts['id'],
    'wine_quantity' => $_POST['quantity']
]);
flash('Товар успешно добавлен в корзину');
header('Location: catalog.php');