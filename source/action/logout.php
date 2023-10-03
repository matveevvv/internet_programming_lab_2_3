<?php
require_once __DIR__ .'/register.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    logout();
}

redirect('/home.php');