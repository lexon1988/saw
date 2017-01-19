<?php
include('../classes/class.php');

$headerr=new Headerr();
$db=new Database();
$tools=new Tools();


$headerr->headerrs("Редактировать объявление","","","utf-8");
include('noauth.php');

$headerr->user_bar();

$email= trim($headerr->user);
$arr_db= $db->db_select("user","WHERE email='$email'");

$region=$db->get_region_by_id($arr_db[0]['region']);
$city=$db->get_region_by_id($arr_db[0]['city']);



echo "
<div  class='content Scontainer'>
<div class='user_block'>
  <h3>Редактирование объявления</h3>
<hr>
<p class='info_st1'>Вы указали регион: ".$region." / ".$city."</p> <p class='warning_st1'>(изменить регион можно в профиле)</p>
<hr>
  <div  class='sorting_block' style='width: 50%;'>";
  
  
  

include("../tools/search_sidebar/edit/index.php");

echo "</div></div></div>";

$headerr->footerr();


?>
