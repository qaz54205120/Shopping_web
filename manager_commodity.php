<?php
include_once "php/db_conn.php";
include_once "php/functions.php";

$commodity = all_commodity();
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

</head>
<body>
	<div>
		<button onclick="location.href='create_product.php'" class="button">Create a commodity</button>
	</div>


	<table border="1" class="main">
		<thead>
			<tr>
				<th width="50px">id</th>
				<th>商品</th>
				<th width="70px">價格</th>
				<th width="50px">數量</th>
				<th>創建時間</th>
				<th>照片名稱</th>
				<th>照片</th>
				<th width="150px">管理動作</th>
			</tr>
		</thead>
		<tbody id="table">
			<?php
				if($commodity > 0){
					foreach ($commodity as $data) {
					?>
					<tr>
						<td align="center"><?php echo $data['id'];?></td>
						<td align="left"><?php echo $data['name'];?></td>
						<td align="right"><?php echo $data['price'];?></td>
						<td align="center"><?php echo $data['quantity']?></td>
						<td align="center"><?php echo $data['date_added']?></td>
						<td align="center"><?php echo $data['img'];?></td>
						<td ><img src= "imgs/<?php echo $data['img'];?>" width="100" height="100" /></td>
					<td align="center">
						<!-- <a href="commodity_edit.php" role="button" class="btn-success">Modify</a> -->
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
</body>
</html>

<script>
	$(document).ready(function(){
		$(".delete").on("click", function(e){
			e.preventDefault();

			var c = confirm("確定要刪除嗎?"), row = $(this).parent().parent();

			if(c){
				$.ajax({
					type: "POST",
					url: "php/del_commodity.php",
					data: {
						id: row.children().eq(0).text()
					},
					dataType: 'html'
				}).done(function(data){

					if(data=="success"){
						alert("Delete successful");
						window.location.href = "manager_commodity.php";
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
