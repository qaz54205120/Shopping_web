<?php

if(!isset($_SESSION['user_is_login']) || !$_SESSION['user_is_login']){
	header("Location: login.php");
}