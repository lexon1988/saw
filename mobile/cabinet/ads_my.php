
<html>
    <head>
        <title>SaaWok</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
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
		
		<link rel="stylesheet" href="../css/jquery.mobile-1.4.5.min.css" />

		<link rel="stylesheet" href="../css/style.css" />
        <script src="../js/jquery.mobile-1.4.5.js"></script>
		<script src="../js/jquery.shorten.1.0.js"></script>
        
		
		
	
		
		
		
		

		
		
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
include('noauth.php');

$user_id=$_COOKIE['id'];

$ads=$db->db_select("ads","WHERE author='$user_id' and (status=0 OR status=2 OR status=3) order by id desc");
$ads_count=count($ads);





echo "<table class='table table-bordered' width=100%>";

echo "<tr>
	
		<th>№</th>

		<th>Текст объявления</th>	
		<th></th>
	
	
	</tr>";



for($i=0;$i<$ads_count; $i++){
	
	
	if($ads[$i]['type']==0){
		
		$type='Товар';	
	
	}else{
		
		$type='Услуга';	
	}
	
	if($ads[$i]['status']==0){
		
		$status='<font color=red>Ожидает модерации</font>';
		
		}
	
	if($ads[$i]['status']==2){
		
		$status='<font color=green>Одобрено</font>';
		
	}
	
	

	
	
	
	if($ads[$i]['status']==3){
		
		$status='<font color=red>Отклонено!</font>';
		
	}
	
	
	echo "<tr>
	
		<td align=center><b>".($i+1)."</b></td>
		<td>".$type."/ 
		<small>".$db->get_cat_by_id($ads[$i]['cat1'])."<b> > </b>	
		".$db->get_cat_by_id($ads[$i]['cat2'])."<b> > </b>	
		".$db->get_cat_by_id($ads[$i]['cat3'])."</small>
		
		<hr style='border-bottom:1px solid white;'>
		
		".$ads[$i]['text']."
		<br>
	
		
		";
		
		
		if($ads[$i]['files']<>""){
	
		echo "
	<br>
		<small>
		";	
		
			$db->get_files_public_mob("../../uploads/".$ads[$i]['author']."/".$ads[$i]['files']."/","");
		
		echo "
		</small>

		";
		
		}
		
		
		echo "
			<b style='float:right; padding:5px;'>".$status."</b>
		</td>	
		<td align=center style='background-color:#1b1b1b; border-radius:5px;'>
		
		
		<a href='ads_my.php?id=".$ads[$i]['id']."'  rel='external' class='ui-btn ui-shadow ui-corner-all ui-icon-delete ui-btn-icon-notext ui-btn-b'>Delete</a>
		<a href='ads_edit.php?id=".$ads[$i]['id']."'  rel='external' class='ui-btn ui-shadow ui-corner-all ui-icon-edit ui-btn-icon-notext ui-btn-b'>edit</a>
		

		</td>	
	</tr>
	
	

	";
		
	
	
	echo "

	
	";
	
	
	if($ads[$i]['status']==3){
		
		echo "
			<tr>
				<td colspan=7>
				<br />
				<b style='background-color: #A80000; color:white; padding:8px;'>Комментарий модератора :</b> ".$ads[$i]['comment']."
				<br /><br />
				</td>
			<tr>
		
		
		";
		
	}
	
	
	
	
}

echo "</table>";

/*УДАЛИТЬ
if($_GET['id']<>"" ){
	
	$del_id=$_GET['id'];
	$db->db_delete("ads","WHERE id='$del_id'");
	$headerr->redirect_to("ads_my.php",1000);
	
}

*/


if($_GET['id']<>""){
	
$del_id=$_GET['id'];
	
$ads=$db->db_select("ads","WHERE id='$del_id'");	
	
if($ads[0]['status']==2){$statuss=11;}
if($ads[0]['status']==0 OR $ads[0]['status']==3){$statuss=1;}	




	$db->db_update("ads","set status=$statuss WHERE id='$del_id'");
	$headerr->redirect_to("ads_my.php",0);
	
}







?>





</div>


    
       

    

    
<!-- leftpanel1  -->
<div data-role="panel" id="leftpanel1" data-position="left" data-display="push" data-theme="b" style='z-index:9999'>
 

 <?php include("menu_profile.php"); ?>

</div><!-- /leftpanel1 -->
        



		


		

</body>
</html>    