<?php

require_once __DIR__ . '/../functions.php';




$name = $_POST['name'] ?? null;
$email = $_POST['email'] ?? null;
$password = $_POST['password'] ?? null;
$password_confirmation = $_POST['password_confirmation'] ?? null;



if(empty($name)){
    addValidationError('name','Неверное имя');
}

if (!filter_var($email,FILTER_VALIDATE_EMAIL)){
    addValidationError('email','Указана неправильная почта');
}

if(empty($password)){
    addValidationError('password', 'Пароль пустой');
}

if(!$password===$password_confirmation){
    addValidationError('password','Пароли не совпадают');
}
if(!empty($_SESSION['validation'])){
    addOldValue('name',$name);
    addOldValue('email',$email);
    redirect('/register.php');
}
$pdo = getPDO();


$query = "INSERT INTO users (name,email,password)  VALUES (:name,:email,:password)";
$params = [
    'name' => $name,
    'email' => $email,
    'password' => password_hash($password, algo: PASSWORD_DEFAULT)
];
$stmt = $pdo -> prepare($query);

try{
    $stmt -> execute($params);

} catch (\Exception $e){
    die($e -> getMessage());
}



redirect(path:'/index.php');
