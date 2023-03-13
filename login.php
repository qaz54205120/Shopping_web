<?php
// include_once "php/functions.php";
// include_once "php/db_conn.php";

// @session_start();
// $conn = new database();
// $conn->Connect();


// if(isset($_SESSION['user_is_login']) && $_SESSION['user_is_login']){
// 	switch($_SESSION['rank']){
// 		case 0:
// 			header("Location: manager.php");
// 			echo 'rank is 0';
// 			break;
// 		case 1:
// 			header("Location: index.php");
// 			echo 'rank is 1';
// 			break;
// 		default:
// 			echo 'Rank is error';
// 	}
// }

?> 

<!DOCTYPE html>
<html lang="en" dir="ltr">
	<head>
		<link rel="stylesheet" type="text/css" href="css/login.css">
	</head>
	<body>
		<div class="center">
			<h1>Login</h1>
			<form>
			<div class="txt_field">
				<input type = "username" id="username" required>
				<span></span>
				<label>會員帳號</label>
			</div>
			<div class="txt_field">
				<input type = "password" id="password" required>
				<span></span>
				<label>會員密碼</label>
			</div>
			
			<input type="submit" id="login" value="Login"></input>
			<div class="signup_link">
				<!-- <button type="button" id="register" onclick="location.href='register.php'">會員註冊</button> -->
				<a href="register.php">Signup</a> 
			</div>
		</form>
		</div>
		</body>
</html>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
	$(document).ready(function() {
	$("#login").click(function() {
		if($('#username').val() == '' || $('#password').val()==''){
				alert("有欄位未輸入，請輸入");
		}else{
		$.ajax({
			type: "POST",
			url: 'php/verify.php',
			data:{
				un: $("#username").val(),
				pw: $("#password").val(),
			},
			dataType: 'html'
		}).done(function(data){
			console.log(data+ 'send successful');
			
			switch(data){
				case 'superuser':
					alert("Welcome! You're superuser.");
					window.location.href = "manager.php";
					break;
				case 'user':
					alert("Welcome! You're user.");
					window.location.href = 'index.php';
					break;
				default:
					alert("帳號密碼輸入錯誤，請確認後再輸入");
			}
			/*if(data == "superuser"){
				alert("Welcome! You're superuser.");
				window.location.href = 'manager.php';
			}else{
				alert("Welcome! You're user.");
				window.location.href = 'index.html';
			}*/

		}).fail(function(jqXHR,textStatus, errorTrown){
			alert("fail");
			console.log(jqXHR.responseText);
		});
		return false;
	}
		  });
	});
	/*$(document).ready(function() {
	$(".login").on("submit", function() {
		$("#up").attr("disabled",true);
		$.ajax({
			type: "POST",
			url: 'verify.php',
			data:{
				un: $("#username").val(),
				pw: $("#password").val(),
			},
			dataType: 'html'
		}).done(function(data){
			console.log(data+ 'send successful');

			if(data='Connected'){
				alert('Success');
			}

		}).fail(function(jqXHR,textStatus, errorTrown){
			alert("fail");
			console.log(jqXHR.responseText);
		});
		return false;
		  });
	});*/
</script>

<?php
/*error_reporting(E_ALL);
ini_set('display_errors',1);
//mysqli_report(MYSQLI_REPORT_ERROR｜MYSQLI_REPORT_STRICT);
//include_once 'db_conn.php';

$host = "localhost";
$username = "root";
$password = "ntueman123456";
$dbname = "web_db";


$id = 'qaz5420';
$pw = '123';

try {
	$conn = new PDO("mysql:host=$host;dbname=$dbname",$username,$password);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


	//$query = "SELECT `id` FROM account WHERE id = :id";
	$sql = $conn->prepare("SELECT `id` FROM account WHERE id = :id");
	//$query->bindParam(':id',$id, PDO::PARAM_STR, 10);
	$sql->bindParam(':id',$id, PDO::PARAM_STR,10);
  //$sql->bindParam(':pw',$pw, PDO::PARAM_STR,256);
	//$sql =$conn->prepare($query);
	$sql->execute();

	$user = $sql->Fetch(PDO::FETCH_ASSOC);

	echo gettype($user)."/<br>";
	print_r($user);
	echo "</br>";

	if($user){
		echo 'yes'."</br>";
	}else{
		echo 'no'."</br>";
	}
} catch (PDOExcecption $e) {
	echo "failed:".$e->getMessage();
}

$sql = "SELECT id,password FROM `account` WHERE id = 'qaz5420' AND 'password' = 123";
//$sql = "SELECT username,id,password FROM account";
$result = $conn->query($sql);
print_r($result);
echo "</br>";

if($result){
	echo 'have'."</br>";
}else if($result == false){
	echo 'no1'."</br>";
	echo $result;
}

if($result = $conn->query($sql)){
	while($row = $result->fetch(PDO::FETCH_ASSOC)){
		print_r($row."</br>");
	}
	
}else{
	echo 'not'."</br>";
}
print_r($result);
/*$row = $result->fetch_assoc();
print_r($row);

if ($result->num_rows > 0) {
  echo "<table><tr><th>ID</th><th>Name</th><th>Password</th></tr>";
  // output data of each row
  while($row = $result->fetch_assoc()) {
    echo "<tr><td>".$row["id"]."</td><td>".$row["username"]." ".$row["password"]."</td></tr>";
  }
  echo "</table>";
} else {
  echo "0 results";
}*/

$conn = null;

?>