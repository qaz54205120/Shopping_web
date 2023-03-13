<html>
<head>
	<link rel="stylesheet" type="text/css" href="css/register.css">
</head>
<body>
	<div class="center">
		<h1>Register</h1>
		<form>
			<div class="txt_field">
				<input type="text" id="name" required>
				<span></span>
				<label for='name'>姓名</label>
			</div>
			<div class="txt_field">
				<input type="text" id="username" required>
				<span></span>
				<label for='username'>帳號</label>
			</div>
			<div class="txt_field">
				<input type="password" id="password" required>
				<span></span>
				<label>密碼</label>
			</div>
			<div class="txt_field">
				<input type="text" id="email" required>
				<span></span>
				<label for='email'>信箱</label>
				
			</div>
			<div class="txt_field">
				<input type="text" id="telephone" required>
				<span></span>
				<label for='telephone'>電話</label>
			</div>
			<div class="txt_field">
				<input type="text" id="Bdate" required>
				<span></span>
				<label for='Bdate'>生日</label>
			</div>
			<div>
				<input type="hidden" id="rank" value="1">
			</div>
			<div>
				<input type="submit" id="regi" value="Register"></input>
			</div>
		</form>
	</div>
</body>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
	$(document).ready(function() {
	$("#regi").click(function() {
		if($('#name').val() =='' || $('#username').val()==''|| $('#password').val() =='' || $('#email').val()=='' || $('#telephone').val()=='' || $('#Bdate').val()==''){
			alert("有欄位未輸入，請輸入在註冊");
		}else{
			$.ajax({
				type: "POST",
				url: 'add_client.php',
				data:{
					name: $("#name").val(),
					un: $("#username").val(),
					pw: $("#password").val(),
					email: $("#email").val(),
					telephone: $("#telephone").val(),
					Bdate: $("#Bdate").val(),
					rank: $("#rank").val()
				},
				dataType: 'html'
			}).done(function(data){
				console.log(data+'send successful');
				
				if(data=="success"){
					alert("Successful");
					window.location.href = "login.php";
				}else{
					alert("Failure");
				}
			}).fail(function(jqXHR,textStatus, errorTrown){
				alert("fail");
				console.log(jqXHR.responseText);
			});
			return false;
		}
		});
	});
</script>



<?php
// include_once 'db_conn.php';


// date_default_timezone_set("Asia/Taipei");

// $conn = new database;
// $conn->Connect();
// $connect = $conn->getConnect();

// print_r($conn);
// print_r($connect);





//register_account();

/*$sql = $GLOBALS['connect']->prepare("INSERT INTO shopping_web.member(`name`,`account`,`password`,`rank`,`email`,`telephone`,`Bdate`) VALUES ('黃建傑','jims4t98','123','1','123@gmail.com','0912345678','19980109')");
$sql->execute();

$row = $sql->rowCount();

if($row==1){
	print_r('save');
}else{
	print_r('no_save');
}*/

//$conn->Close();


?>