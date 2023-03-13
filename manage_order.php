<?php
include_once "php/functions.php";
include_once "php/db_conn.php";

$orders = all_orders();

@session_start();

// $conn = new database();
// $conn->Connect();

?>
<html>
<head>
	<?php include_once "php/header_menu.php"; ?>
	<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
	<link rel="stylesheet" type="text/css" href="css/button.css">
	<link rel="stylesheet" type="text/css" href="css/page.css">
	<link rel="stylesheet" type="text/css" href="css/table.css">
</head>
<body>
	<div>
	<table border="1" class="main">
		<thead>
			<tr>
				<th width="100px">訂單編號</th>
				<th width="150px">會員帳號</th>
				<th width="100px">商品id</th>
				<th width="150px">總價</th>
				<th width="150px">數量</th>
				<th width="150px">管理動作</th>
			</tr>
		</thead>
		<tbody id="table">
			<?php
				print_r($orders);

				if($orders > 0){
					//echo count($orders);
					for($i = 1;$i < count($orders);$i++){
						echo $i-1,"</br>";

						//echo $orders[$i-1]['item_id'];
						
						if($orders[$i-1]['item_id'] == $orders[$i]['item_id']){
							echo 'yes';
						}
					}
					foreach ($orders as $order) {
					?>
					<tr>
					<td><?php echo $order['order_id'];?></td>
					<td><?php echo $order['account'];?></td>
					<td><?php echo $order['item_id']?></td>
					<td><?php echo $order['price']?></td>
					<td><?php echo $order['amount']?></td>
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
</body>
<script>
	$(document).ready(function(){
		$(".delete").on("click", function(e){
			e.preventDefault();

			var c = confirm("確定要刪除嗎?"), row = $(this).parent().parent();

			if(c){
				$.ajax({
					type: "POST",
					url: "php/del_order.php",
					data: {
						id: row.children().eq(0).text()
					},
					dataType: 'html'
				}).done(function(data){

					if(data=="success"){
						alert("Delete successful");
						window.location.href = "manage_order.php";
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
</html>