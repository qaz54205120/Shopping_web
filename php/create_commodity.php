<?php
include_once "functions.php";

$result = create_commodity($_POST['id'], $_POST['item_name'], $_POST['price'], $_POST['amount'], $_POST['dataname']);
//print_r($result);

if($result == true){
	echo 'success';
}else if($reuslt == false){
	echo 'failure';
}else{
	echo 'no';
}