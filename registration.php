<?php
include_once __DIR__ . "/classes/User.php";
include_once __DIR__ . "/classes/UnregisteredUser.php";

$user_exists = false;

$unregistered_user = \classes\UnregisteredUser::buildFromPost($_POST);

if (isset($_POST['login']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['passwordConfirm'])) {

    $unregistered_user->Validate();
    $unregistered_user->Registration();
    header("Location: index.php");
}
?>
<html>
<head>
    <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css"/>
</head>
<body background="http://b2bbasis.justclick.ru/media/content/b2bbasis/17_6475_oboi_simfonija_chistogo_cveta_1920x1080.jpg">
<div style="margin-top: 150px;">
    <form class="form-horizontal" method="post" action="registration.php">
        <div class="form-group">
            <label for="login" class="col-sm-4 control-label">Фамилия, имя</label>
            <div class="col-sm-5">
                <input type="text" class="form-control" id="login" name="login" placeholder="Иванов Иван" required>
            </div>
        </div>
        <div class="form-group">
            <label for="email" class="col-sm-4 control-label">Электронная почта</label>
            <div class="col-sm-5">
                <input type="email" class="form-control" id="email" name="email" placeholder="ivanov.ivan@gmail.com" required>
            </div>
        </div>
        <div class="form-group">
            <label for="password" class="col-sm-4 control-label">Пароль</label>
            <div class="col-sm-5">
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
        </div>
        <div class="form-group">
            <label for="passwordConfirm" class="col-sm-4 control-label">Подтверждение пароля</label>
            <div class="col-sm-5">
                <input type="password" class="form-control" id="passwordConfirm" name="passwordConfirm" required>
            </div>
        </div>
        <div style="margin-top: 25px;" class="form-group">
            <div class="col-sm-offset-4 col-sm-2">
                <button type="submit" class="btn btn-default">Зарегистрироваться</button>
            </div>
        </div>
    </form>
    <?php if ($user_exists): ?>
        <div class="alert alert-danger col-sm-offset-4 col-sm-5 text-center" role="alert">
            <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
            <span class="sr-only">Error:</span>
            Пользователь с такими данными уже существует. Попробуйте ещё раз.
        </div>
    <?php endif; ?>
</div>

