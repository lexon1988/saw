<?php
include('../classes/class.php');
$headerr=new Headerr();
$db=new Database();


$headerr->headerrs("Сообщения","","","utf-8");
$headerr->admin_bar();


$from_id=$_COOKIE['id'];
$to_id=$_GET['to'];

if($_GET['to']){

	$arr['good_user']=$from_id;
	$arr['bad_user']=$to_id;


	$db->db_insert("black_list",$arr);
	$headerr->redirect_to("black_list.php","0");

}

$black_list= $db->db_select("black_list","WHERE good_user='$from_id'");
$black_list_count=count($black_list);

echo "

<div class='content container'>
<br /><br />

<table class='table table-bordered'>
<tr>

<th>Имя</th>
<th></th>

</tr>

";


for($i=0;$i<$black_list_count;$i++){
	
echo "
<tr>

<td>".$db->get_user_by_id($black_list[$i]['bad_user'])."</td>
<td><a href='black_list.php?del=".$black_list[$i]['bad_user']."'>Удалить из списка</a></td>


</tr>";
	
}


echo "</table>";



if($_GET['del']<>""){
	
	$del=$_GET['del'];
	
	
	$db->db_delete("black_list","WHERE good_user='$from_id' AND bad_user='$del'");
	$headerr->redirect_to("black_list.php","0");
}

echo "</div>";

?>