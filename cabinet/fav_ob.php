<?php
include('../classes/class.php');
$headerr=new Headerr();
$db=new Database();


$headerr->headerrs("Избранные","","","utf-8");
$headerr->user_bar();


$user_id=$_COOKIE['id'];
$to_id=$_GET['to'];



$white_list= $db->db_select("white_ads","WHERE user='$user_id'");
$white_list_count=count($white_list);

echo "

<div class='content Scontainer'>
 <div class='user_block'>
  <h3>Избранные</h3>
<hr>
<a class='nav_st1' href='ads_my.php'><i class='fa fa-address-card-o' aria-hidden='true'></i> Мои объявления</a>

<a class='nav_st1' href='ads_my_arh.php'><i class='fa fa-lock' aria-hidden='true'></i> Приостановленные мной</a>

<a class='nav_st1' href='fav_ob.php'><i class='fa fa-star-o' aria-hidden='true'></i> Избранные</a>

<a class='nav_st1' href='hide_ob.php'><i class='fa fa-eye-slash' aria-hidden='true'></i> Скрытые</a>


<br /><hr>
<table class='table table-bordered'>
<tr>

<th>Номер объявления</th>
<th></th>

</tr>

";


for($i=0;$i<$white_list_count;$i++){

$white_list_id= $white_list[$i]['ads'];
	
$ads= $db->db_select("ads","WHERE id='$white_list_id'");	
	
echo "
<tr>

<td><a href='../ob.php?id=".$white_list_id."'>[№-".$white_list_id."] ".$ads[0]['text']."</a></td>
<td><a href='fav_ob.php?del=".$white_list[$i]['id']."'>Удалить из списка</a></td>


</tr>";
	
}


echo "</table>";



if($_GET['del']<>""){
	
	$del=$_GET['del'];
	
	
	$db->db_delete("white_ads","WHERE id='$del'");
	$headerr->redirect_to("fav_ob.php","0");
}

echo "</div></div>";

$headerr->footerr();
?>
