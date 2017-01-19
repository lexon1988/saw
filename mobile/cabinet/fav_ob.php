
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

		</style>
		

		
		
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

<div class='links'>

<a href='ads_my.php' rel='external'>Мои объявления</a> |
<a href='ads_my_arh.php' rel='external'>Приостановленные мной</a>  |
<a href='fav_ob.php' rel='external'>Избранные</a>  |
<a href='hide_ob.php' rel='external'>Скрытые</a>

</div>

	 
	 <hr>

<?php
include('../../classes/class.php');
$headerr=new Headerr();
$db=new Database();


$user_id=$_COOKIE['id'];
$to_id=$_GET['to'];



$white_list= $db->db_select("white_ads","WHERE user='$user_id'");
$white_list_count=count($white_list);

echo "




<table class='table table-bordered' width=100%>
<tr>

<th>Номер объявления</th>
<th></th>

</tr>

";


for($i=0;$i<$white_list_count;$i++){

$white_list_id= $white_list[$i]['ads'];
	
$ads= $db->db_select("ads","WHERE id='$white_list_id'");	
	
echo "
<tr>

<td>[№-".$white_list_id."] ".$ads[0]['text']."</td>
<td align=center><a href='fav_ob.php?del=".$white_list[$i]['id']."' class='ui-btn ui-shadow ui-corner-all ui-icon-delete ui-btn-icon-notext ui-btn-b'>Удалить из списка</a></td>


</tr>";
	
}


echo "</table>";



if($_GET['del']<>""){
	
	$del=$_GET['del'];
	
	
	$db->db_delete("white_ads","WHERE id='$del'");
	$headerr->redirect_to("fav_ob.php","0");
}




?>




</div>


    
       

    

    
<!-- leftpanel1  -->
<div data-role="panel" id="leftpanel1" data-position="left" data-display="push" data-theme="b" style='z-index:9999'>
 

 <?php include("menu_profile.php"); ?>

</div><!-- /leftpanel1 -->
        



		


		

</body>
</html>    