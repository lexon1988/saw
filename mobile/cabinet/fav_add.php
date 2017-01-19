<?php
include('../../classes/class.php');
$db=new Database();



$id=$_POST['id'];
$user_id=$_COOKIE['id'];


if($user_id==""){
	
	echo "Данная функция доступна только для авторизованных потльзователей!";
	exit();
}



$ads=$db->db_select("white_ads","where user='$user_id' and ads='$id'");



if($ads[0]['id']<>""){
	
	echo "Данное объявление уже обовлено в избранное!";
	
}else{



	$arr['user']=$user_id;
	$arr['ads']=$id;


	$db->db_insert("white_ads",$arr);

	echo "Добавленно в избранно!";

}




?>