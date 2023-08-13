<?php

session_start();
define('diplom', true);
include("db_connect.php");

$userid = $_GET['userid'];
$deleted = 0;
$done = "AND Tasks.done=0";

if (isset($_GET['deleted'])) {
    $deleted = 1;
    $done = "";
}

$sql = "SELECT Tasks.id, Tasks.title, Tasks.date, Tasks.done, Tasks.userid, Categories.name as category, 
Categories.id as categoryId, Importance.value as importance, Importance.id as importanceId, Users.id as userid FROM Tasks, Categories, Importance, Users 
WHERE Tasks.category=Categories.id AND Tasks.importance=Importance.id ".$done." AND Tasks.userid=Users.id AND Users.id='" . $userid . "' AND Tasks.deleted=" . $deleted . ";";
$res = $mysqli->query($sql);

if ($res->num_rows > 0) {
    header('Content-Type: application/json; charset=utf-8');
    echo (json_encode($res->fetch_all(MYSQLI_ASSOC)));
}
?>