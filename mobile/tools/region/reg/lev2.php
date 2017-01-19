<?php
include('../../../../classes/class.php');
$db=new Database();



$type= 2;
$parent_id= $_POST['parent_id'];



$cats2=$db->db_select("regions", "WHERE type='$type' AND parent_id='$parent_id'");



$cats_count2=count($cats2);

 

echo "
<b>Город: </b><br>

<select class='settings_select' placeholder='Выберите город' id='lev2' data-role='none'   name='city' >";
echo "<option></option>";

for($i=0;$i<$cats_count2;$i++){
	
echo "<option value='".$cats2[$i]['id']."''>".$cats2[$i]['cat']."</option>";	
	
}
echo "</select>";



?>
