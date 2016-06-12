<?php
session_start();

include_once __DIR__ . "/classes/Game.php";
include_once __DIR__ . "/classes/Question.php";
include_once __DIR__ . "/classes/ImageQuestion.php";
include_once __DIR__ . "/classes/VideoQuestion.php";
include_once __DIR__ . "/classes/AudioQuestion.php";
include_once __DIR__ . "/classes/Response.php";
include_once __DIR__ . "/classes/User.php";
include_once __DIR__ . "/classes/RegisteredUser.php";
include_once __DIR__ . "/classes/DataBase.php";


$game = new \classes\Game();

if (isset($_GET['reset'])) {
    $game->reset();
    header("Location: index.php");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $response = \classes\Response::constructFromPost($_POST, $game->getQuestion());

    if ($response->isValid()) {
        $game->goToNextLevel();
        header("Location: index.php");
    }
}

if (isset($_GET['exit'])) {
    \classes\RegisteredUser::unAuthorize();
    header('Location: index.php');
}
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap-theme.min.css">
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
</head>
<body background="http://b2bbasis.justclick.ru/media/content/b2bbasis/17_6475_oboi_simfonija_chistogo_cveta_1920x1080.jpg">
<div class="container-fluid">
    <?php if ($game->isEnd()): ?>
        <div style="position: absolute; margin-top: 200px; margin-left: 380px; width: 550px; height: 600px;" class="text-center">
        <div class="jumbotron">
            <h2>Поздравляем, вы прошли все уровни!</h2>
            <p>Вы успешно подобрали ассоциации для всех вопросов и одержали победу!!!</p>
            <p><a class="btn btn-danger" href="index.php?reset=1" role="button">Начать с начала</a></p>
        </div>
        </div>
    <?php else: ?>
        <?php if (\classes\RegisteredUser::isAuthorized()): ?>
            <div class="col-sm-1 col-sm-offset-11 text-center" style="margin-top: 15px;">
                <a href="index.php?exit=1">Выход</a>
            </div>
        <?php else: ?>
            <div class="col-sm-1 col-sm-offset-10 text-center" style="margin-top: 15px;">
                <a href="login.php">Вход</a>
            </div>
            <div class="col-sm-1 text-center" style="margin-top: 15px;">
                <a href="registration.php">Регистрация</a>
            </div>
        <?php endif; ?>
    <div class="row" style="margin-top: 15px;">
        <div class="col-xs-12 text-center"><h1>Уровень <?php echo $game->getLevel(); ?></h1></div>
    </div>
    <div class="row">
        <div class="col-xs-6 text-center">
                <?php echo $game->getQuestion()->display(); ?>
        </div>
        <div class="col-xs-5" style="margin-top: 100px">
            <form class="form-horizontal" method="post">
                <?php for ($i = 1; $i <= 5; $i++): ?>
                    <div class="form-group <?php echo isset($response) ? ($response->checkAnswer(isset($_POST['tag_' . $i]) ? $_POST['tag_' . $i] : '') ? 'has-success' : 'has-error') : ''; ?>">
                        <label for="tag_<?php echo $i; ?>" class="col-sm-2 control-label">Слово <?php echo $i; ?></label>
                        <div class="col-sm-10">
                            <input type="text" name="tag_<?php echo $i; ?>" class="form-control" id="tag_<?php echo $i; ?>" value="<?php echo isset($_POST['tag_' . $i]) ? $_POST['tag_' . $i] : ''; ?>">
                        </div>
                    </div>
                <?php endfor; ?>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-4">
                        <button type="submit" class="btn btn-default">Проверить</button>
                    </div>
                    <div class="col-sm-6 text-right">
                        <a href="index.php?reset=1" class="btn btn-danger">Начать с начала</a>
                    </div>
                </div>
        </div>
    </div>
    <?php endif; ?>
</div>
</body>
</html>
