<?php

$time= $_POST['time'];
$region= $_POST['region'];
$city= $_POST['city'];

setcookie("time",$time);

if($region<>"xxx"){
setcookie("region",$region);
}else{
setcookie("region","");
}


if($city<>"xxx"){
setcookie("city",$city);
}else{
setcookie("city","");
}




if($time==1){

	$minus_time = strtotime('-1 days');
	$sql_date= strtotime(date('Y-m-d H:i:s', $minus_time));


}

if($time==2){

	$minus_time = strtotime('-3 days');
	$sql_date= strtotime(date('Y-m-d H:i:s', $minus_time));

}

if($time==3){

	$minus_time = strtotime('-7 days');
	$sql_date= strtotime(date('Y-m-d H:i:s', $minus_time));


}

if($time==4){


	$sql_date= "";


}

if($time==''){$check4='checked';}


setcookie("sql_date",$sql_date);





header("Location: index.php");

?>