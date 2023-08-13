<?php 

session_start();
define('diplom', true);
include("db_connect.php");

$id = $_GET['id'];
$userid = $_GET['userid'];
$query = "UPDATE Tasks SET ";

if (!empty($_GET['title'])) {
    $query = $query."title=".$_GET['title'];
}

if (!empty($_GET['done'])) {
    $query = $query."done=".$_GET['done'];
}

if (!empty($_GET['deleted'])) {
    $query = $query."deleted=".$_GET['deleted'];
}

$query = $query." WHERE id=".$id." AND userid='".$userid."';";

$result = mysqli_query($mysqli, $query) or die("Ошибка" . mysqli_error($mysqli));

mysqli_close($mysqli);

?>