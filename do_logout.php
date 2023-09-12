<?php

require_once __DIR__.'/boot.php';
// обнуляем авторизацию пользователя
$_SESSION['user_id'] = null;
flash('Успешный выход из профиля');
header('Location: /');
