<?php
function connect_mysql(){
	try {
			# Kết nối mysql
			$host = "localhost";
			$dbname = "hndiogdj_link-v1";
			$user = "hndiogdj_link-v1";
			$pass = "uJUpOwZp";
			$conn = new PDO("mysql:host=$host;dbname=$dbname",$user,$pass);
	    	$conn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	    	return $conn;
		} catch (Exception $e) {
			echo "Lỗi kết nối đến database!!"."<br>";
		}
}



function xulydata($link, $note) {
	$i=0;
	if(empty($link)){
		echo "Bạn chưa nhập link!!";
	} else {
		$i=1;
	}
	if($i == 1){
		$conn = connect_mysql();
		if(isset($conn)){
			$sql = "INSERT INTO save_link(link, text) VALUES ('$link', '$note')";
			$conn -> exec($sql);
			echo "Nhập dữ liệu thành công!!<br>";
		}
	}
}  



function delete_data($id, $mk){
	$i=0;
	if(empty($id)){
		echo "Bạn chưa nhập ID!!<br>";
	} else {
		$i=1;
	}
	if(empty($mk)){
		echo "Bạn chưa nhập mật khẩu!!";
	} else {
		$kq = pass($mk);
	}
	if($i == 1 && $kq == 1){
		$conn = connect_mysql();
		if(isset($conn)){
			$sql = "DELETE FROM save_link WHERE id='$id' ";
			$value = $conn -> exec($sql);
			if($value == 0){
				echo "ID không tồn tại!! <br>";
			} else echo "Xoá dữ liệu thành công!!<br>";
		}
	}
}

function load_data(){
	$conn = connect_mysql();
	if(isset($conn)){
		$sql = "SELECT `id`, `link`, `text` FROM `save_link` WHERE 1";
		$data = $conn -> query($sql);
		if(isset($data)){
			foreach ($data as $key => $value) {
				$id = $value['id'];
				$link = $value['link'];
				$text = $value['text'];
				$link_base = "";
				$length_link = strlen($link);
				$j = $length_link > 40 ? 40 : $length_link; 
				for($i=0; $i<$j; $i++){
					$link_base[$i] = $link[$i]; 
				}
				echo "<tr>  
					<td class = 'id'>$id</td>
					<td class = 'link'> 
						<a href='$link' target = '_blank' >$link_base</a>
					</td>
					<td class = 'note'>
						<p>$text</p>
					</td>
				</tr>";
			}
		}

	}
}

function pass($mk){
	$pass = md5('admin');
	$mk = md5($mk);
	if($mk == $pass){
		return 1;
	} else echo "Mật khẩu sai!!<br>";
}

?>