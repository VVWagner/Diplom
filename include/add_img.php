<?php
define('diplom', true);
include("db_connect.php");

$error_img = "";

if ($_FILES['upload_image']['type'] == 'image/jpeg' || $_FILES['upload_image']['type'] == 'image/jpg' || $_FILES['upload_image']['type'] == 'image/png') {

    $imgext = strtolower(preg_replace("#.+\.([a-z]+)$#i", "$1", $_FILES['upload_image']['name']));

    //папка для загрузки
    $uploaddir = '../uploads_images/';
    //новое сгенерированное имя файла
    $newfilename = rand(10, 30000) . '.' . $imgext;
    //путь к файлу (папка.файл)
    $uploadfile = $uploaddir . $newfilename;
    $userid = mysqli_real_escape_string($mysqli, $_POST["userid"]);
    //загружаем файл move_uploaded_file
    if (move_uploaded_file($_FILES['upload_image']['tmp_name'], $uploadfile)) {
        $query = sprintf(
            "SELECT image FROM Users WHERE id = %d;",
            $userid
        );
        $result = mysqli_query($mysqli, $query) or die('Error' . mysqli_error($mysqli));

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_array($result);
            if (!(strlen($row["image"]) == 0)) {
                unlink('../uploads_images/' . $row["image"]);
            }
            $query = sprintf(
                "UPDATE Users SET image = '%s' where id = %d;",
                $newfilename,
                $userid
            );
            $result = mysqli_query($mysqli, $query) or die('Error' . mysqli_error($mysqli));
            http_response_code(200);
        } else {
            $error_img = "Ошибка загрузки файла. Данный пользователь не найден";
        }
    } else {
        $error_img = "Ошибка загрузки файла.";
    }
} else {
    $error_img = 'Допустимые расширения: jpeg, jpg, png';
}

if ($error_img != "") {
    header(sprintf('HTTP/2.1 %s', $error_img));
    http_response_code(503);
    echo ("<p id='form-error'>" . $error_img . "</p><script>console.log('" . $error_img . "')</script>");
}
?>