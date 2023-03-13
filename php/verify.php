<?php
include_once "db_conn.php";
include_once "functions.php";

$conn = new database;
$conn->Connect();
$connect = $conn->getConnect();
//print_r($connect);

	/*function verify_user($username,$password){
		$result = null;

		//echo "Connected"."</br>";
		//echo $username."</br>";
		//echo $password."</br>";
		//print_r($GLOBALS['connect']);
		$sql = $GLOBALS['connect']->prepare("SELECT `account`, `password` FROM shopping_web.member WHERE account = :account AND password = :password");
		$sql->bindParam(':account', $username,PDO::PARAM_STR, 15);
		$sql->bindParam(':password', $password,PDO::PARAM_STR, 127);
		$sql->execute();

		$user = $sql->fetch(PDO::FETCH_ASSOC);

		if($user){
			echo "yes";
		}else{
			echo "no";
		}
	}*/


switch(verify_user($_POST['un'],$_POST['pw'])){
	case 0:
		echo 'superuser';
		break;
	case 1:
		echo 'user';
		break;
	default:
		echo 'fail';
}
$conn=null;
?>