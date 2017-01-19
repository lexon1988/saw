<?php


if($_GET['reset']<>""){

setcookie("type","");
setcookie("cat1","");
setcookie("cat2","");
setcookie("cat3","");

header("Location:index.php");
}



if($_GET['type']<>""){

// ” »—€ —Œ–“»–Œ¬Ÿ» ¿ ***Õ≈ ”ƒ¿Àﬂ“‹***
setcookie("type",$_GET['type']);
setcookie("cat1",$_GET['cat1']);
setcookie("cat2",$_GET['cat2']);
setcookie("cat3",$_GET['cat3']);

	
}



$time= $_GET['time'];
$region= $_GET['region'];
$city= $_GET['city'];

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




header("Location: mobile/index.php");
?>