<?php
include('../../../../classes/class.php');
$db=new Database();



$type= $_POST['type'];
$parent_id= $_POST['parent_idd'];





$cats3=$db->db_select("cats", "WHERE type='$type' AND parent_id='$parent_id'");



$cats_count3=count($cats3);


if($cats_count3==0) {$displaynone="style='display:none;'";
}else{
	$displaynone="";
}



echo "<select id='lev3' ".$displaynone." class='settings_select'>";
echo "<option></option>";

for($i=0;$i<$cats_count3;$i++){


unset($selected3);	
if($_COOKIE['cat3']==$cats3[$i]['id']) $selected3="selected";
		
echo "<option value='".$cats3[$i]['id']."' ".$selected3.">".$cats3[$i]['cat']."</option>";	
	
}
echo "<select>";



?>


<script>



	$(document).ready(function(){
		
		$('#lev3').bind('change', function(){
		$('#cat3').val($('#lev3').val());

	
	
	
			});	
		});

</script>