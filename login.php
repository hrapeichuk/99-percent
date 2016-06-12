<?php
include_once __DIR__ . "/classes/User.php";
include_once __DIR__ . "/classes/RegisteredUser.php";

$user_exists = false;
$password_is_right = false;

if (isset($_POST['login']) && isset($_POST['password'])) {
    if (\classes\RegisteredUser::auth($_POST['login'], $_POST['password'])) {
        header("Location: index.php");
    }
}
?>
<html>
<head>
    <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css"/>
</head>
<body background="http://b2bbasis.justclick.ru/media/content/b2bbasis/17_6475_oboi_simfonija_chistogo_cveta_1920x1080.jpg">
<div style="margin-top: 150px;">
    <form class="form-horizontal" method="post" action="login.php">
        <form class="form-horizontal">
            <div class="form-group">
                <label for="login" class="col-sm-4 control-label">Фамилия, имя</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" id="login" name="login">
                </div>
            </div>
            <div class="form-group">
                <label for="password" class="col-sm-4 control-label">Пароль</label>
                <div class="col-sm-5">
                    <input type="password" class="form-control" id="password" name="password">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-4 col-sm-8">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox"> Оставаться в системе
                        </label>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-4 col-sm-8">
                    <button type="submit" class="btn btn-default">Войти</button>
                </div>
            </div>
        </form>
    </form>
</div>

