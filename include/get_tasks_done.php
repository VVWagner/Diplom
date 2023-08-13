<?php

session_start();
define('diplom', true);
include("db_connect.php");

$userid = $_GET['userid'];

$sql = "SELECT Tasks.id, Tasks.title, Tasks.date, Tasks.done, Categories.name as category, 
Categories.id as categoryId, Importance.value as importance, Importance.id as importanceId FROM Tasks, Categories, Importance 
WHERE Tasks.category=Categories.id AND Tasks.importance=Importance.id AND Tasks.done=1 AND userid='".$userid."' AND Tasks.deleted=0;";
$res = $mysqli->query($sql);

if ($res->num_rows > 0) {
    header('Content-Type: application/json; charset=utf-8');
    echo(json_encode($res->fetch_all(MYSQLI_ASSOC)));
}
?>