<?php
include('../classes/class.php');

$headerr=new Headerr();
$db=new Database();

$headerr->headerrs("Добавление объявления","","","utf-8");
include('noauth.php');

$headerr->user_bar();

$user_id=$_COOKIE['id'];

	
$files= $db->db_post_files("files");

$region_arr= $db->db_select("user","WHERE id='$user_id'");
$region=$region_arr[0]['region'];
$city=$region_arr[0]['city'];


$arr['author']=$author= $user_id;
$arr['type']=$type=$_POST['ads_type'];
$arr['date']=$date=strtotime(date("Y-m-d H:i:s"));
$arr['cat1']=$cat1=$_POST['cat1'];
$arr['cat2']=$cat2=$_POST['cat2'];
$arr['cat3']=$cat3=$_POST['cat3'];
$arr['text']=$text=$_POST['text'];
$arr['files']=$files;

$arr['region']=$region;
$arr['city']=$city;

$arr['status']=0;

$db->db_insert("ads",$arr);











echo "<div class='content Scontainer'>



<div class='uc_bor'>
<p class='success_text'>
Объявление добавлено!
</p>


";



$headerr->redirect_to("ads_my.php",0);

echo "</div></div>";

$headerr->footerr();


?>