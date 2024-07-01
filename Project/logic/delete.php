<?php
session_start();
include_once("./connect.db.php");
include_once('./calculator.php');
$link = mysqli_connect($server, $user, $password, $database);
$id = (int)$_SESSION['userID'];

$deleteQuery = "DELETE FROM data WHERE users_ID = ? AND year=? AND month=?;";
$query = mysqli_prepare($link, $deleteQuery);
mysqli_stmt_bind_param($query, "iis", $id, $chYear, $chMonth);
mysqli_stmt_execute($query);
header("Location: ../history.php");
?>