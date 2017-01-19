<?php


class Headerr{
	
	
	
	//Header--------------------------------------------------------------------------
	public function headerrs ($title, $description, $keywords, $charset){
		
		$url= "http://".$_SERVER['SERVER_NAME'];

		echo $headerr= "
		<!DOCTYPE html>
		<html>
			<head>	
				<title>".$title."</title>
				<meta name='description' content='".$description."' />
				<meta name='keywords' content='".$keywords."' />


<!--				<title>SaaWok  - инструмент взаимодействия потребителя и поставщика</title>
				<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
				<meta name='description' content='Портал представляет из себя инструмент, выявляющий очевидную потребность в конкретных товарах и услугах' />
				<meta name='keywords' content='Частные объявления, товары и услуги, инструмент для покупателя, инструмент поставщика, объявления Казахстан' />
-->
				<meta name='author' content='SaaW Ok' />
				<meta name='publisher-email' content='hello@saawok.com' />
				<meta name='robots' content='index, follow' />
				<link rel='alternate' hreflang='ru' href='".$url."' />
		  		<meta name='wmail-verification' content='bea7cc76a2250183467cb642a8eabfa4' />	
				<meta charset='".$charset."'>

				<link rel='stylesheet' type='text/css' href='".$url."/css/jquery.fancybox.css' media='screen'>	
				<link rel='stylesheet' type='text/css' href='".$url."/css/style_old.css'>
				<link rel='stylesheet' type='text/css' href='".$url."/css/style.css'>
				<link rel='stylesheet' href='".$url."/css/bootstrap.min.css' type='text/css' media='all'>
				<link rel='stylesheet' href='".$url."/css/font-awesome.min.css' media='all'>
				
	 		        <link href='http://fonts.googleapis.com/icon?family=Material+Icons' rel='stylesheet'>

				<link rel='icon' type='image/x-icon' href='".$url."/images/sww.ico'>				

				<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js'></script>
				<script async src='".$url."/js/bootstrap.min.js'></script>
				<script async src='".$url."/js/infinite_scroll.js'></script>	
				<script async type='text/javascript' src='".$url."/js/jquery.fancybox.js'></script>										
			</head>

			<body>
			
		";

	} 

	//--------------------------------------------------------------------------------
	
	
	
	
	
	//USER BAR--------------------------------------------------------------------------
	public function user_bar(){
		
/*	if($_COOKIE['admin']=='welcome'){
		
		echo "<div style='position: absolute;' align='left'><a href='".$url."/admin/'>Админ чтолЕ?</a></div>";
		
	}
	

*/		
		$url= "http://".$_SERVER['SERVER_NAME'];
		
		
		$email=$_COOKIE['email'];
		$user_name=$_COOKIE['user'];
		$user_id=$_COOKIE['id'];
		
		
		$this->user=$email;
		$this->user_name=$user_name;
	
	
		
		$db=new Database();
		$massages_count= count($db->db_select("massages","WHERE to_post='$user_id' AND status='0'"));
		
		$ban_check=$db->db_select("user","WHERE id='$user_id'");
		
	

	
	
		if($_COOKIE['auth']<>'welcome'){
		
		echo $user_bar="
		
		<div class='header Scontainer'>
			
				<div class='sk-top'>
		 <ul class='sk-navbar sk-white sk-card'>
		 	  <li><a href='".$url."/index.php' ><img src='".$url."/images/lg.png' style='margin: 0 20px; height:25px' /></a></li>
              <li class='sk-right sk-hide-small'>
			  	  
			  <a href='".$url."/cabinet/auth.php'>Войти</a> 
			  
			  <a href='".$url."/cabinet/reg.php'>Зарегистрироваться</a> 
			
  			</ul>
		</div>
		
 
		

		</div>
	
		";
		
		}else{
		
		echo "		
		<div class='header Scontainer'>
	
        
     <!--   <table class='navbar_table'>
		
			<tr>

				<td rowspan='2' class='navbar_td'>
					<div class='navbar_logo' align='left'><a href='/'><img src='".$url."/images/sww.png' style='width:80px' /></a></div>
				</td>
				<td class='navbar_td'>  
					<div class='navbar_banner' align='center' valign='middle'>728 x 90</div>
				</td>
		   	</tr>
 
        </table>  
		
		<div class='top_space'></div>-->
		
		<div class='sk-top'>
		 <ul class='sk-navbar sk-white sk-card'>
		 	  <li><a href='".$url."/index.php' ><img src='".$url."/images/lg.png' style='margin: 0 20px; height:25px' /></a></li>
              <li class='sk-right sk-hide-small'>
			  <a href='".$url."/cabinet/profile.php'><i class='fa fa-user'></i> Профиль</a>
			  <a href='".$url."/cabinet/ads_my.php'><i class='fa fa-id-card-o'></i> Объявления</a>
			  <a href='".$url."/cabinet/ads_add.php'><i class='fa fa-plus-square'></i> Подать объявление</a>
			  <a href='".$url."/cabinet/massages.php'><i class='fa fa-envelope'></i> Сообщения <div class='m_style'>".$massages_count."</div></a>
			  <a href='".$url."/logout.php'><button class='button_auth' style='vertical-align:middle'><span><i class='fa fa-user'></i> Выход</span></button></a></li>
			  
			  <!-- Small desktop navbar -->
			      <li>
				  <a href='javascript:void(0)' class='sk-right sk-hide-large sk-hide-medium' onclick='sk_open()'>
				  	<i class='fa fa-bars sk-padding-right sk-padding-left'></i>
				  </a>
    			  </li>
  			</ul>
		</div>

		<!-- Sidenav on small screens when clicking the menu icon -->
			<nav class='sk-sidenav w3-black w3-card-2 w3-animate-left w3-hide-medium w3-hide-large' style='display:none' id='mySidenav'>
				<a href='javascript:void(0)' onclick='sk_close()' class='w3-large w3-padding-16'>Скрыть ×</a>
				<a href='".$url."/cabinet/profile.php' onclick='sk_close()'><i class='fa fa-user'></i> Профиль</a>
				<a href='".$url."/cabinet/ads_my.php'  onclick='sk_close()'>Мои объявления</a>
				<a href='".$url."/cabinet/ads_add.php' onclick='sk_close()'>Подать объявдение</a>
			    <a href='".$url."/cabinet/massages.php' onclick='sk_close()'><i class='fa fa-envelope'></i> Сообщения <span class='saw_badge_warning'>[".$massages_count."]</span></a>
			    <a href='".$url."/logout.php' onclick='sk_close()'> Выход</a>
			</nav>
			  			  
			<script>
			
			// Переключение между режимами отобразить -/- скрыть sidenav при нажатии на значок меню
			var mySidenav = document.getElementById('mySidenav');

			function sk_open() {
    		if (mySidenav.style.display === 'block') {
			mySidenav.style.display = 'none';
				} else {
					mySidenav.style.display = 'block';
					}
				}
				
				// Закрыть sidenav, жмахнув на кнопку Закрыть
				function sk_close() {
					mySidenav.style.display = 'none';
				}

			
			</script>
		</div>
		</div>        
			
			";			
			
		
			
	
	if($ban_check[0]['status']==1){
			
			$this->redirect_to($url."/cabinet/errors.php?err=2",0);
			exit();
		}
		
	
			
			
		}
		/*
		
		if(stristr($_SERVER['REQUEST_URI'],"cab") AND stristr($_SERVER['REQUEST_URI'],"auth")===false AND $_COOKIE['email']=="" ){
			
			$this->redirect_to($url."/cabinet/errors.php?err=1",0);
			
		}
		
		*/
		//
		
		
	}
	//--------------------------------------------------------------------------------
	
	
	//ADMIN BAR--------------------------------------------------------------------------
		public function admin_bar(){
			
			
		if($_COOKIE['admin']=='welcome'){
		
		
		$db=new Database();
		$massages_count= count($db->db_select("massages","WHERE to_post='000' AND status='0'"));
		
		echo "		
				<div class='header Scontainer'>
	
        
		<div class='sk-top'>
		 <ul class='sk-navbar sk-white sk-card'>
		 	  <li><a href='".$url."/index.php' ><img src='".$url."/images/wsw.png' style='height:14px' /></a></li>
              <li class='sk-right sk-hide-small'>
			  <a href='".$url."/admin/cats.php'>Категории</a>
			  <a href='".$url."/admin/users.php'>Юзеры</a>
			  <a href='".$url."/admin/ads_my.php'>Объявления</a>			   <a href='".$url."/admin/banners.php'>Баннеры</a>			  			  
			  <a href='".$url."/admin/massages.php'>Сообщения <span class='saw_badge_warning'>[".$massages_count."]</span></a>
			  <a href='".$url."/logout.php?admin=777'><button class='button_auth' style='vertical-align:middle'><span>Вы Админ! <i class='fa fa-user'></i> Выход</span></button></a></li>
            </ul>
		</div>
		
		</div> ";	
			
		}else{
			
		echo "<h1>Хацкер чтоле? -_0</h1>";
			exit();
			}
	
	}
	//--------------------------------------------------------------------------------
		
	
	

	
	//footer--------------------------------------------------------------------------	
	
	public function footerr (){
	
	echo $footerr="
				  	  	  
    </body>
</html>";	

	
	}
	
	//--------------------------------------------------------------------------------

	
	
	
	
	
	
	
	
	//ПЕРЕАДРЕСАЦИЯ-------------------------------------------------------------------------------
	public function redirect_to($url,$delay){
		
	echo $redirect= "

		<script language = 'javascript'>
		  var delay = ".$delay.";
		  setTimeout(\"document.location.href='".$url."'\", delay);
		</script>
		
		
		";

	}
	//--------------------------------------------------------------------------------	
	
	
	//Ошибка-------------------------------------------------------------------------------
	public function error($text,$text1){
		
		echo "<div class='error_block'><h1>".$text."</h1><p>".$text1."</p></div>";
		
		
	}
	//-----------------------
	
	
	
	//Уведомление-------------------------------------------------------------------------------
		public function notification($text,$text1){
		
		echo "<div class='notification_block'><h1>".$text."</h1><p>".$text1."</p></div>";
		
		
	}
	//-----------------------
	
	
	
	
	
}
?>
