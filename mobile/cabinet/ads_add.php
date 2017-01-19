
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
$tools=new Tools();

include('noauth.php');

$user_id= $_COOKIE['id'];
$arr_db= $db->db_select("user","WHERE id='$user_id'");

$region=$db->get_region_by_id($arr_db[0]['region']);
$city=$db->get_region_by_id($arr_db[0]['city']);


echo "

<p class='info_st1'>Вы указали регион: <b>".$region." / ".$city."</b></p> <p class='warning_st1'>(изменить регион можно в профиле)</p>
 <br />";

include("../tools/search_sidebar/add/index.php");


?>



</div>


    
       

    

    
<!-- leftpanel1  -->
<div data-role="panel" id="leftpanel1" data-position="left" data-display="push" data-theme="b" style='z-index:9999'>
 

 <?php include("menu_profile.php"); ?>

</div><!-- /leftpanel1 -->
        



		


		

</body>
</html>    