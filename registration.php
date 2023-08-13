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

if ($_POST["submit_reg"]) {
    $login = $_POST["input_login"];
    $pass = md5($_POST["input_pass"]);
    $name = $_POST["input_name"];
    $surname = $_POST["input_surname"];
    $msgerrorreg = '';


    if (strlen($login) < 3) {
        $msgerrorreg = "Логин должен быть не менее 3 символов";
    }
    if (strlen($pass) < 3) {
        $msgerrorreg = "Пароль должен быть не менее 3 символов";
    }
    if (strlen($name) < 3) {
        $msgerrorreg = "Имя должно быть не менее 3 символов";
    }
    if (strlen($surname) < 3) {
        $msgerrorreg = "Фамилия должна быть не менее 3 символов";
    }

    if ($msgerrorreg == '') {
        $query = "SELECT * FROM Users WHERE login = '$login'";
        $result = mysqli_query($mysqli, $query) or die('Error' . mysqli_error($mysqli));
        if (mysqli_num_rows($result) > 0) {
            $msgerrorreg = "Login is already exist!";
            header('HTTP/2.1 Login is already exist!');
            http_response_code(409);
        } else {
            $query = sprintf(
                "INSERT into Users (login, pass, first_name, last_name) values ('%s', '%s', '%s', '%s');",
                mysqli_real_escape_string($mysqli, $login),
                mysqli_real_escape_string($mysqli, $pass),
                mysqli_real_escape_string($mysqli, $name),
                mysqli_real_escape_string($mysqli, $surname)
            );
            $result = mysqli_query($mysqli, $query) or die('Error' . mysqli_error($mysqli));

            $query = sprintf(
                "SELECT id FROM Users WHERE login = '%s'",
                mysqli_real_escape_string($mysqli, $login)
            );
            $result = mysqli_query($mysqli, $query) or die('Error' . mysqli_error($mysqli));

            if (mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_array($result);
                $_SESSION['auth_start'] = 'yes_auth';
                $_SESSION['auth_start_login'] = $login;
                $_SESSION['userid'] = $row['id'];

                header("Location: home.php");
            } else {
                header("Location: index.php");
            }
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
    <title>Registration</title>

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
            <div class="enter_link"><a href="index.php">Вход</a></div>
            <div class="enter_link enter_link-active">Регистрация</div>
        </div>

        <div class="enter">
            <div class="reg">
                <form action="" method="POST">
                    <div class="form-block">
                        <label class="form-label" for="input_login" value="Логин">Логин</label>
                        <input type="text" class="form-control" minlength="3" name="input_login" required>
                    </div>

                    <div class="form-block">
                        <label class="form-label" for="input_name" value="Имя">Имя</label>
                        <input type="text" class="form-control" minlength="3" name="input_name" required>
                    </div>

                    <div class="form-block">
                        <label class="form-label" for="input_surname" value="Фамилия">Фамилия</label>
                        <input type="text" class="form-control" minlength="3" name="input_surname" required>
                    </div>

                    <div class="form-block">
                        <label class="form-label" for="input_pass" value="Пароль">Пароль</label>
                        <input type="password" class="form-control" minlength="3" name="input_pass" required>
                    </div>

                    <div class="form-block form-block__btn">
                        <input type="submit" name="submit_reg" class="btn" value="Зарегистрироваться">
                    </div>
                </form>
            </div>

        </div>
        <?php
        if ($msgerrorreg) {
            header("Location: ".$_SERVER['REQUEST_URI']);
            echo ' <p>' . $msgerrorreg . '</p>';
        }
        ?>
    </section>
</body>

</html>