<?php
date_default_timezone_set("Asia/Taipei");
@session_start();

$create_date = date('Y-m-d h:i:s');
$_SESSION['nowtime'] = $create_date;
echo $_SESSION['nowtime'];

if(file_exists($_FILES['file']['tmp_name']) && $_FILES['file']['error'] == UPLOAD_ERR_OK){

	$target_path = $_POST['save_path'];
	$target_name = $_POST['file']['name'];

	if(move_uploaded_file($_FILES['file']['tmp_name'], $target_path)){
		echo "Moved";
	}else{
		echo "Not moved";
	}
}
?>