<?php
include('../../../../classes/class.php');
$db=new Database();



$type_region= 2;
$parent_id= $_POST['parent_id'];

if($parent_id=="xxx" or $parent_id==""){
	
	$disabled="style='background-color:lightgrey; cursor: not-allowed;'";
	
}else{
	
	$disabled="";
	
}






$cats2=$db->db_select("regions", "WHERE type='$type_region' AND parent_id='$parent_id'");



$cats_count2=count($cats2);


if($parent_id<>"" AND $parent_id<>"xxx"){



if($_COOKIE['city']==""){$selected11="selected";}else{$selected11="";}

echo "
<select id='lev2_region'  name='city' class='settings_select'>
<option disabled ".$selected11." >Выберите город </option>";

for($i=0;$i<$cats_count2;$i++){
	
if($_COOKIE['city']==$cats2[$i]['id']){$selected="selected";}else{$selected="";}	
	
echo "<option value='".$cats2[$i]['id']."' ".$selected.">".$cats2[$i]['cat']."</option>";	
	
}

echo "

<option value='xxx'>Не выбрано</option>
</select>";


}else{
	
	
	echo "
	
	<select name='region222' disabled  ".$disabled."' title='СНАЧАЛА ВЫБЕРИТЕ ОБЛАСТЬ!' class='settings_select'>
	<option disabled selected>Выберите город </option>
	</select>
	
	";
	
	
}


?>
