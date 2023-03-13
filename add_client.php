<?php
include_once "php/db_conn.php";
include_once "php/functions.php";

$conn = new database;
$conn->Connect();
$connect = $conn->getConnect();

register_account($_POST['name'],$_POST['un'],$_POST['pw'],$_POST['email'],$_POST['telephone'],$_POST['Bdate'],$_POST['rank']);



?>