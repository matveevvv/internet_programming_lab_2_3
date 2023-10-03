<?php
require_once __DIR__ .'/source/functions.php';
checkGuest();
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

<form class="card"  action="source/action/login.php"  method="post">
    <h2>Вход</h2>

    <?php if (hasMessage('error')):?>
        <div class="notice error"><?php echo getMessage('error')?></div>
    <?php endif;?>
    <label for="email">
        Имя
        <input
            type="text"
            id="email"
            name="email"
            placeholder="Иванов Иван"

            value="<?php echo old('email')?>"
            <?php mbError('email');?>
        >
        <?php if (ValidationError('email')) : ?>
            <small> <?php getErrorMessage('email'); ?> </small>
        <?php endif; ?>
    </label>

    <label for="password">
        Пароль
        <input
            type="password"
            id="password"
            name="password"
            placeholder="******"
            required
        >
    </label>

    <button
        type="submit"
        id="submit"
    >Продолжить</button>
</form>

<p>У меня еще нет <a href="/register.php">аккаунта</a></p>

<script src="assets/app.js"></script>
</body>
</html>
