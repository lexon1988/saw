<?php
include('../classes/class.php');
$headerr=new Headerr();
$db=new Database();


$headerr->headerrs("Сообщения","","","utf-8");
$headerr->user_bar();
include('noauth.php');



$from_id=$_COOKIE['id'];
$to_id=$_GET['to'];

$user_name=$db->get_user_by_id($to_id);

echo "<div class='content Scontainer'>



<div class='uc_bor'>



";

echo "<p class='info_st1'>Написать жалобу на пользователя <b>".$user_name."</b></p>";
echo "<hr>
<div align='center'>
<form action='complaint.php' method='post'>

<textarea cols=80 rows=10 name='complaint'></textarea>
<input type='hidden' name='user_name' value='".$user_name."'>
<input type='hidden' name='to_id' value='".$to_id."'>
<br>


<input class='submit_st1' type='submit' value='Отправить'>

</form>
</div>
";


if($_POST['complaint']<>""){
	
	$from_id=$_COOKIE['id'];
	$user_name=$_POST['user_name'];
	$to_id=$_POST['to_id'];
	
	$arr['date']=strtotime(date("Y-m-d H:i:s"));
	$arr['to_post']='000';
	$arr['from_post']=$from_id;
	$arr['massage']="<br><small><b>Жалоба на пользователя ".$user_name."(".$to_id.")::</b></small> <br>".$_POST['complaint'];
	
	
	$db->db_insert("massages",$arr);
	//$db->db_update("massages","SET status='1' WHERE from_post='000' AND to_post='".$from_id."'");
	
	
	$go_back="massages.php?to=000&ads=000";
	$headerr->redirect_to($go_back,'0');
	
}

echo "</div></div>";

$headerr->footerr();
?>