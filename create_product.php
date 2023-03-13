<?php
include_once "php/functions.php";

$id = get_commodity_id();
?>
<html>
<head>
	<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
	<link rel="stylesheet" type="text/css"  href="css/input.css" >
	<link rel="stylesheet" type="text/css" href="css/button.css">
	<header>			
			<?php include_once 'php/header_menu.php'; ?>
	</header>

</head>
<body>
	<div>
			<label for="commodity_id">目前產品id</label>
			<input type="text" id="commodity_id" placeholder="Commodity_id" value="<?php echo $id ?>" required disabled>
	<div>
		<label for="item_name">Commodity name:</label>
		<input type="text" id="item_name" placeholder="item_name">
	</div>
	<div>
		<label for="price">Price:</label>
		<input type="text" id="price" placeholder="Enter the price">
	</div>
	<div>
		<label for="amount">Amount:</label>
		<input type="text" id="amount" placeholder="How much the amount">
	</div>
	<div class="form-group">
            <label class="control-label col-sm-2" for="state">檔案上傳:</label>
            <input autocomplete="off" type="file" class="location" accept="image/*" required>
            <input autocomplete="off" type="hidden" id="location" value="">
            <button href="#" class="del_file" style="margin-top: 1em;">刪除檔案</button>
   </div>
	<div>
		<button class="create" type="submit" value="Submit">Create a commodity</button>
	</div>

<!-- <form action="upload.php" method="post" enctype="multipart/form-data">
  Select image to upload:
  <input type="file" name="fileToUpload" id="fileToUpload">
  <input type="submit" value="Upload Image" name="submit">
</form>
 -->

</body>
</html>
<script>
	$(document).ready(function(){		
		var form_data = new FormData();
		$("input:file").on("change",function(){
				var file_data = $(this)[0].files[0];
				var save_path = "imgs/";

				form_data.append("file", file_data);
				form_data.append("save_path", save_path);

				filename = file_data['name'];
				$("#location").val(save_path+file_data['name']);

		});

		$("button.del_file").on("click", function(){
			if ($("#location").val() != ''){
				var c = confirm("確定刪除嗎?");
				if(c){
					$.ajax({
						type: 'POST',
						url: 'php/del_file.php',
						data:{
								file: $("#location").val()
						},
						dataType: 'html'
					}).done(function (data){
						console.log(data);

						if(data == 'Exist'){
							$("#location").val('');
							$("input.location").val('');
						}else{
							alert(data);
						}
					}).fail(function(jqXHR, textStatus, errorThrown) {
							alert('Have some error');
							console.log(jqXHR.responseText);
					});
				}else{
					alert("No file to delete");
				}
			}
		});

		$(".create").on("click",function(){
			var c = confirm("確定新增嗎?");
			
			if($('#itme_name').val() =='' || $('#price').val()=='' || $('#amount').val()== ''){
				alert('有欄位未輸入');
			}else if($("#location").val()==''){
				alert('未選擇檔案');
			}else{
				$.ajax({
					type: 'POST',
					url: 'php/load_file.php',
					data: $("#location").val(),
					dataname: filename,
					cache: false,
					processData: false,
					contentType: false,
					dataType: 'html'
				}).done(function(data){
						if(c){
						$.ajax({
								type: "POST",
								url: "php/create_commodity.php",
								data: {
									id: $("#commodity_id").val(),
									item_name: $("#item_name").val(),
									price:     $("#price").val(),
									amount:    $("#amount").val(),
									dataname: filename
							},
							dataType: "html"
						}).done(function(data){
							console.log(data + "send successful");

							if(data=='success'){
								alert("Create the commodity successful");
								window.location.href = "manager_commodity.php";
							}else{
								alert("failed to create the commodity");
								window.location.href = "manager_commodity.php"
						}

						}).fail(function(jqXHR, textStatus, errorThrown){
							alert("Have some error,please look at consolelog");
							console.log(jqXHR.responseText);
						});
					}
				});
			}
		});
	});
</script>

<?php
include_once "php/db_conn.php";
include_once "php/functions.php";



?>
