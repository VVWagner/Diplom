<?php

session_start();
define('diplom', true);
include("include/db_connect.php");

if (isset($_SESSION['auth_admin_start'])) {
    if ($_SESSION['auth_admin_start'] != 'yes_auth') {
        unset($_SESSION['auth_admin_start']);
        header("Location: admin.php");
    }
}

?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>

    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/admin.css">

    <link href="https://fonts.googleapis.com/css2?family=Notable&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Bellota:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="img/favicon_io/favicon.ico" type="image/x-icon">
</head>

<body>

    <nav>
        <div class="nav_left">
            <div class="logo">
                <img src="img/icons/logo.png" alt="">
                <div class="logo_name">ADMIN PANEL</div>
            </div>

            <a href="/admin_panel.php" class="panel__exit">
                <img src="img/icons/user_admin.svg" alt="">
                <p>Пользователи</p>
            </a>
        </div>

        <a href="/admin.php" class="panel__exit">
            <img src="img/icons/exit.svg" alt="">
            <p>Выйти</p>
        </a>
    </nav>

    <div class="users">
        <?php
        $sql = "SELECT id, first_name, last_name FROM Users";
        $res = $mysqli->query($sql);

        while ($row = $res->fetch_assoc()) {
            ?>
            <div class="users__block" id="<?= $row['id'] ?>">

                <div class="user_info">
                    <div class="user_name">
                        <?= $row['id'] ?>.
                        <?= $row['first_name'] ?>
                        <?= $row['last_name'] ?>
                    </div>

                    <div class="user_btns">
                        <div class="user_delete" id="<?= $row['id'] ?>">Удалить</div>
                    </div>
                </div>
            </div>

            <?php
        }
        ?>

    </div>

    <script src="https://code.jquery.com/jquery-3.7.0.min.js"
        integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>

    <script src="js/admin.js"></script>
</body>

</html>