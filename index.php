<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Lưu trữ link</title>
	<link rel="stylesheet" href="main.css">
	<?php require "data.php"; ?>
</head>
<body>
	<div id="header">
		<form action="" method="post" id="in_data">
			<div id="nhaplink" class="giao_dien">
				Nhập link: 
				<input type="text" class="nhap_data" name="data" id="" placeholder="https://" >
			</div>
			<div id="ghichu" class="giao_dien">
				Ghi chú: 
				<input type="text" name="note" id="" class="nhap_data">

				<input type="submit" name="oke" value="Nhập" class="in"> <br>

				<?php 
				if(isset($_POST['oke'])){
					$link = isset($_POST['data']) ? $_POST['data'] : "";
					$note = isset($_POST['note']) ? $_POST['note'] : "";
					xulydata($link, $note); 
				} ?>


			</div>
			
			<div id="xoalink" class="giao_dien">
				Xoá link: 
				<input type="number" name="id_delete" class="nhap_data" id="" placeholder="Nhập ID link cần xoá!"> 
				<input type="password" name="pass" placeholder="Nhập mật khẩu!" class= "login_tk" id="">
				<input type="submit" name="delete" value="Xoá" class="in"> <br>
				<?php 
					if(isset($_POST['delete'])){
						$id = isset($_POST['id_delete']) ? $_POST['id_delete'] : "";
						$mk = isset($_POST['pass']) ? $_POST['pass'] : ""; 
						delete_data($id, $mk);
					}
				?>
			</div>
		</form>
	</div>


	<div id="data">
		<table>
			<thead>
				<th class="id">ID</th>
				<th class="link">Link</th>
				<th class="note">Ghi chú</th>
			</thead>

			<tbody>
				<?php load_data(); ?>
			</tbody>
			

		</table>

	</div>
</body>
</html>