<?php
require_once __DIR__ . '/../functions.php';
$email = $_POST['email'] ?? null;
$password = $_POST['password'] ?? null;


if(empty($email) || !filter_var($email,FILTER_VALIDATE_EMAIL)){
    addOldValue('email',$email);
    addValidationError('email','Неверный формат элеткронной почты');
    setMessage('error', 'Ошибка проверки');
    redirect('/');
}
$user = findUser($email);


if (!$user) {
    setMessage('error', "Пользователь $email не найден");
    redirect('/');
}

if(!password_verify($password,$user['password'])) {
    setMessage('error', "Пароль неверен");
    redirect('/');
}
$_SESSION['user']['id'] = $user['id'];
redirect('/home.php');
var_dump($user);