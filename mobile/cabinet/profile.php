
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
		
		
		

		
		
    </head>
<body >

 
  


<div data-role="page"  style="min-height: 613px;">
  


    
    
<div data-role="header" data-theme="b" data-position="fixed"> 
  <div data-role="navbar">
	<ul>
		<li>
            
            <a href="#leftpanel1" data-theme="b" class=" ui-icon-bars ui-btn-icon-left ">Меню</a> 
		
        </li>
        <li>   
        
            <a href="../index.php" data-theme="b" rel="external" class="">Home</a> 
    

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


$url= "http://".$_SERVER['SERVER_NAME'];


$user_id=$_COOKIE['id'];
$arr_db= $db->db_select("user","WHERE id='$user_id'");


if(!is_dir("../../uploads/".$user_id)) mkdir("../../uploads/".$user_id);
	


$region=$db->get_region_by_id($arr_db[0]['region']);
$city=$db->get_region_by_id($arr_db[0]['city']);

if($_GET['rez']<>""){
	
	echo "<b><font class='success_st1'>".$_GET['rez']."</b></font><hr><br>";
	
}

if($_GET['pass']<>""){
	
	echo "<b><font class='success_st1'>".$_GET['pass']."</b></font><hr><br>";
	
}


echo "
<form action='profile.php' method='post'  data-ajax='false'>


	<b>Имя: </b>".$arr_db[0]['name']." <br>
	<b>E-mail: </b>".$arr_db[0]['email']." <br>
	<b>Телефон: </b>".$arr_db[0]['phone']." <br>
	
	<br>
	<font class='warning_st1'>Изменить имя или почту можно только через службу поддержки</font> - <font class='info_st1'><a href='".$url."/cabinet/massages.php?to=000&ads=000'>написать в службу поддержки</a></font>
		<hr>

	<b>Сменить пароль</b>
	<br>
	<input class='input_st1' type='text' size='10' name='pass' value=''>
	<input class='submit_st1' type='submit' data-theme='b' value='Сменить пароль'>
	</form>
	
	
	<form action='profile.php' method='post' data-ajax='false'> 
	<hr>
	
	<font class='info_st1'>Регион который будет указан в ваших объявлениях: <strong>".$region."/ ".$city."</strong> </font><br />
	<font class='warning_st1'>(можно сменить при необходимости)</font>
	<hr>
	<b>Укажите другой регион и нажимте на кнопку \"Отправить\"</b><br><br>
	
	";	
	

	include('../tools/region/reg/index.php');
	
echo "	
	
<input  class='submit_st1'  type='submit' data-theme='b' value='Отправить'>
</form>


</div></div>
";




if($_POST['region']<>""){

$region=$_POST['region'];
$city=$_POST['city'];

$db->db_update("user","SET region='$region', city='$city' WHERE id='$user_id'");

$headerr->redirect_to("profile.php?rez=Регион изменён!",0);

}


if($_POST['pass']<>""){
	
	$new_pass=$_POST['pass'];
	$user_id=$_COOKIE['id'];
	
	$db->db_update("user","set pass='$new_pass' WHERE id='$user_id'" );

	$headerr->redirect_to("profile.php?pass=Пароль изменён!",0);
	
}



?>





</div>


    
       

    

    
<!-- leftpanel1  -->
<div data-role="panel" id="leftpanel1" data-position="left" data-display="push" data-theme="b" style='z-index:9999'>

<?php include("menu_profile.php"); ?>

</div><!-- /leftpanel1 -->
        



		


		

</body>
</html>    