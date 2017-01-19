<?php
include('../classes/class.php');
$headerr=new Headerr();
$db=new Database();


$headerr->headerrs("Скрытые","","","utf-8");
$headerr->user_bar();


$user_id=$_COOKIE['id'];
$to_id=$_GET['to'];



$black_ads= $db->db_select("black_ads","WHERE user='$user_id'");
$black_ads_count=count($black_ads);

echo "

<div class='content Scontainer'>
 <div class='user_block'>
  <h3>Скрытые</h3>
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


for($i=0;$i<$black_ads_count;$i++){

$black_ads_id= $black_ads[$i]['ads'];
	
$ads= $db->db_select("ads","WHERE id='$black_ads_id'");	
	
echo "
<tr>

<td><a href='../ob.php?id=".$black_ads_id."'>[№-".$black_ads_id."] ".$ads[0]['text']."</a></td>
<td><a href='hide_ob.php?del=".$black_ads[$i]['id']."'>Удалить из списка</a></td>


</tr>";
	
}


echo "</table>";



if($_GET['del']<>""){
	
	$del=$_GET['del'];
	
	
	$db->db_delete("black_ads","WHERE id='$del'");
	$headerr->redirect_to("hide_ob.php","0");
}

echo "</div></div>";

$headerr->footerr();
?>
