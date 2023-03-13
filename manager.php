<?php
include_once "php/db_conn.php";
include_once "php/functions.php";

$members = all_members();

@session_start();

$conn = new database();
$conn->Connect();

// echo $_SESSION['rank'];
// echo $_SESSION['user_is_login'];
?>

<html>
<head>
	<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
	<link rel="stylesheet" type="text/css" href="css/button.css">
	<link rel="stylesheet" type="text/css" href="css/table.css">
	<link rel="stylesheet" type="text/css" href="css/page.css">
	<header>			
			<?php include_once 'php/header_menu.php'; ?>
	</header>
	<title>管理員頁面</title>
	<!-- <style>
		body{
			background-color: whitesmoke;
		}
		
		#tb1{
			background-color: white;
		}
		.down{
			color: blue;
		}
	</style> -->
</head>
<body>
<div>
	<table border="1" class="main">
		<thead>
			<tr>
				<th width="150px">會員姓名</th>
				<th width="150px">會員帳號</th>
				<th width="300px">會員信箱</th>
				<th width="150px">會員電話</th>
				<th width="150px">權限</th>
				<th width="150px">管理動作</th>
			</tr>
		</thead>
		<tbody id="table">
			<?php
				if($members > 0){
					foreach ($members as $data) {
					?>
					<tr>
					<td><?php echo $data['name'];?></td>
					<td><?php echo $data['account'];?></td>
					<td hidden><?php echo $data['password']?></td>
					<td><?php echo $data['email']?></td>
					<td><?php echo $data['telephone']?></td>
					<td><?php switch($data['rank']){
								case 0:
									echo '<font color="red">超級使用者</font>';
									break;
								case 1:
									echo '<font color="blue">使用者</font>';
									break;
									}
					?></td>
					<td align="center">
						<!-- <a href="member_edit.php" role="button" class="btn-success">Modify</a> -->
						<a href="#" role="button" class="delete btn-fail">Delete</a>
					</td>
					</tr>
				<?php
					}
				}
				?>
		</tbody>
	</table>
</div>

<script>
	$(document).ready(function(){
		$(".delete").on("click", function(e){
			e.preventDefault();

			var c = confirm("確定要刪除嗎?"), row = $(this).parent().parent();

			if(c){
				$.ajax({
					type: "POST",
					url: "php/del_member.php",
					data: {
						un: row.children().eq(1).text()
					},
					dataType: 'html'
				}).done(function(data){

					if(data=="success"){
						alert("Delete successful");
						window.location.href = "manager.php";
					}else{
						alert("Fail to delete");
					}
				}).fail(function(jqXHR, textStatus, errorThrown) {
                    //失敗的時候
                    alert("有錯誤產生，請看 console log");
                    console.log(jqXHR.responseText);
                });
			}
		});
	});
</script>
	

</body>
</html>


