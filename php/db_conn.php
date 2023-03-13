<?php

class database{
	private $dbms = 'mysql';
	private $host = 'localhost';
	private $dbname = 'shopping_web';
	private $username = 'root';
	private $password = 'ntueman123456';

	private static $conn;

	public function Connect(){
		try{
			#MYSQL connect and encode
			self::$conn = new PDO("mysql:host".$this->host.";dbname=".$this->dbname, $this->username, $this->password,array(PDO::ATTR_PERSISTENT=>true,PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
			#設定錯誤訊息
			self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		}catch(PDOExcecption $e){
			echo "Connection is error:".$e->getMessage();
			self::$conn = null;
		}
	}
	public function getConnect(){
		return self::$conn;
	}
	public function Close(){
		return self::$conn = null;
	}
}
function ConnectProcess($ON = 0){
    $conn = new database();
    $conn->Connect();

    if($ON == 1)
        return $conn->getConnect();
    else
        return null;
}
/*$dbms = 'mysql';
$host = 'localhost';
$dbname = 'shopping_web';
$username = 'root';
$password = 'ntueman123456';

$dsn = "$dbms:host=$host;dbname=$dbname";

try{
	$conn = new PDO($dsn,$username,$password);
}catch(PDOExcecption $e){
	echo "Connection is error:".$e->getMessage();
}

$sql = $conn->prepare("SELECT account FROM `member` WHERE account='qaz542051201'");
//$sql = "SELECT account FROM `member` WHERE account='qaz54205120'";
//$conn->exec($sql);
$sql->execute();

$result = $sql->fetch(PDO::FETCH_ASSOC);
if($result){
	echo "yes";
}else{
	echo "Failure";
}*/


?>