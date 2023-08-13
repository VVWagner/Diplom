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
    <link rel="stylesheet" href="css/profile.css">
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

                <div class="main__title__tasks">Профиль</div>


                <div class="main_info">
                    <div>
                        <?php
                        $sql = "SELECT first_name, last_name, image FROM Users WHERE id = " . $_SESSION['userid'] . ";";
                        $res = $mysqli->query($sql);

                        if (mysqli_num_rows($res) > 0) {
                            $row = mysqli_fetch_array($res);
                            ?>

                            <div class="main_photo">
                                <div class="avatar-upload">
                                    <div class="avatar-edit">
                                        <input type='file' id="avatarUpload" class="imageUpload"
                                            data-preview="avatarPreview" name="avatar" accept=".png, .jpg, .jpeg" />
                                        <label for="avatarUpload"><img class="imageUpload_edit" src="img/icons/edit.svg"
                                                alt=""></label>
                                    </div>
                                    <div class="preview">
                                        <div id="avatarPreview"
                                            style="display: block; background-image: url(/uploads_images/<?= $row['image'] ?>)">
                                        </div>
                                    </div>
                                    <p class="error invalid-file"></p>
                                </div>
                            </div>

                            <div class="field_block_name">
                                <div class="block_name">
                                    <?= $row['first_name'] ?>
                                    <?= $row['last_name'] ?>
                                </div>
                                <img class="btn_edit_profile" src="img/icons/edit.svg" alt="">
                            </div>
                            <?php
                        }
                        ?>
                    </div>

                </div>

                <div>

                    <div class="block_name_edit">
                        <div class="fields_name_edit">
                            <input id="inputName" type="text" value="<?= $row['first_name'] ?>">
                            <input id="inputSurName" type="text" value="<?= $row['last_name'] ?>">
                            <input id="btnSaveProfile" type="button" class="btn_save_profile" value=" ">
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.0.min.js"
        integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <script src="js/script.js"></script>
</body>

</html>