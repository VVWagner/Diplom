<?php
session_start();
define('diplom', true);
include("include/db_connect.php");
?>


<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>СПИСОК ДЕЛ</title>
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/panel.css">
    <link rel="stylesheet" href="css/completed.css">
    <link rel="stylesheet" href="css/busket.css">
    <link rel="stylesheet" href="css/media.css">
    <link href="https://fonts.googleapis.com/css2?family=Notable&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Bellota:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="img/favicon_io/favicon.ico" type="image/x-icon">

</head>

<body>
    <?php include("include/add_task_field.php") ?>

    <div class="body" id="body">
        <?php include("include/panel.php") ?>


        <div class="container">
            <div class="main" id="main">

                <div class="main__title__tasks main__title__tasks-busket">Корзина
                    <div class="btn_delete_all" id="btnDeleteAll">Удалить всё</div>
                </div>

                <!-- div для списка задач -->
                <div class="main__items" id="allItems">
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.0.min.js"
        integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <script src="js/script.js"></script>
</body>

</html>