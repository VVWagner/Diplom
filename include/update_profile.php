<?php 

session_start();
define('diplom', true);
include("db_connect.php");

$id = $_GET['id'];
$name = $_GET['first_name'];
$surname = $_GET['last_name'];


$query = "UPDATE Users SET first_name='".$name."', last_name='".$surname."' WHERE id=".$id.";";

$result = mysqli_query($mysqli, $query) or die("Ошибка" . mysqli_error($mysqli));

mysqli_close($mysqli);

?>