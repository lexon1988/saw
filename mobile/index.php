<?php
include('../classes/class.php');
$db=new Database();


$user_id=$_COOKIE['id'];

//============================

if($_COOKIE['type']=='0'){$filter_type_cat="Товары";}
if($_COOKIE['type']==1){$filter_type_cat="Услуги";}



if($_COOKIE['cat1']=="") {$filter_cat1=" *** ";}else{ $filter_cat1= $db->get_cat_by_id($_COOKIE['cat1']); };
if($_COOKIE['cat2']=="") {$filter_cat2=" *** ";}else{ $filter_cat2= $db->get_cat_by_id($_COOKIE['cat2']); };
if($_COOKIE['cat3']=="") {$filter_cat3=" *** ";}else{ $filter_cat3= $db->get_cat_by_id($_COOKIE['cat3']); };

//================

$time=$_COOKIE['time'];

$region=$db->get_region_by_id($_COOKIE['region']);
$city=$db->get_region_by_id($_COOKIE['city']);

if($city<>""){
	
	$region=$city;
	
}

if($time==1){$check1='checked';
	
	
	$day_filter="1 день";
	$minus_time = strtotime('-1 days');
	$sql_date= strtotime(date('Y-m-d H:i:s', $minus_time));

	$radio_activ1="active";
	
}

if($time==2){$check2='checked';

	$day_filter="3 дня";
	$minus_time = strtotime('-3 days');
	$sql_date= strtotime(date('Y-m-d H:i:s', $minus_time));

	$radio_activ2="active";
}

if($time==3){$check3='checked';

	$day_filter="7 дней";
	$minus_time = strtotime('-7 days');
	$sql_date= strtotime(date('Y-m-d H:i:s', $minus_time));

	$radio_activ3="active";
}

if($time==4){$check4='checked';

	$day_filter="Месяц";
	$minus_time = strtotime('-1 days');
	$sql_date= "";
	
	$radio_activ4="active";
}

if($time==''){$check4='checked';


$day_filter="Фильтр по дням";

}


?>

<html>
    <head>
        <title>SaaWok</title>
		<meta charset='utf-8'>

        <meta name="viewport" content="width=device-width, initial-scale=1">
      	  <link rel="stylesheet" href="css/jquery.mobile-1.4.5.min.css" />
        <link rel="stylesheet" href="css/jqm-demos.css" />
		<link rel="stylesheet" href="css/style.css" />
		
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
        <script src="js/jquery.mobile-1.4.5.js"></script>
		<script src="js/jquery.shorten.1.0.js"></script>
        <script id="panel-init">
            $(function() {
                $( "body>[data-role='panel']" ).panel();
            });
        </script>
		
		

		
		
    </head>
<body >

 <?php
$massages_count= count($db->db_select("massages","WHERE to_post='$user_id' AND status='0'"));
if($massages_count>0){
	
	echo "
<script>

setTimeout(function () {
	
alert('Внимание! У вас есть непрочитанные сообщения, перейдите в личный кабинет.');

}, 3000); // время в мс

	
</script>	
	
	


	";
	
}
?>

  


<div data-role="page"  style="min-height: 613px;">
  


    
    
<div data-role="header" data-theme="b" data-position="fixed"> 
  <div data-role="navbar">
	<ul>
		<li>
            
            <a href="#leftpanel1" data-theme="b" class=" ui-icon-gear ui-btn-icon-left ">Фильтры</a> 
		
        </li>
        <li>   
        
            <a href="index.php" data-theme="b" rel="external" class="">SaaWok</a> 
    

        </li> 
        
        <li>
            
			<?php if($_COOKIE['id']==""){
				echo "<a href='#popupLogin' data-rel='popup' data-position-to='window' class='' data-transition='pop'>Вход</a>"; 
			}else{
				echo "<a href='cabinet/index.php' rel='external' data-position-to='window' class='' data-transition='pop'>Личный кабинет</a>"; 				
			}
			?>
        </li>
	</ul>
  </div>  
</div> 
    
 

		
     
		
<div role="main" class="ui-content grid" >




	<div style='width:90%; margin:0 auto; padding:5px; border:0px solid black; margin-top:-20px;'>
	
		<?php 
		
		 if($_COOKIE['id']<>""){
			
			
			echo "<a href='cabinet/ads_add.php' class='ui-btn  ui-icon-shop  ui-btn-icon-left'><font >Подать объявления</font></a>";
			echo "<a href='cabinet/massages.php' class='ui-btn  ui-icon-mail  ui-btn-icon-left'><font >Сообщения[".$massages_count."] </font></a>";
			
			
		 }	
		
		

			if($filter_type_cat=="" AND $filter_type_cat<>"0" OR $region==""){
				
				echo "<a href='#leftpanel1' class='ui-btn  ui-icon-alert  ui-btn-icon-left'><font color='red'>Настойте регион и категории в фильтрах! </font></a>
				<hr>
				<small>По умолчанию объявления выводятся по всем категорияи из всех регионов</small>
				";
				
			}



		
		
			
		?>
		
	
	</div>
	<br>

    <div data-role="popup" id="popupLogin" data-theme="b" class="ui-corner-all">
    <form action='../login_mob.php' method='POST' data-ajax="false">
        <div style="padding:0px 20px;">
         
            <label for="un" class="ui-hidden-accessible">Логин:</label>
            <input type="text" name="email" id="un" value="" placeholder="E-mail" data-theme="a">
            <label for="pw" class="ui-hidden-accessible">Пароль:</label>
            <input type="password" name="pass" id="pw" value="" placeholder="Пароль" data-theme="a">
            <button type="submit" class="ui-btn ui-corner-all ui-shadow ui-btn-b ui-btn-icon-left">Войти</button>
			<a href='cabinet/reg.php' rel="external" style=' text-decoration:none;'><div  class="ui-btn ui-corner-all ui-shadow ui-btn-b ui-btn-icon-left">Регистрация</div></a>   
     </div>
    </form>


</div>
        

			<!-- Модальная карнка -->
            <div class='modal_window'>
				<a href=''><span id='close_modal_img' style='margin-left:70%; cursor:pointer;'><img src='close.png' height=40em></span></a>
				<br>

				<img id='modal_img' class='modal_img' src='#' style=' '>
			</div> 
		
     
        
    
<?php



include("ads.php");



?>  

    

    	<a href='#' style=' text-decoration: none;'>
    </div>

		<div id='show_more' <?php if($ads_count<12) echo "style='display:none; '"; ?>>Загрузить ещё</div>	 

 <br>   	
</div>
	</a>

    
       

    
    
    <!-- MENU ->
    
	<!-- leftpanel1  -->
	<div data-role="panel" id="leftpanel1" data-position="left" data-display="push" data-theme="b" style='z-index:9999'>
 

 	<form action='index.php' method='get' data-ajax="false">
			<table width=100%>
			<tr>
			<td>
			
			<input name="search" type="text" size="13" placeholder="Что ищите?" />
        	
			</td>
			<td>
			

        <input type="submit" data-enhanced="true" value="Найти">

			</td>
			</tr>
			</table>
	</form>

 
 

<form action='../mob_cookie.php' method='get' rel='external' data-ajax="false">
  

	<h3>Категории: </h3>
    <?php 
	
		include("tools/search_sidebar/index/index.php"); 
	
	?> 


	<h3>Регион: </h3>
	
	
	<div class='select_body'>
	<?php
	
		include('tools/region/index/index.php');
	
	?>
	</div>
	
		
		<h3>Фильтр по дням: </h3>
	
	
	<div class='select_body'>
	

			<input name="time" type="radio" value="1" <?php echo $check1; ?>>1 день

			<input name="time" type="radio" value="2" <?php echo $check2; ?>>3 дня

			<input name="time" type="radio" value="3" <?php echo $check3; ?>>7 дней

			<input name="time" type="radio" value="4" <?php echo $check4; ?>>Месяц

	
	
	</div>
	
	
        
        <input type='submit' value='Сохранить настройки' class="ui-btn ui-btn-b" style='width:100%; background: #156323;'>
        <a href='../mob_cookie.php?reset=1'  rel='external' class="ui-btn ui-btn-b" style='color:white; background: #651e0f;'>Сбросить настройки</a>
        
		
		<hr>
	
	<div style='width:100%; text-align:center;'>
		<a href='../../terms/' style='color:white;' rel='external'>Правила</a> | <a href='../../hello/' style='color:white;' rel='external'>Инструкции</a> 	
	</div>	
	
	</form>	
	

	
	
	
</div><!-- /leftpanel1 -->
        



		
		
		
		
	
<script>

$( document ).ready(function() {



	var page=1;
	

	// Each time the user scrolls
	$(window).scroll(function() {

		
		if (parseInt($(window).scrollTop()) == $(document).height() - $(window).height()) {		
	


			$.ajax({
				
				type: 'POST',
				data: ({
					
					page: page
				
				
				}),
				
				url: 'page.php',
				dataType: 'html',
				success: function(html) {
				
					page=page+1;
					$('.grid').append(html);
				
				}
			});
		}
	

	});

	
	
	
$('#show_more').bind('click', function(){

	$.ajax({
				
				type: 'POST',
				data: ({
					
					page: page
				
				
				}),
				
				url: 'page.php',
				dataType: 'html',
				success: function(html) {
				
					page=page+1;
					$('.grid').append(html);
					
				}
			});
	
	
	
	
	
});





$(".modal_window").hide();

$("img").bind("click", function() {
     var a= $(this).attr("src");
     $(".modal_window").show();
     $("#modal_img").attr("src",a);
	
	
});

 $("#close_modal_img").bind("click", function() {
     
     $(".modal_window").hide();
     
});





  $(".content").shorten({
      "showChars" : 150,              // - длина текста в символах.
      "moreText"  : "Подробнее",      // - текст "читать далее".
      "ellipsesText" : "...",         // - вместо многоточия можно вписать к примеру и "[...]".
      "lessText"  : "Скрыть текст",   // - текст возврата в исходное состояние.
  });


});









</script>
		
		


		

</body>
</html>    