<?php
session_start();
require_once  __DIR__ .'/config.php';
function redirect( $path)
{
    header("Location:$path");
    die();
}
function addValidationError($fieldName,$message)
{
        $_SESSION['validation'][$fieldName] = $message;
}
function ValidationError($fieldName)
{
    $message = $_SESSION['validation'][$fieldName] ?? '';
    unset($_SESSION['validation'][$fieldName]);
    echo $message;
}


function mbError($fieldName)
{
    echo isset(['validation'][$fieldName]) ? 'aria-invalid= "true"' : '';
}

function getErrorMessage($fieldName)
{
    echo $_SESSION['validation'][$fieldName] ?? '';
}


function addOldValue($key, $value): void
{
    $_SESSION['old'][$key] = $value;
}

function old($key)
{
    $value =$_SESSION['old'][$key] ?? '';
    unset($_SESSION['old'][$key]);
    return $value;
}


function getPDO(): PDO
{
    try{
        return  new \PDO(dsn: 'mysql:host='. DB_HOST .';port='. DB_PORT .';dbname=' . DB_NAME, username: DB_USERNAME,password: DB_PASSWORD);

    } catch (\PDOException $e){
        die("Connection error: {$e -> getMessage()}");
    }

}

function setMessage($key,$message):void
{
    $_SESSION['message'][$key] = $message;
}

function hasMessage($key): bool
{
    return isset($_SESSION['message'][$key]);
}
function getMessage($key):?string
{
    $message =  $_SESSION['message'][$key] ?? '';
    unset( $_SESSION['message'][$key]);
    return $message;
}

function findUser($email): array|bool
{
    $pdo = getPDO();

    $stmt = $pdo -> prepare("SELECT * FROM users WHERE email =:email" );
    $stmt -> execute(['email' => $email]);
    return $stmt -> fetch(\PDO::FETCH_ASSOC);
}


function currentUser():array|false
{
    $pdo = getPDO();

    if(!isset($_SESSION['user'])){
        return false;
    }
    $userId = $_SESSION['user']['id'] ?? null;
    $stmt = $pdo -> prepare("SELECT * FROM users WHERE id =:id" );
    $stmt -> execute(['id' => $userId]);
    return $stmt -> fetch(\PDO::FETCH_ASSOC);
}




 function logout()
 {
     unset($_SESSION['user']['id']);
     redirect('/');
 }


function checkAuth():void
{
    if(!isset ($_SESSION['user']['id'])){
        redirect('/');
    }
}


function checkGuest():void
{
    if(!isset($_SESSION['user']['id'])){
        redirect('/home.php');
    }
}


