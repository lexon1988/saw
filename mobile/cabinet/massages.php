
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
			width:75%;
			border-radius:25px;	
			background-color:#EFECEC;
			
			
		}
		
		
		.chat_in{
			margin-top:10px;
			min-height:20px;
			padding:15px;
			width:75%;
			border-radius:25px;	
			background-color:#DFFFB3;			
			margin-left:25%;
		}
		
		.chat_in_p{
			margin:0 auto;
			width:90%;
			
			
		}
		
		.chat_out_p{
			
			width:90%;
			text-align:left;
			
		}
		
		.mass{
			
			padding:5px;
			width:100%;
			background-color:#2a2a2a;
			color:white;
			font-size:25px;
		}
		
		.mass2{
			
			padding:5px;
			width:100%;
			background-color:#3737;
			color:white;
			font-size:20px;
			border-bottom:1px solid grey;
		}
		
		.mass3{
			
			padding:5px;
			width:100%;
			background-color:#3737;
			color:white;
			font-size:20px;
			border-top:1px solid grey;
		}
				
		small{
			font-size:12px;
			
		}
		

		
		</style>
		

		
		
    </head>
<body>

 
  


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

//Черный список
$bl=$db->db_select("black_list","WHERE (good_user='$from_post' AND bad_user='$to_post') OR (good_user='$to_post' AND bad_user='$from_post')");	  
if($bl<>""){
	
	echo "<h1>Доступ ограничен черным списком!</h1>
	<h2><a href='massages.php' rel='external'><< Вернуться в список контактов</h2>
	
	";
	exit();
}








if($_GET['ads']<>"" and $_GET['to']<>""){


$massages=$db->db_select("massages","WHERE (to_post='$from_post' AND from_post='$to_post' AND ads='$ads_id') OR (to_post='$to_post' AND from_post='$from_post' AND ads='$ads_id')");
$massages_count=count($massages);

for($i=0;$i<$massages_count;$i++){
	
	
	$massage_text=str_replace("../", "../../", $massages[$i]['massage']);
	$massage_text=str_replace("40em", "", $massage_text);
	$massage_text=str_replace("height", "style='max-width:100%;'", $massage_text);
	$massage_text=preg_replace('/<script\b[^>]*>(.*?)<\/script>/is', "", $massage_text);
	preg_match("/(.*)\<img/",$massage_text,$hreff);
	$massage_text=str_replace($hreff[1], "", $massage_text);
	$massage_text=str_replace("</a>", "", $massage_text);

	
	$date_mass=date("d.m.y в H:i:s",$massages[$i]['date']);

	if($massages[$i]['from_post']==$from_post){

		$user_post="Вы: ";
		$div_class='chat_in clearfix';

	}else{

		
		$user_post=$db->get_user_by_id($massages[$i]['from_post']);
		$div_class='chat_out clearfix';



	}

	
	echo "
		
		
			<div class='chat_in_p'>
				<div class='".$div_class."'  rel='external'>
				
				".$user_post." (<small>".$date_mass."</small>) 
				<hr>
				".$massage_text."
				
				</div>
			</div>
		
		
		";
	
	

	
}

?>


</div>


<?php

echo "
<a name='down'></a>

<form action='massages.php?to=".$to_post."&ads=".$ads_id."'method='post'>
<textarea name='massage' placeholder='Напишите сообщение и нажмите кнопку отпарвить...' cols='54'></textarea>
<input  type='submit' class='ui-btn ui-btn-b'  value='Отправить сообщение'>
</form>


<a href='massages.php?read=".$to_post."&ads=".$ads_id."' style='text-decoration:none;'> 
<button class='ui-btn ui-btn-b'>Отметить как прочитанное</button></a>





";


?>



<div data-role="collapsibleset" data-theme="a" data-content-theme="a" data-mini="true">
    <div data-role="collapsible" >
        <h3>Текст объявления</h3>
    <p>
<?php


$ads_get=$_GET['ads'];
$ads=$db->db_select("ads","WHERE id='$ads_get'");

			
			if($ads[0]['type']==0){
				$type='Товары';
			}

			
			if($ads[0]['type']==1){
				$type='Услуги';
			}

		
			echo "
         
					<strong>Дата</strong> ".date("Y.m.d - H:i:s",$ads[0]['date'])." <br /><strong>Тип объявления</strong> ".$type."<br /> 

						<strong>Регион</strong> ".$db->get_region_by_id($ads[0]['region'])." - ".$db->get_region_by_id($ads[0]['city'])." <br />
						<strong>Категории</strong> 
						".$db->get_cat_by_id($ads[0]['cat1'])." >
						".$db->get_cat_by_id($ads[0]['cat2'])." >
						".$db->get_cat_by_id($ads[0]['cat3'])." <br />

						<strong>ID объявления:</strong> ".$ads[0]['id']."
						
						";
						
							//выводит файлы объявления	
						if($ads[0]['files']<>""){
							
							echo "<br /><strong>Вложенные файлы:</strong> ";
							$db->get_files_public("../uploads/".$ads[0]['author']."/".$ads[0]['files']."/","");}	
							
						echo "
						<hr>
							".strip_tags($ads[0]['text'])."
						";

?>








	</p>
    </div>
    <div data-role="collapsible" style='margin-top:-20px;'>
        <h3>Мои файлы</h3>
    <p>

<?php

	$dirr="../../uploads/".$from_post."/chat/";

	if(file_exists($dirr)){

		}else{

			mkdir("../../uploads/".$from_post);
			mkdir("../../uploads/".$from_post."/chat/");

		}

			if(file_exists($dirr)){
			$dir= scandir($dirr);
			$dir_count=count($dir);

	
			echo "
		
			<table class='table_content' width=100%>";
			for($i=2;$i<$dir_count;$i++){
				echo "
				<tr>
					<td class='modal_td_bg'><img src='".$dirr."".$dir[$i]."' height=60em></td>
					";
					echo "<td align='center' class='modal_td_sm'><a href='massages.php?post_file=".$dir[$i]."&to=".$_GET['to']."&ads=".$_GET['ads']."'><div class='submit_st2'  rel='external'>Отправить</div></a></td>";
					echo "<td align='center' class='modal_td_sm'><a href='massages.php?del_file=".$dir[$i]."&to=".$_GET['to']."&ads=".$_GET['ads']."'><div class='submit_st2'  rel='external'>Удалить</div></a></td>";
					echo "	
				 </tr>
				";
			}
			echo "</table>";
			}else{
				echo "Нет файлов";
			}

			
			
?>
<hr>
<?php echo "<form action='massages.php?to=".$to_post."&ads=".$ads_id."&file=1' method='post'  data-ajax='false' enctype='multipart/form-data'>"; ?>


<input name='files[]' type='file' multiple  accept='image/jpeg,image/png,image/gif'  placeholder='загрузите файлы!'/>
<input class='submit_st1' type='submit' value='Загрузить'>
</form>


	</p>
    </div>
    <div data-role="collapsible" style='margin-top:-20px;'>
        <h3>Дополнительные действия</h3>
    <p>
<?php

echo "
              <a href='black_list.php?to=".$_GET['to']."' class='ui-btn ui-btn-b'> Отправить в Чёрный Список</a>
		
	";
			  
?>
	</p>
    </div>

<?php
 }else{
	 
	 //СТАРТОВАЯ СТРАНИЦА
	 
	 ?>
	 
		<div class='mass'>
		<b>Входящие:</b>
		</div>
		<?php
	
		for($i=0;$i<$in_mass_count;$i++){
			$temp_user= $db->get_user_by_id($in_mass[$i]['from_post']);
			$temp_ads=$in_mass[$i]['ads'];
			echo "<h2><a href='massages.php?to=".$in_mass[$i]['from_post']."&ads=".$in_mass[$i]['ads']."#down' style=' font-size:16px; text-decoration:none; color:grey;' rel='external'>".$temp_user." [".$temp_ads."]</a></h2>";
		}
		if($in_mass_count=="") echo "<br>Нет сообщений<br><br>";
		?>
		

		<div class='mass'>
		<b>Исходящие:</b>
		</div>
		<?php
		for($i=0;$i<$out_mass_count;$i++){
		$temp_user= $db->get_user_by_id($out_mass[$i]['to_post']);
		$temp_ads=$out_mass[$i]['ads'];
		echo "<h2><a href='massages.php?to=".$out_mass[$i]['to_post']."&ads=".$out_mass[$i]['ads']."#down' style='font-size:16px; text-decoration:none; color:grey;'  rel='external'>".$temp_user." [".$temp_ads."]</a></h2>";
		}	
		if($out_mass_count=="") echo "<br>Нет сообщений<br><br>";
		?>
	 
		<div class='mass'>
		<b>Контакты администрации:</b>
		</div>
		<br>
		<a href='massages.php?to=000&ads=000#down' style='font-size:16px; text-decoration:none; color:grey;' rel='external'>СЛУЖБА ПОДДЕРЖКИ</a>
		
	 <?php
 } 
 
 
?>

</div>

</div>
<!-- Тело -->

    
       

    

    
<!-- leftpanel1  -->
<div data-role="panel" id="leftpanel1" data-position="left" data-display="push" data-theme="b" style='z-index:9999'>

 <div class='mass2'>
		<b>Входящие:</b>
		
		<?php if($in_mass_count=="") echo "<small>Нет сообщений</small>";  ?>
		</div>
		<?php
			
		
		for($i=0;$i<$in_mass_count;$i++){
			$temp_user= $db->get_user_by_id($in_mass[$i]['from_post']);
			$temp_ads=$in_mass[$i]['ads'];
			echo "<h2><a href='massages.php?to=".$in_mass[$i]['from_post']."&ads=".$in_mass[$i]['ads']."#down' style=' font-size:16px; text-decoration:none;' class='ui-btn ui-corner-all ui-btn-a' rel='external' rel='external'>".$temp_user." [".$temp_ads."]</a></h2>";
			
		}
	
		?>
		
		<br><br>
		<div class='mass2'>
		<b>Исходящие:</b>
		
		<?php if($out_mass_count=="") echo "<small>Нет сообщений</small>";  ?>
		</div>
		<?php
	
		
		for($i=0;$i<$out_mass_count;$i++){
		$temp_user= $db->get_user_by_id($out_mass[$i]['to_post']);
		$temp_ads=$out_mass[$i]['ads'];
		echo "<h2><a href='massages.php?to=".$out_mass[$i]['to_post']."&ads=".$out_mass[$i]['ads']."#down' style='font-size:16px; text-decoration:none;' class='ui-btn ui-corner-all ui-btn-a' rel='external'>".$temp_user." [".$temp_ads."]</a></h2>";
		
		}	
		
		?>
	 
		<div class='mass2'>
		<b>Администрация:</b>
		</div>
		<br>
		<a href='massages.php?to=000&ads=000#down' style='font-size:16px; text-decoration:none;'  rel='external' class='ui-btn ui-corner-all ui-btn-a' rel='external'>СЛУЖБА ПОДДЕРЖКИ</a>


<br>
<div class='mass3'>
<a href='black_list.php' class='ui-btn ui-btn-b'  rel='external'>Черный список</a>
</div>

</div><!-- /leftpanel1 -->
        


		
		
		
		
<?php



if($_GET['read']<>""){

	$ads=$_GET['ads'];
	$read=$_GET['read'];
	$db->db_update("massages","SET status='1' WHERE from_post='$read' AND to_post='$from_post' AND ads='$ads'");
	$go_back="massages.php?to=".$read."&ads=".$ads;
	$headerr->redirect_to($go_back,'0');

}	

	

if($_GET['stop_ads']<>""){

	$stop_ads_id=$_GET['stop_ads'];
	$to_stop=$_GET['to'];
	$db->db_update("ads","SET status='11' WHERE id='$stop_ads_id'");
	$go_back="massages.php?to=".$to_stop."&ads=".$stop_ads_id;
	$headerr->redirect_to($go_back,'0');

}	




if($_FILES['files']['name'][0]){

$db->db_post_files_chat_mob('files');
$go_back="massages.php?to=".$to_post."&ads=".$ads_id."&files=1";
$headerr->redirect_to($go_back,'0');


}



if($_GET['del_file']<>""){
$ads_id=$_GET['ads'];
$to_post=$_GET['to'];
unlink("../../uploads/".$from_post."/chat/".$_GET['del_file']);	
$go_back="massages.php?to=".$to_post."&ads=".$ads_id."&files=1";
$headerr->redirect_to($go_back,'0');


}	

	

	

if($_GET['post_file']<>""){

	$arr['date']=strtotime(date("Y-m-d H:i:s"));
	$arr['from_post']=$from_post;
	$arr['to_post']=$_GET['to'];
	$arr['ads']=$_GET['ads'];
	$arr['massage']="<a href='../uploads/".$from_post."/chat/".$_GET['post_file']."' target='_blank' id='img".$arr['date']."'><img src='../uploads/".$from_post."/chat/".$_GET['post_file']."' height='40em'></a>
	
	<script type='text/javascript'>
			$(document).ready(function() {
		
				$('#img".$arr['date']."').fancybox({
					openEffect  : 'elastic',
					closeEffect : 'elastic',
					nextEffect  : 'elastic',
					prevEffect  : 'elastic'
				
				
				
				});
			});
		</script>
	
			

	";


	$db->db_insert("massages",$arr);
	$go_back="massages.php?to=".$_GET['to']."&ads=".$_GET['ads'];
	$headerr->redirect_to($go_back,'0');


}	

	

	

	

	

if($_GET['read']<>""){

	$ads=$_GET['ads'];
	$read=$_GET['read'];
	$db->db_update("massages","SET status='1' WHERE from_post='$read' AND to_post='$from_post' AND ads='$ads'");
	$go_back="massages.php?to=".$read."&ads=".$ads;
	$headerr->redirect_to($go_back,'0');

	

}	

	

	
if($_GET['stop_ads']<>""){
	
	$stop_ads_id=$_GET['stop_ads'];
	$to_stop=$_GET['to'];
	$db->db_update("ads","SET status='11' WHERE id='$stop_ads_id'");
	$go_back="massages.php?to=".$to_stop."&ads=".$stop_ads_id;
	$headerr->redirect_to($go_back,'0');

}	

	

if($_POST['massage']<>""){

	if(stristr($_POST['massage'], "<") OR stristr($_POST['massage'], ">")){
	$go_back="massages.php?to=".$to_post."&ads=".$ads_id."&err=Запрёщанные символы!";
	$headerr->redirect_to($go_back,'0');
	
	}else{

		$mass_insert['date']=strtotime(date("Y-m-d H:i:s"));
		$mass_insert['to_post']=$to_post;
		$mass_insert['from_post']=$from_post;
		$mass_insert['massage']=strip_tags($_POST['massage']);
		$mass_insert['ads']=$ads=$_GET['ads'];
		$mass_insert['status']=0;
		$db->db_insert("massages",$mass_insert);


		$db->db_update("massages","set status=1 WHERE from_post='$to_post' AND to_post='$from_post' AND ads='$ads'");
		$go_back="massages.php?to=".$to_post."&ads=".$ads_id;
		$headerr->redirect_to($go_back,'0');



	}

}


	
	



?>		
		
		
		
		
		
		
<?php 

if($_GET['to']<>""){

?>		
		
		
<script>
$(window).load(function() {
  		
$("html, body").animate({ scrollTop: $(document).height()-($(document).height()*0.27) }, 500);

 });
</script>
		
		
<?php

} 

?>			
		
	

	
</body>
</html>    