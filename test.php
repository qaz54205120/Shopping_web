<html lang="en">
<head>
<meta charset="utf-8">
<title>jQuery</title>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
	$(document).ready(function(){
		$("button").click(function(){
			alert('success');
		});
	});
</script>
</head>
<body>
	<button type="button">test</button>
	<button type="submit">test123</button>
</body>
</html>


<?php 
	class test{

		private $x = 1;


		function cool(){
			$x = 2;
			echo $x."</br>";
			echo $this->x."</br>";
			//echo self::$x;

		}
	}
	$call = new test;
	$call->cool();

	$result = null;
	echo $result;
?>