<?php
	$conn = new mysqli('localhost', 'root', '', 'web_animal');
	if(ISSET($_POST['res'])){
		$query = $conn->query("SELECT * FROM `hinhanh` where dongvat_id =".$_POST['res'].";");
		while($fetch = $query->fetch_array()){
			echo
				"
				<div class='form-group row'>
				<div class='col-12 col-lg-6'>
				<img src='../../../" . $fetch['duongdan'] . "' alt='hinhdongvat' class='imgSize' style='width: 50px; height: 50px; border-radius: 50px; margin-top: 20px; object-fit: cover;'>
				</div>
				<div class='col-12 col-lg-6'>
				<button type='button' id=".$fetch['id']." class='btn btn-xoa' style='margin-top:22px;'><i class='fas fa-trash-alt' style='font-size: 30px; color:red;'></i></button>
				</div>
				</div>
				";
			
		}
	}
	
?> 