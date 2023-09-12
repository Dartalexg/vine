<?php
// обновление информации о профиле
require_once __DIR__ . '/boot.php';
if ((!empty($_POST['password'])) and ($_POST['password'] == $_POST['passwordCheck'])) {  //если пароль не пустой и совпадает с подтвержденным паролем - обновляем
    $stmt = pdo()->prepare("UPDATE `users` SET `username` = '{$_POST['username']}',`first_name` = '{$_POST['first_name']}',
`third_name` = '{$_POST['third_name']}', `email` = '{$_POST['email']}', `phone` = '{$_POST['phone']}', `password` = '{$_POST['password']}'");
    $stmt->execute([
        'username' => $_POST['username'],
        'first_name' => $_POST['first_name'],
        'third_name' => $_POST['third_name'],
        'email' => $_POST['email'],
        'phone' => $_POST['phone'],
        'password' => $_POST['password'],
    ]);
} elseif ((!empty($_POST['password'])) and ($_POST['password'] != $_POST['passwordCheck'])) { //если пароль не пустой и не совпадает с подтвержденным паролем
    flash('Введенные пароли не совпадают');
    header('Location: profile.php');
    die();
} else { //если пароль пустой оставляем старый все остальное меняется
    $stmt = pdo()->prepare("UPDATE `users` SET `username` = '{$_POST['username']}',`first_name` = '{$_POST['first_name']}',
`third_name` = '{$_POST['third_name']}', `email` = '{$_POST['email']}', `phone` = '{$_POST['phone']}', `password` = `password`");
    $stmt->execute([
        'username' => $_POST['username'],
        'first_name' => $_POST['first_name'],
        'third_name' => $_POST['third_name'],
        'email' => $_POST['email'],
        'phone' => $_POST['phone'],
        'password' => 'password',
    ]);
}
flash('Информация успешно изменена');
header('Location: profile.php');




