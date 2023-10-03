
<?php
require_once __DIR__ . '/source/functions.php';
checkAuth();
$user = currentUser();
?>


<!DOCTYPE html>
<html lang="ru" data-theme="light">
<head>
    <meta charset="UTF-8">
    <title>AreaWeb - авторизация и регистрация</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@1/css/pico.min.css">
    <link rel="stylesheet" href="assets/app.css">
</head>
<body>

<div class="card home">
    <img
        class="avatar"
        src="https://img.gazeta.ru/files3/516/15017516/upload-GettyImages-1166522079-pic_32ratio_900x600-900x600-58937.jpg"
        alt="<?php echo $user['name'] ?>"
    >
    <h1>Привет, <?php echo $user['name'] ?>!</h1>
    <form action="source/action/logout.php" method="post">
        <button role ="button" >Выйти из аккаунта</button>
    </form>
</div>

<script src="assets/app.js"></script>
</body>
</html>
