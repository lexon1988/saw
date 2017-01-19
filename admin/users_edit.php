<?php
include('../classes/class.php');

$headerr=new Headerr();
$db=new Database();

$headerr->headerrs("Юзвери","","","utf-8");
$headerr->admin_bar();

$id=$_GET['id'];

$user=$db->db_select("user","WHERE id='$id'");


echo "
<div class='content container'>
<div align='center'>
<br /><br />
<div style='width: 400px; padding: 15px; border: 1px solid lightgrey;'>
<br />

<form action='users_edit.php' method='post'>

<b>Имя</b><br>
<input type='text' name='name' size='30' value='".$user[0]['name']."'>

<br><br><b>E-mail</b><br>
<input type='text' name='email' size='30' value='".$user[0]['email']."'>

<br><br><b>Телефон</b><br>
<input type='text' name='phone' size='30' value='".$user[0]['phone']."'>

<input type='hidden' name='id' size='30' value='".$id."'>

<br /><br />

<input type='submit' value='Отправить'>
</form> 

</div>
<br /><br />
</div>
</div>



";




if($_POST['name'] AND $_POST['email'] AND $_POST['phone']){
	
	$name=$_POST['name'];
	$email=$_POST['email'];
	$phone= $_POST['phone'];
	$id=$_POST['id'];
	
	$db->db_update("user", "set name='$name', email='$email', phone='$phone' WHERE id='$id'");
	
	$go_back="users_edit.php?id=".$id;
	$headerr->redirect_to($go_back,'0');
	
}









?>