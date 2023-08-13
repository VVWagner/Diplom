<?php 

session_start();
define('diplom', true);
include("db_connect.php");

$userid = $_GET['userid'];

$query = "DELETE FROM Tasks WHERE userid='$userid' AND deleted=1";

$result = mysqli_query($mysqli, $query) or die("Ошибка" . mysqli_error($mysqli));

mysqli_close($mysqli);

header("Location: {$_SERVER['HTTP_REFERER']}");

?>