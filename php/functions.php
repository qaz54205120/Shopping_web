<?php
include_once 'db_conn.php';
date_default_timezone_set('Asia/Taipei');

@session_start();

$conn = new database;
$conn->Connect();
$connect = $conn->getConnect();
//print_r($connect);

function verify_user($username,$password){
	$result = -1;

	//echo "Connected"."</br>";
	//echo $username."</br>";
	//echo $password."</br>";
	//print_r($GLOBALS['connect']);
	//$sql = $GLOBALS['connect']->prepare("SELECT `account`, `password` FROM shopping_web.member WHERE account = :account AND password = :password");
	$sql = $GLOBALS['connect']->prepare("SELECT `account`, `password`,`rank` FROM shopping_web.member WHERE account = :account AND password = :password");
	$sql->bindParam(':account', $username,PDO::PARAM_STR, 15);
	$sql->bindParam(':password', $password,PDO::PARAM_STR, 127);
	$sql->execute();

	$user = $sql->fetch(PDO::FETCH_ASSOC);

	if($user){
		$_SESSION['account'] = $user['account'];
		//print_r($user['account']);
		$_SESSION['user_is_login'] = true;
		$_SESSION['rank'] = $user['rank'];
		$result = $_SESSION['rank'];
	}else{
		$reuslt = -1;
	}
	return $result;
}

function register_account($name,$username,$password,$email,$telephone,$Bdate,$rank){
	$sql = $GLOBALS['connect']->prepare("INSERT INTO shopping_web.member(`name`,`account`,`password`,`rank`,`email`,`telephone`,`Bdate`) VALUES (:name,:username,:password,:rank,:email,:telephone,:Bdate)");
	$sql->bindParam(':name', $name,PDO::PARAM_STR, 15);
	$sql->bindParam(':username', $username,PDO::PARAM_STR, 15);
	$sql->bindParam(':password', $password,PDO::PARAM_STR, 127);
	$sql->bindParam(':rank', $rank,PDO::PARAM_INT, 1);
	$sql->bindParam(':email', $email,PDO::PARAM_STR, 50);
	$sql->bindParam(':telephone', $telephone,PDO::PARAM_STR, 10);
	$sql->bindParam(':Bdate', $Bdate,PDO::PARAM_STR, 40);

	//$sql = $GLOBALS['connect']->prepare("SELECT * FROM `member`");

	$sql->execute();

	$row = $sql->rowCount();
	if($row==1){
		echo "success";
	}else{
		echo "failure";
	}
}

function all_members(){
	$data = array();
	try{
		$sql = $GLOBALS['connect']->prepare("SELECT * FROM shopping_web.member");
		$sql->execute();

		$data = $sql->fetchAll(PDO::FETCH_ASSOC);
	//print_r($data);
	}catch(PDOExcecption $e){
		echo "get_all_member failed:". $e->getMessage();
	}

	return $data;
}

function del_member($username){
	try{
		$sql = $GLOBALS['connect']->prepare("DELETE FROM shopping_web.member WHERE account = :account");
		$sql->bindParam(":account", $username, PDO::PARAM_STR, 15);
		$sql->execute();

		$row = $sql->rowCount();
		if($row==1){
			return true;
		}else{
			return false;
		}
	}catch(PDOExcecption $e){
		echo "Delete member fail:".$e->getMessage();
	}
}

function del_commodity($id){
	try{
		$sql = $GLOBALS['connect']->prepare("DELETE FROM shopping_web.products WHERE id = :id");
		$sql->bindParam(":id", $id, PDO::PARAM_STR, 15);
		$sql->execute();

		$row = $sql->rowCount();
		if($row==1){
			return true;
		}else{
			return false;
		}
	}catch(PDOExcecption $e){
		echo "Delete member fail:".$e->getMessage();
	}
}
function get_commodity_id(){

	try{
		$sql = $GLOBALS['connect']->prepare("SELECT MAX(id)+1 'idno' FROM shopping_web.products");
		$sql->execute();

		$datas = $sql->fetch(PDO::FETCH_ASSOC);
		$id = $datas['idno'];
	}catch(PDOExcecption $e){
		echo "get id Failure". $e->getMessage();
	}
	return $id;
}
function create_commodity($commodity_id, $item_name, $price, $amount, $dataname){

	//$time = $_SESSION['nowtime'];
	$time = date('Y-m-d h:i:s');
	//echo $time;
	try{
		$sql = $GLOBALS['connect']->prepare("INSERT INTO shopping_web.products(`id`,`name`, `price`, `quantity`, `img`, `date_added`) VALUES (:id,:name, :price, :quantity, :img, :date_added)");
		$sql->bindParam(":id", $commodity_id, PDO::PARAM_INT, 11);
		$sql->bindParam(":name", $item_name, PDO::PARAM_STR, 200);
		$sql->bindParam(":price", $price, PDO::PARAM_INT, 10);
		$sql->bindParam(":quantity", $amount, PDO::PARAM_INT, 11);
		$sql->bindParam(":img", $dataname, PDO::PARAM_STR, 10);
		$sql->bindParam(":date_added", $time,PDO::PARAM_STR, 40);
		$sql->execute();

		$row = $sql->rowCount();

		if($row == 1){
			return true;
		}else{
			return false;
		}
	}catch(PDOExcecption $e){
		echo 'Have a problem'.$e->getMessage();
	}
}
function all_commodity(){
	$data = array();
	try{
		$sql = $GLOBALS['connect']->prepare("SELECT * FROM shopping_web.products");
		$sql-> execute();

		$data = $sql->fetchAll(PDO::FETCH_ASSOC);
	}catch(PDOExcecption $e){
		echo 'failed to get'.$e->getMessage();
	}
	return $data;
}
function get_order_id(){
	try{
		$sql = $GLOBALS['connect']->prepare("SELECT MAX(order_id)+1 'idno' FROM shopping_web.mem_orders");
		$sql->execute();

		$datas = $sql->fetch(PDO::FETCH_ASSOC);
		$id = $datas['idno'];
	}catch(PDOExcecption $e){
		echo "get id Failure". $e->getMessage();
	}
	return $id;
}

function all_orders(){
	try{
		$sql= $GLOBALS['connect']->prepare("SELECT * FROM shopping_web.mem_orders");
		$sql->execute();

		$data = $sql->fetchAll(PDO::FETCH_ASSOC);
	}catch(PDOExcecption $e){
		echo 'fail to get all all_order'.$e->getMessage();
	}
	return $data;
}

function del_orders($id){
	try{
		$sql = $GLOBALS['connect']->prepare("DELETE FROM shopping_web.mem_orders WHERE order_id = :id");
		$sql->bindParam(":id", $id, PDO::PARAM_STR, 15);
		$sql->execute();

		$row = $sql->rowCount();
		if($row>=1){
			return true;
		}else{
			return false;
		}
	}catch(PDOExcecption $e){
		echo "Delete member fail:".$e->getMessage();
	}
}
?>