<?php
session_start();
define('diplom', true);
include("include/db_connect.php");

if (isset($_SESSION['auth_start'])) {
    unset($_SESSION['auth_start']);
}
if (isset($_SESSION['auth_start_login'])) {
    unset($_SESSION['auth_start_login']);
}
if (isset($_SESSION['userid'])) {
    unset($_SESSION['userid']);
}

if ($_POST["submit_login"]) {
    $login = $_POST["input_login"];
    $pass = md5($_POST["input_pass"]);

    if ($login && $pass) {
        $query = sprintf(
            "SELECT * FROM Users WHERE login = '%s' AND pass = '%s'",
            mysqli_real_escape_string($mysqli, $login),
            mysqli_real_escape_string($mysqli, $pass)
        );
        $result = mysqli_query($mysqli, $query) or die('Error' . mysqli_error($mysqli));

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_array($result);
            $_SESSION['auth_start'] = 'yes_auth';
            $_SESSION['auth_start_login'] = $login;
            $_SESSION['userid'] = $row['id'];

            header("Location: home.php");
        } else {
            // unset($_POST["submit_login"]);
            $msgerrorlogin = "Неверный логин или пароль";
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/login.css">

    <link href="https://fonts.googleapis.com/css2?family=Notable&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Bellota:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="img/favicon_io/favicon.ico" type="image/x-icon">
</head>

<body>

    <div class="logo">
        <img src="img/icons/logo.png" alt="">
        <div>PUZZLE</div>
    </div>

    <section class="wrap_login">

        <div class="reg_title">
            <div class="enter_link enter_link-active">Вход</div>
            <div class="enter_link"><a href="registration.php">Регистрация</a></div>
        </div>

        <div class="enter">
            <div class="login opened">
                <form action="" method="POST">
                    <div class="form-block">
                        <input type="text" class="form-control" placeholder="Логин" name="input_login">
                    </div>

                    <div class="form-block">
                        <input type="password" class="form-control" placeholder="Пароль" name="input_pass">
                    </div>

                    <div class="form-block form-block__btn">
                        <input type="submit" name="submit_login" class="btn" value="Войти">
                    </div>
                </form>
            </div>

        </div>
        <?php
        if ($msgerrorlogin) {
            echo ' <p>' . $msgerrorlogin . '</p>';
            $is_page_refreshed = (isset($_SERVER['HTTP_CACHE_CONTROL']) && $_SERVER['HTTP_CACHE_CONTROL'] == 'max-age=0');

            if ($is_page_refreshed) {
                echo ' ';
            }
        }



        ?>
    </section>

    <script src="js/login.js"></script>
</body>

</html>