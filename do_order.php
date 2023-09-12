<?php

require_once __DIR__.'/boot.php';

$stmt = pdo()->prepare("SELECT * FROM `basket` WHERE `user_id` LIKE '%" . $_SESSION['user_id'] . "%'");
$stmt->execute();
// цикл по строкам вышенаписанной выборки
while ($row = $stmt->fetch(PDO::FETCH_ASSOC))// получаем все строки в цикле по одной
{   // создаем новую запись в заказах (из корзины все переносится в заказы)
    $stmt1 = pdo()->prepare("INSERT INTO `orders`(`user_id`, `wine_id`, `wine_quantity`) 
VALUES ('{$_SESSION['user_id']}', '{$row['wine_id']}', '{$row['wine_quantity']}') ");
    $stmt1->execute([
        'user_id' => $_SESSION['user_id'],
        'wine_id' => $row['wine_id'],
        'wine_quantity' => $row['wine_quantity']
    ]);
}
// чистим корзину пользователя, потому что заказ оформлен
$stmt2 = pdo()->prepare("DELETE FROM `basket` WHERE `user_id` LIKE '%" . $_SESSION['user_id'] . "%'");
$stmt2->execute(['wine_id' => $_SESSION['user_id']]);

flash('Заказ успешно оформлен!');
header('Location: index.php');