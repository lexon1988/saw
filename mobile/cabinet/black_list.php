
<html>
    <head>
        <title>SaaWok</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="../css/jquery.mobile-1.4.5.min.css" />
        <link rel="stylesheet" href="../css/jqm-demos.css" />
		<link rel="stylesheet" href="../css/style.css" />
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
        <script src="../js/jquery.mobile-1.4.5.js"></script>
		<script src="../js/jquery.shorten.1.0.js"></script>
        <script id="panel-init">
            $(function() {
                $( "body>[data-role='panel']" ).panel();
            });
        </script>
		<meta charset='utf-8'>
		
		
		

		
		
		
		<style>
		
		td{
			
			padding:3px;
			font-size:10px;
			color:black;
			
			background-color:#EFECEC;
			border:1px solid lighthgrey;
		}
		
		th{
			
			//border:1px solid grey;
			padding:3px;
			background-color:lightgrey;
			font-size:12px;
			color:black;
		}
		
	
		
		.links{
			
			font-size:12px;
			
		}

	

		
		
		
		
		
		
		
		
		.white{
			
		   color:white;
		
		}
		
		
		.contacts{
			
			color:white;
			width:100%;
			max-height:300px;
			overflow-y:auto;
			overflow-x:none;
			
		}
		
		
		.chat_body{
			margin:0 auto;
			border:0px solid grey;
			padding: 10px;
			height:70%;
			overflow-y:auto;
			overflow-x:none;
		}
		
		
		.chat_out{
			margin-top:10px;
			min-height:20px;
			padding:15px;
			width:50%;
			border-radius:25px;	
			background-color:#EFECEC;
			
			
		}
		
		
		.chat_in{
			margin-top:10px;
			min-height:20px;
			padding:15px;
			width:50%;
			border-radius:25px;	
			background-color:#DFFFB3;			
			margin-left:45%;
		}
		
		.chat_in_p{
			margin:0 auto;
			width:90%;
			
			
		}
		
		.chat_out_p{
			
			width:90%;
			text-align:left;
			
		}
		
		</style>
		

		
		
    </head>
<body >

 
  


<div data-role="page"  style="min-height: 613px;">
  


    
    
<div data-role="header" data-theme="b" data-position="fixed"> 
  <div data-role="navbar">
	<ul>
		<li>
            
            <a href="#leftpanel1" data-theme="b" class=" ui-icon-bars ui-btn-icon-left ">Контакты</a> 
		
        </li>
        <li>   
        
            <a href="index.php" data-theme="b" rel="external" class="">Личный кабинет</a> 
    

        </li> 
        
        <li>
            
		
				<a href='../../logout_mob.php' rel='external' data-position-to='window' class='' data-transition='pop'>Выход</a>				
			
        </li>
	</ul>
  </div>  
</div> 
    
 
	
<div role="main" class="ui-content grid" >
<?php
include('../../classes/class.php');

$headerr=new Headerr();
$db=new Database();

include('noauth.php');


//Создаст директорию для файлов если нет
$user_id=$_COOKIE['id'];


	
//GET данные
$ads_id=$_GET['ads'];
$to_post=$_GET['to'];
$from_post=(int)($_COOKIE['id']);
$ads=$db->db_select("ads","WHERE id='$ads_id'");
//===========================================


//Проверяем чьё объявление
if($ads[0]['author']==$user_id and $ads[0]['status']<>11) {
	
	$your_ads=1;
	
}else{
	
	$your_ads=0;	
	
}


if($ads[0]['status']==11) {
	
	echo $ads_WAS_STOPT= "<h2 style='margin-left:100px;'>Данное объявление приостановленно!</h2>";
}


//Входящие
$in_mass=$db->db_select("massages","WHERE to_post='$from_post' AND status='0' group by ads order by id desc LIMIT 10");
$in_mass_count=count($in_mass);


//Исходящие
$out_mass=$db->db_select("massages","WHERE from_post='$from_post' group by ads order by id desc LIMIT 10");
$out_mass_count=count($out_mass);
//============================================

?>


<!-- Тело -->

<div class='chat_body' rel='external'>


<?php

include('noauth.php');


$from_id=$_COOKIE['id'];
$to_id=$_GET['to'];

if($_GET['del']<>""){

		$del=$_GET['del'];

	$db->db_delete("black_list","WHERE good_user='$from_id' AND bad_user='$del'");
	$headerr->redirect_to("black_list.php","0");

}


$black_user_check= $db->db_select("black_list","WHERE good_user='$from_id' AND bad_user='$to_id'");



if($_GET['to'] AND $black_user_check[0]['bad_user']==""){

	$arr['good_user']=$from_id;
	$arr['bad_user']=$to_id;

	$db->db_insert("black_list",$arr);
	$headerr->redirect_to("black_list.php","0");
}


$black_list= $db->db_select("black_list","WHERE good_user='$from_id'");
$black_list_count=count($black_list);


echo "
<table class='table table-bordered' width=100%>
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




?>

</div></div></div>
<!-- Тело -->

    
       

    

    
<!-- leftpanel1  -->
<div data-role="panel" id="leftpanel1" data-position="left" data-display="push" data-theme="b" style='z-index:9999'>

 
<div class='contacts' rel='external'> 
<hr>
<b>Входящие:</b>
<hr> 
<?php
for($i=0;$i<$in_mass_count;$i++){
	$temp_user= $db->get_user_by_id($in_mass[$i]['from_post']);
	$temp_ads=$in_mass[$i]['ads'];
	echo "<a href='massages.php?to=".$in_mass[$i]['from_post']."&ads=".$in_mass[$i]['ads']."#down' style='color:white; font-size:12px; text-decoration:none;' rel='external'>".$temp_user." [".$temp_ads."]</a><br>";
}
?>
</div>

<div class='contacts' rel='external'> 
<hr>
<b>Исходящие:</b>
<hr>
<?php
for($i=0;$i<$out_mass_count;$i++){
$temp_user= $db->get_user_by_id($out_mass[$i]['to_post']);
$temp_ads=$out_mass[$i]['ads'];
echo "<a href='massages.php?to=".$out_mass[$i]['to_post']."&ads=".$out_mass[$i]['ads']."#down' style='color:white; font-size:12px; text-decoration:none;' rel='external'>".$temp_user." [".$temp_ads."]</a><br>";
}	

?>
</div>

<hr>
<a href='massages.php?to=000&ads=000#down' style='color:white; font-size:14px; text-decoration:none;' rel='external'>***СЛУЖБА ПОДДЕРЖКИ****</a>


<br><br>

<a href='black_list.php' class='ui-btn ui-btn-b'  rel='external'>Черный список</a>


</div><!-- /leftpanel1 -->
        

		
		
		
	

	
</body>
</html>    