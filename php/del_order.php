<?php
include_once "db_conn.php";
include_once "functions.php";

$del_result = del_orders($_POST['id']);

if($del_result){
	echo 'success';
}else{
	echo 'failure';
}
?>