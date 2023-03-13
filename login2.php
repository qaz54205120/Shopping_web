<html>
<head>
<meta charset="utf-8">
<title>Login in to phone website</title>
<style>
	.button {
		background-color: #4CAF50;
		border: none;
		color: white;
		padding: 15px 32px;
		text-align: center;
		text-decoration: none;
		display: inline-block;
		font-size: 16px;
		margin: 4px 2px;
		cursor: pointer;
		align-self:right;
		float: left;
	}
	.body{font-family:Arial,Helvetica,sans-serif;font-size:20px;}
	</style>
<h2>User Login</h2>
</head>
	<body class = "body">
		<?php
		if(isset($_COOKIE['login_status'])){
			echo "Login already.";
		?>
		<br>
		<br>
		<a href='showPhones.php'>Click here to buy phones.</a>
		<?php
		}else{
		?>
		<form action="process_login.php" method="post">

			<select name="character">
				<option value="">Choose your character</option>
				<option value="admin">admin</option>
				<option value="user">user</option>
			</select><br>

 			User name:<input type="text" name="username"><br>
			User password:<input type="password" name="psw"><br>
			<input type="submit" class = "button" name="submit" value="Choose">
		</form>
		<?php
		}
		?>
	</body>
</html>

