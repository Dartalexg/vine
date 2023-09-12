<?php

require_once __DIR__ . '/boot.php';

// проверяем наличие пользователя с указанным юзернеймом
$stmt = pdo()->prepare("SELECT * FROM `users` WHERE `email` = :email");
$stmt->execute(['email' => $_POST['emailEnter']]);
if (!$stmt->rowCount()) {
    flash('Пользователь с такими данными не зарегистрирован');
    header('Location: index.php');
    die;
}
$user = $stmt->fetch(PDO::FETCH_ASSOC);

// проверяем пароль
if ($_POST['passwordEnter'] == $user['password']) {
    $stmt = pdo()->prepare('UPDATE `users` SET `password` = :password WHERE `email` = :email');
    $stmt->execute([
        'email' => $_POST['emailEnter'],
        'password' => $_POST['passwordEnter'],
    ]);
    $_SESSION['user_id'] = $user['id'];
    flash('Вы успешно зашли на сайт');
    header('Location: /');
    die;

}

flash('Пароль неверен');
header('Location: index.php');