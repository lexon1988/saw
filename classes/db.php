<?php
include('acess_DB.php');

class Database{


	//Данные для подключения к базе
var $host="localhost";        var $db_name="tratatak_sw";        var $user_name="root";        var $user_pass="";	
	
	
	
	
	//Подключение к базе-----------------------------------------------------------------------------------
	public function db_connect(){
		
		$this->conn = mysqli_connect(HOST, USER_NAME, USER_PASS, DB_NAME);
		if (!$this->conn) {
			die("Connection failed: " . mysqli_connect_error());
		}
		else{
			//echo "Ok";
		}
	
	
		
	}
	//-----------------------------------------------------------------------------------------------------



	
	
	//Записываем в таблицу-------------------------------------------------------------------------------------
	public function db_insert($table_name, $arr){
		
		$conn=$this->db_connect();
		$conn= $this->conn;
		$arr_key=  array_keys($arr);

	foreach($arr_key as $key){
		
		$arr_keys=$arr_keys.$key.",";
		$arr_values=$arr_values."'".mysql_escape_string($arr[$key])."',";
	}

		$arr_keys=substr($arr_keys,0,-1);
		$arr_values=substr($arr_values,0,-1);
		
		$sql = "INSERT INTO ".$table_name." (".$arr_keys.") VALUES(".$arr_values.")";
		if (mysqli_query($conn, $sql)) {
			//echo "New record created successfully";
		} else {
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
		mysqli_close($conn);

	}
	//-----------------------------------------------------------------------------------------------------
	


	
	//РЕДАКТИРУЕМ таблица-------------------------------------------------------------------------------------
	public function db_update($table_name,$sql_param){
		
		$conn=$this->db_connect();
		$conn= $this->conn;
		
		
		$sql = "UPDATE ".$table_name." ".$sql_param;
		if (mysqli_query($conn, $sql)) {
			//echo "New record created successfully";
		} else {
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
		mysqli_close($conn);
	
	}
	//-----------------------------------------------------------------------------------------------------
	

	
	//УДАЛЯЕМ из таблицы-------------------------------------------------------------------------------------
	public function db_delete($table_name,$sql_param){
		
		
		$conn=$this->db_connect();
		$conn= $this->conn;
		
		
		$sql = "DELETE FROM ".$table_name." ".$sql_param;
		if (mysqli_query($conn, $sql)) {
		
		} else {
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
		mysqli_close($conn);
	
	}
	//-----------------------------------------------------------------------------------------------------	


	
	//Выводим из таблицы-------------------------------------------------------------------------------------
	public function db_select($table_name,$sql_param){
		
		$conn=$this->db_connect();
		$conn= $this->conn;
		
		
		$sql = "SELECT * FROM ".$table_name." ".$sql_param;
		$result = mysqli_query($conn, $sql);
		
		if (mysqli_num_rows($result) > 0) {
			// output data of each row
			while($row = mysqli_fetch_assoc($result)) {
				
				$rows[]=$row;
			
			}

		}
	
		return $rows;
	
	}

	//------------------------------------------
	
	
		public function get_user_by_id($id){
			
		$conn=$this->db_connect();
		$conn= $this->conn;
			
		$sql = "SELECT * FROM user WHERE id='$id'";
		$result = mysqli_query($conn, $sql);
		
		if (mysqli_num_rows($result) > 0) {
			// output data of each row
			while($row = mysqli_fetch_assoc($result)) {
				
				$rows=$row['name'];
			
			}

		}
			
		return $rows;
	
			
		}

		// E-mail

		public function get_email_by_id($id){
      
	    $conn=$this->db_connect();
	    $conn= $this->conn;
      
	    $sql = "SELECT * FROM user WHERE id='$id'";
	    $result = mysqli_query($conn, $sql);
    
	    if (mysqli_num_rows($result) > 0) {
	      // output data of each row
	      while($row = mysqli_fetch_assoc($result)) {
        
	        $rows=$row['email'];
      
	      }

	    }
      
    return $rows;
  
      
    }
	
	
		public function get_region_by_id($id){
			
		$conn=$this->db_connect();
		$conn= $this->conn;
			
		$sql = "SELECT * FROM regions WHERE id='$id'";
		$result = mysqli_query($conn, $sql);
		
		if (mysqli_num_rows($result) > 0) {
			// output data of each row
			while($row = mysqli_fetch_assoc($result)) {
				
				$rows=$row['cat'];
			
			}

		}
			
		return $rows;
	
			
		}
	
	
	
	
		
	public function get_cat_by_id($id){
		
		
		$conn=$this->db_connect();
		$conn= $this->conn;
			
		$sql = "SELECT * FROM cats WHERE id='$id'";
		$result = mysqli_query($conn, $sql);
		
		if (mysqli_num_rows($result) > 0) {
			// output data of each row
			while($row = mysqli_fetch_assoc($result)) {
				
				$rows=$row['cat'];
			
			}

		}
			
		return $rows;
		
		
	}
	
	
	
	
	
	
	public function db_post_files($files){
	
	$user_id=$_COOKIE['id'];
	$rand=rand(0,9999999999);
	

	if(!is_dir("../uploads/".$user_id)) mkdir("../uploads/".$user_id);
	

	$file_count=count($_FILES[$files]['name']);

	if($_FILES[$files]['name'][0]<>""){
	
	for($i=0;$i<$file_count;$i++){
		
		
			//Проверяем тип файла
			$mystring = $_FILES['files']['type'][$i];
			$findme   = 'image';
			$pos = strpos($mystring, $findme);

			// Заметьте, что используется ===.  Использование == не даст верного 
			// результата, так как 'a' находится в нулевой позиции.
			if ($pos === false) {
			   $load='no';
			} else {
			   $load='ok';
			}
		
					if($load=='ok'){
					
									
								$uploaddir = "../uploads/".$user_id."/".$rand."/";
								
								if(!is_dir($uploaddir)) mkdir($uploaddir);

								$uploadfile = $uploaddir.basename($_FILES[$files]['name'][$i]);
								copy($_FILES[$files]['tmp_name'][$i], $uploadfile);

								}
					
							}
	
	
	return $rand;
	}
	
	
	
	}
	
	
	
	
	
	public function db_post_files_mob($files){
	
	$user_id=$_COOKIE['id'];
	$rand=rand(0,9999999999);
	

	if(!is_dir("../../uploads/".$user_id."/".$rand."/")) mkdir("../../uploads/".$user_id."/".$rand."/");
	

	$file_count=count($_FILES[$files]['name']);

	if($_FILES[$files]['name'][0]<>""){
	
	for($i=0;$i<$file_count;$i++){
		
		
			//Проверяем тип файла
			$mystring = $_FILES['files']['type'][$i];
			$findme   = 'image';
			$pos = strpos($mystring, $findme);

			// Заметьте, что используется ===.  Использование == не даст верного 
			// результата, так как 'a' находится в нулевой позиции.
			if ($pos === false) {
			   $load='no';
			} else {
			   $load='ok';
			}
		
					if($load=='ok'){
					
									
								$uploaddir = "../../uploads/".$user_id."/".$rand."/";
								
								if(!is_dir($uploaddir)) mkdir($uploaddir);

								$uploadfile = $uploaddir.basename($_FILES[$files]['name'][$i]);
								copy($_FILES[$files]['tmp_name'][$i], $uploadfile);

								}
					
							}
	
	
	return $rand;
	}
	
	
	
	}
	
	
	
	
	
	
	
	
	
	
		
	public function db_post_files2($files,$ads_dir){
	
	$user_id=$_COOKIE['id'];


	$file_count=count($_FILES[$files]['name']);

	if($_FILES[$files]['name'][0]<>""){
	

	for($i=0;$i<$file_count;$i++){
		
				//Проверяем тип файла
			$mystring = $_FILES['files']['type'][$i];
			$findme   = 'image';
			$pos = strpos($mystring, $findme);

			// Заметьте, что используется ===.  Использование == не даст верного 
			// результата, так как 'a' находится в нулевой позиции.
			if ($pos === false) {
			   $load='no';
			} else {
			   $load='ok';
			}
		
					if($load=='ok'){	
		
							$uploaddir = "../uploads/".$user_id."/".$ads_dir."/";
							if(!is_dir($uploaddir)) mkdir($uploaddir);

							$uploadfile = $uploaddir.basename($_FILES[$files]['name'][$i]);
							copy($_FILES[$files]['tmp_name'][$i], $uploadfile);
							}
					
					}

			}
	
	}
	
	
	
	
	public function db_post_files_chat($files){
	
	$user_id=$_COOKIE['id'];


	$file_count=count($_FILES[$files]['name']);

		if($_FILES[$files]['name'][0]<>""){
		
		
	
						
						for($i=0;$i<$file_count;$i++){
						
							//Проверяем тип файла
							$mystring = $_FILES['files']['type'][$i];
							$findme   = 'image';
							$pos = strpos($mystring, $findme);

							// Заметьте, что используется ===.  Использование == не даст верного 
							// результата, так как 'a' находится в нулевой позиции.
							if ($pos === false) {
							   $load='no';
							} else {
							   $load='ok';
							}
						
									if($load=='ok'){
						
						
						
									
									$uploaddir = "../uploads/".$user_id."/chat/";
									if(!is_dir($uploaddir)) mkdir($uploaddir);

									$uploadfile = $uploaddir.basename($_FILES[$files]['name'][$i]);
									copy($_FILES[$files]['tmp_name'][$i], $uploadfile);

						
									}
						
							}

					
		
		
				}

			}
	
	
	
	
	
	
	
	public function db_post_files_chat_mob($files){

	$user_id=$_COOKIE['id'];
	$file_count=count($_FILES[$files]['name']);

		if($_FILES[$files]['name'][0]<>""){
		
						for($i=0;$i<$file_count;$i++){
						
							//Проверяем тип файла
							$mystring = $_FILES['files']['type'][$i];
							$findme   = 'image';
							$pos = strpos($mystring, $findme);

							// Заметьте, что используется ===.  Использование == не даст верного 
							// результата, так как 'a' находится в нулевой позиции.
							if ($pos === false) {
							   $load='no';
							} else {
							   $load='ok';
							}
						
									if($load=='ok'){
						
						
						
									
									$uploaddir = "../../uploads/".$user_id."/chat/";
									if(!is_dir($uploaddir)) mkdir($uploaddir);

									$uploadfile = $uploaddir.basename($_FILES[$files]['name'][$i]);
									copy($_FILES[$files]['tmp_name'][$i], $uploadfile);

						
									}
						
							}
		
		
				}

			}
	
	
	
	
	
	
	
	
	
	
	public function db_post_files_chat_admin($files){
	
	$user_id="000";


	$file_count=count($_FILES[$files]['name']);

		if($_FILES[$files]['name'][0]<>""){
		
		
	
						
						for($i=0;$i<$file_count;$i++){
						
							//Проверяем тип файла
							$mystring = $_FILES['files']['type'][$i];
							$findme   = 'image';
							$pos = strpos($mystring, $findme);

							// Заметьте, что используется ===.  Использование == не даст верного 
							// результата, так как 'a' находится в нулевой позиции.
							if ($pos === false) {
							   $load='no';
							} else {
							   $load='ok';
							}
						
									if($load=='ok'){
						
						
						
									
									$uploaddir = "../uploads/".$user_id."/chat/";
									if(!is_dir($uploaddir)) mkdir($uploaddir);

									$uploadfile = $uploaddir.basename($_FILES[$files]['name'][$i]);
									copy($_FILES[$files]['tmp_name'][$i], $uploadfile);

						
									}
						
							}

					
		
		
				}

			}
	
	
	
	
	
	
	
	
	
	public function  removeDirectory($dir) {
    if ($objs = glob($dir."/*")) {
       foreach($objs as $obj) {
         is_dir($obj) ?  removeDirectory($obj) : unlink($obj);
       }
    }
    rmdir($dir);
  }

	
	
		
	
	
	public function get_files($dirr,$ads_id) {
		
			if(file_exists($dirr)){
			
			$user_id=$_COOKIE['id'];
			
			
			
			$dir= scandir($dirr);
			$dir_count=count($dir);
			
	
			
			for($i=2;$i<$dir_count;$i++){
				
/*
				echo "
				<a href='".$dirr."".$dir[$i]."' target='_blank'>".$dir[$i]."</a>
				";
				
				if($ads_id<>""){
					echo "<a href='ads_edit.php?del=".$dir[$i]."&id=".$ads_id."'> --  Удалить -- </a>";
				}
*/
				echo "
				<a href='".$dirr."".$dir[$i]."' target='_blank'><img src='".$dirr."".$dir[$i]."' height='40em'></a>
				";
				 
				if($ads_id<>""){
                                        echo "<a href='ads_edit.php?del=".$dir[$i]."&id=".$ads_id."'> --  Удалить -- </a>";
                                }


				
				echo "
				
				";
				
			}
			
		
		
		}else{
			
			echo "Нет файлов";
			
		}

		
	}
	
	
	
	public function get_files_public($dirr,$ads_id) {
		
			if(file_exists($dirr)){
			

			
			$dir= scandir($dirr);
			$dir_count=count($dir);
			
			$rand=rand(2, 999999999);
			

			for($i=2;$i<$dir_count;$i++){
				
				echo "
				<a href='".$dirr."".$dir[$i]."' id='img".$i.$rand."'><img src='".$dirr."".$dir[$i]."' height=40em></a>
				
				
			<script type='text/javascript'>
			
			$('#img".$i.$rand."').css('z-index','8050');
			
			
			$(document).ready(function() {
		
				$('#img".$i.$rand."').fancybox({
					openEffect  : 'elastic',
					closeEffect : 'elastic',
					nextEffect  : 'elastic',
					prevEffect  : 'elastic'
				
				
				
				});
			});
		</script>
				
				
				
				
				";
				

				
			}

		}else{
			
			echo "Нет файлов";
			
		}

		
	}
	
	
	
		public function get_files_public_mob($dirr,$ads_id) {
		
			if(file_exists($dirr)){
			

			$dir= scandir($dirr);
			$dir_count=count($dir);
			
	
			for($i=2;$i<$dir_count;$i++){
				
				echo "
				<a href='#'>
					
				  <img  src='".$dirr."".$dir[$i]."' height='40em' >
			
				</a>
				";
			
			
			
			
				
			}

		}else{
			
			echo "Нет файлов";
			
		}

		
	}
	
	
	
	
	
	

	public function get_files_chat($dirr) {
		
		$user_id=$_COOKIE['id'];
		
		if(file_exists($dirr)){

		}else{
			
			mkdir("../uploads/".$user_id);
			mkdir("../uploads/".$user_id."/chat/");
			
		}
		

			if(file_exists($dirr)){
			$dir= scandir($dirr);
			$dir_count=count($dir);
			

			for($i=2;$i<$dir_count;$i++){
				
				echo $i;
				
				/*
				echo "
				<a href='".$dirr."".$dir[$i]."'>".$dir[$i]."</a>
				";
				
				echo "<a href='massages.php?post_file=".$dir[$i]."&to=".$_GET['to']."&ads=".$_GET['ads']."'> --  Отправить -- </a>";
				echo " | ";
				echo "<a href='massages.php?del_file=".$dir[$i]."&to=".$_GET['to']."&ads=".$_GET['ads']."'> --  Удалить -- </a>";
				echo "
				 <br>
				";
				
				*/
			}
			
		
			
			}else{
				
				echo "Нет файлов";
				
			}

			
		}




	
	
}
?>
