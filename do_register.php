<?php

require_once __DIR__ . '/boot.php';

// Проверим, не занято ли имя пользователя
$stmt = pdo()->prepare("SELECT * FROM `users` WHERE `email` = :email");
$stmt->execute(['email' => $_POST['email']]);
if ($stmt->rowCount() > 0) {
    flash('Пользователь с таким emailом уже зарегистрирован.');
    header('Location: /'); // Возврат на форму регистрации
    die; // Остановка выполнения скрипта
}


// Добавим пользователя в базу
$stmt = pdo()->prepare("INSERT INTO `users` (`username`,`first_name`,`third_name`,`email`,`phone`, `password`) 
VALUES (:username,:first_name,:third_name,:email,:phone, :password)");
$stmt->execute([
    'username' => $_POST['username'],
    'first_name' => $_POST['first_name'],
    'third_name' => $_POST['third_name'],
    'email' => $_POST['email'],
    'phone' => $_POST['phone'],
    'password' => $_POST['password'],
]);
flash('Вы упешно зарегистрировались теперь вы можете <a class="enterButton">Войти на сайт</a>');
header('Location: index.php');