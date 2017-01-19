<?php

include('../classes/class.php');

$headerr=new Headerr();

$db=new Database();





$id=$_POST['id'];

$user_id=$_COOKIE['id'];





if($user_id==""){

	

	echo "Данная функция доступна только для авторизованных пользователей!";

	exit();

}







$ads=$db->db_select("black_ads","where user='$user_id' and ads='$id'");







if($ads[0]['id']<>""){

	

	echo "Данное объявление уже помещено в скрытые!";

	

}else{







	$arr['user']=$user_id;

	$arr['ads']=$id;





	$db->db_insert("black_ads",$arr);



	echo "Объявление помещено в скрытые!";



}



?>
