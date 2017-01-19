<?php
include('../classes/class.php');

$headerr=new Headerr();
$db=new Database();

$headerr->headerrs("Юзвери","","","utf-8");
$headerr->admin_bar();

if($_POST['user_id']<>""){
	$user_sql=" and id='".$_POST['user_id']."'";
}

$users=$db->db_select("user","WHERE id<>000".$user_sql." order by id desc");

$users_count=count($users);


echo "

<div class='content container'>
<br />
<div align='left'>
<br />
<b>Поиск по id:</b>
<form action='users.php' method='post'>

<input type='text' size='16' name='user_id'>
<input type='submit' value='Отправить'>

</form>

</div>

<hr>
<table class='table table-bordered'>
<tr>
<th>id</th>
<th>ЛС</th>
<th>Дата</th>
<th>St.</th>

<th>Имя</th>
<th>Почта</th>
<th>Регион</th>
<th>ADS</th>


<th>Ис.</th>
<th>Вх.</th>
<th>СП.</th>

<th>To-BL</th>
<th>IN-BL</th>


<th>Del</th>
<th>Забан</th>
<th>Разбан	</th>

<th>EDIT	</th>

</tr>


";

for($i=0;$i<$users_count;$i++){

$id=$users[$i]['id'];

$from_post_count= count($db->db_select("massages","WHERE from_post='$id'"));
$to_post_count= count($db->db_select("massages","WHERE to_post='$id'"));
$to_sup_count= count($db->db_select("massages","WHERE from_post='$id' and to_post='000'"));


$bl1_count= count($db->db_select("black_list","WHERE good_user='$id'"));
$bl2_count= count($db->db_select("black_list","WHERE bad_user='$id'"));

$ads_count= count($db->db_select("ads","WHERE author='$id'"));

$region= $db->get_region_by_id($users[$i]['region']);
$city= $db->get_region_by_id($users[$i]['city']);

echo "
<tr>
<td>".$users[$i]['id']."</td>
<td><a href='massages.php?to=".$users[$i]['id']."&ads=0'><*></a></td>
<td><small>".date("Y.m.d | H:i:s",$users[$i]['date'])."</small></td>";
echo "<td>";

if($users[$i]['status']==0){echo "<font color=green>Ok</font>";}else{echo "<font color=red>bun</font>";}

echo "</td>

<td>".substr($users[$i]['name'],0,30)."</td>
<td><a href='../cabinet/auth.php?email=".$users[$i]['email']."&pass=".$users[$i]['pass']."'>".$users[$i]['email']."</a></td>

<td><small>".$region."/".$city."</small></td>

<td>".$ads_count."</td>


<td>".$from_post_count."</td>
<td>".$to_post_count."</td>
<td>".$to_sup_count."</td>


<td>".$bl1_count."</td>
<td>".$bl2_count."</td>


<td><a href='users.php?id=".$id."' style='text-decoration: none;'> [x]</a></td>
<td><a href='users.php?bun=".$id."' style='text-decoration: none;'>BUN</a></td>
<td><a href='users.php?unbun=".$id."' style='text-decoration: none;'>unBUN</a></td>

<td><a href='users_edit.php?id=".$id."' style='text-decoration: none;'>EDIT</a></td>

</tr>


";

}

echo "</table>";


if($_GET['id']<>""){

$id=$_GET['id'];

$db->db_delete("user","WHERE id='$id' ");	
$headerr->redirect_to("users.php",1000);
	


}




if($_GET['bun']<>""){

$bun=$_GET['bun'];	
	
	$db->db_update("user","set status=1 WHERE id='$bun'");
$headerr->redirect_to("users.php","100");
	
}



if($_GET['unbun']<>""){

$bun=$_GET['unbun'];	
	
	$db->db_update("user","set status=0 WHERE id='$bun'");
$headerr->redirect_to("users.php","100");
	
}


echo "<br /></div>";



?>