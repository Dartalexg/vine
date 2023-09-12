<?php
// Подключаемся к базе
require_once __DIR__ . '/boot.php';
// забираем текущую ссылку (url), в нем содержится id товара, который нужно удалить
$actual_link = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$query = parse_url($actual_link, PHP_URL_QUERY); // парсим чтобы вытащить id
parse_str($query, $parts);
// Удаляем запись из базы, где id вина совпадает с тем, что нам передали в url
$stmt = pdo()->prepare("DELETE FROM `wine` WHERE `wine_id` LIKE '%" . $parts['id'] . "%'");
$stmt->execute(['wine_id' => $parts['id']]);
// выводим сообщение об успешной операции
flash('Товар успешно удален');
// переадресация на каталог с товарами
header('Location: catalog.php');

