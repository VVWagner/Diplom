<?php 

session_start();
define('diplom', true);
include("db_connect.php");

$userid = $_GET['userid'];

$query = "DELETE FROM Tasks WHERE userid='$userid'";
$quer = "DELETE FROM Users WHERE id='$userid'";

$result = mysqli_query($mysqli, $query) or die("Ошибка" . mysqli_error($mysqli));
$res = mysqli_query($mysqli, $quer) or die("Ошибка" . mysqli_error($mysqli));

mysqli_close($mysqli);

header("Location: {$_SERVER['HTTP_REFERER']}");

?>