<?php
session_start();
define('diplom', true);
include("include/db_connect.php");

if (isset($_SESSION['auth_admin_start'])) {
    unset($_SESSION['auth_admin_start']);
}

if ($_POST["submit_login"]) {
    $login = $_POST["input_login"];
    $pass = md5($_POST["input_pass"]);

    if ($login && $pass) {
        $query = sprintf(
            "SELECT * FROM Admin WHERE login = '%s' AND password = '%s'",
            mysqli_real_escape_string($mysqli, $login),
            mysqli_real_escape_string($mysqli, $pass)
        );
        $result = mysqli_query($mysqli, $query) or die('Error' . mysqli_error($mysqli));

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_array($result);
            $_SESSION['auth_admin_start'] = 'yes_auth';

            header("Location: admin_panel.php");
        } else {
            $msgerrorlogin = "Wrong login or password";
        }
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
        </div>

        <div class="enter">

            <div class="login opened">
                <form action="" method="POST">
                    <div class="form-block">
                        <label class="form-label" for="input_login">Логин</label>
                        <input type="text" class="form-control" name="input_login">
                    </div>

                    <div class="form-block">
                        <label class="form-label" for="input_pass">Пароль</label>
                        <input type="password" class="form-control" name="input_pass">
                    </div>

                    <div class="form-block form-block__btn">
                        <input type="submit" name="submit_login" class="btn" value="Войти">
                    </div>
                </form>

                <?php
                if ($msgerrorlogin) {
                    echo ' <p>' . $msgerrorlogin . '</p>';
                }
                ?>
            </div>

        </div>
    </section>

    <script src="js/login.js"></script>
</body>

</html>