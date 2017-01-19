<?php
include('classes/class.php');

$headerr=new Headerr();
$db=new Database();



//АВТОРИЗАЦИЯ АДМИНА
$admin_login='admin';
$admin_pass='kEns8oLKa-2_WZuAxB2';

if($_POST['email']==$admin_login AND $_POST['pass']==$admin_pass){

setcookie("admin","welcome");
$headerr->redirect_to("admin/index.php",1000);	

}

//-------------------




if($_POST['email']<>"" AND $_POST['pass']<>""){
		
		$email=trim($_POST['email']);
		$pass=trim($_POST['pass']);
		
		
		$arr=$db->db_select("user"," WHERE email='$email'");
		
		$name=$arr[0]['name'];
		$id=$arr[0]['id'];
		if($arr[0]['pass']==$pass){
			
			//echo "Пароль тот!";
			setcookie("auth","welcome");
			setcookie("email",$email);
			setcookie("user",$name);
			setcookie("id",$id);
			$err=0;
			
		}else{
			
			$err=1;
			
		}
		
		
	}





	
	if($err==0){
			
			$headerr->redirect_to("mobile/cabinet/index.php",0);
		
	}else{
		
		$headerr->error("ERROR!","PASSWORD");
		$headerr->redirect_to("/mobile/",0);
		
	}

	

	
	
$headerr->footerr();


?>
