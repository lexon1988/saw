<?php


//То что подставляется в фильтры

if($_COOKIE['type']==0){$filter_type_cat="Товары";}
if($_COOKIE['type']==1){$filter_type_cat="Услуги";}



if($_COOKIE['cat1']=="") {$filter_cat1=" *** ";}else{ $filter_cat1= $db->get_cat_by_id($_COOKIE['cat1']); };
if($_COOKIE['cat2']=="") {$filter_cat2=" *** ";}else{ $filter_cat2= $db->get_cat_by_id($_COOKIE['cat2']); };
if($_COOKIE['cat3']=="") {$filter_cat3=" *** ";}else{ $filter_cat3= $db->get_cat_by_id($_COOKIE['cat3']); };

//================

$time=$_COOKIE['time'];

$region=$_COOKIE['region'];
$city=$_COOKIE['city'];

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




<table width=94% style='margin-left:10px;'>
<tr>
<td style='padding:10px;'>

	<?php 
	if($_COOKIE['type']<>""){
		echo "<b>".$filter_type_cat."</b> / ".$filter_cat1." / ".$filter_cat2." / ".$filter_cat3;
	}else{
		
		echo "<i style='color: #cc0000;' class='fa fa-exclamation-triangle' aria-hidden='true'></i> &nbsp; Категории не выбраны";
	
	}
	 ?>

</td>
<td style='padding:10px;'>	 
	 
	 <?php 

		if($city=="" AND $region<>"") { echo "<b>Регион: </b>".$db->get_region_by_id($region);

		}
		
		if($city<>"" AND $region<>"") {
		
		echo "<b>Город: </b>".$db->get_region_by_id($city);

		} 

		if($city=="" AND $region==""){
			
			echo "<i style='color: #cc0000; ' class='fa fa-exclamation-triangle' aria-hidden='true'></i> &nbsp; Регион не выбран";
			
		}


		 ?>
</td>


      <td style='padding-left:10px; width:320px;'>
	  
	  <div style='float:right;'>
	  
       		<form action='index.php' method='get'>
			<input name="search" type="text" size="26" placeholder=" &nbsp; Что хотите найти?" class='search_input'/>
        	<input class='search_button' type='submit' value='Поиск'>
			</form>
       </div>
		
		</td>


</table>	



<div class='filter_block shadow2' >






<form action='settings.php' method='post'>

<table class='filter_tbl'>
<tr>
<td class='filter_td_s'>
       
<div align='center'>              
<!-- 
<div class = "btn-group" data-toggle="buttons">
	
	
	
	<label class="<?php echo $radio_activ1; ?>">
		<input name="time" type="radio" value="1" <?php echo $check1; ?>>1
	</label>

	<label class="b<?php echo $radio_activ2; ?>">
		<input name="time" type="radio" value="2" <?php echo $check2; ?>>3
	</label>
	
	<label class="btn btn-default btn-sm  <?php echo $radio_activ3; ?>"> 
		<input name="time" type="radio" value="3" <?php echo $check3; ?>>7
	</label>
	
	<label class="btn btn-default btn-sm  <?php echo $radio_activ4; ?>">
		<input name="time" type="radio" value="4" <?php echo $check4; ?>>14		
	</label>
	
</div> -->


<?php


?>


<div class="btn-group">
  <button data-toggle="dropdown" class="sbtn btn-default dropdown-toggle"><?php echo $day_filter; ?><span class="caret"></span></button>
    <ul style='left: -10px !important;' class="dropdown-menu">
      <li>

	<label class="sbtn <?php echo $radio_activ1; ?>">
                <input name="time" type="radio" value="1" <?php echo $check1; ?>>1 день
        </label>


	</li>
	<li>


	  <label class="sbtn <?php echo $radio_activ2; ?>">
                <input name="time" type="radio" value="2" <?php echo $check2; ?>>3 дня
        </label>

	</li>
	<li>
	
	        <label class="sbtn <?php echo $radio_activ3; ?>">
                <input name="time" type="radio" value="3" <?php echo $check3; ?>>7 дней
        </label>



	</li>
	<li>

	        <label class="sbtn <?php echo $radio_activ4; ?>">
                <input name="time" type="radio" value="4" <?php echo $check4; ?>>Месяц
        </label>

	</li>

    </ul>
</div>
        
</div>	
</td>


<?php 

include('tools/region/index/index.php');

?>
	

<td class='filter_td_s'>
	<div align='center'>
		<input type='submit' class='button spec_1' value='Применить' >
	</div>

</form>
	
	</div>
	</td>

</tr>

<!--
<tr>
	
	

	
	
<td class='filter_td_b' colspan=3>
	<?php 
	if($_COOKIE['type']<>""){
		echo "<b>".$filter_type_cat."</b> / ".$filter_cat1." / ".$filter_cat2." / ".$filter_cat3;
	}else{
		
		echo "<i style='color: #cc0000;' class='fa fa-exclamation-triangle' aria-hidden='true'></i> &nbsp; Категории не выбраны";
	
	}
	 ?>
	

	
	
<div style='float:right'>
<?php 

if($city=="") { echo $db->get_region_by_id($region);

}else{
	
echo $db->get_region_by_id($city);

} 

if($city=="" AND $region==""){
	
	echo "<i style='color: #cc0000;' class='fa fa-exclamation-triangle' aria-hidden='true'></i> &nbsp; Регион не выбран";
	
}


 ?>
<div>

	</td>

	
        <td  class='filter_td_s'>
       		<form action='index.php' method='get' id='search'>
			<input name="search" type="text" size="40" placeholder="Поиск" />
        	</form>
        </td>

	
	

</tr>


-->

</table>

</div>


 
