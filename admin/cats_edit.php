<?php



//includes-----------------

include('../classes/class.php');

//-------------------------

$headerr=new Headerr();

$db=new Database();





$headerr->headerrs("Редактировать","","","utf-8");

$headerr->admin_bar();





$id=$_GET['id'];

if($_GET['type']<>"") {

	

	$type=$_GET['type'];



}else{

	

	$type=$_POST['type'];

}







if($type==0 OR $type==1){

	

	$table='cats';

	

}



if($type==2){

	

	$table='regions';

	

}



if($_GET['type']=="") $type=0;





$parent_cat=$_GET['cat'];





if($_POST['cat']<>"" AND $_POST['id']<>"" AND $_POST['type']<>""){

	

	

	$type=$_POST['type'];

	$cat=$_POST['cat'];

	$id=$_POST['id'];

	$parent_cat=$_POST['parent_cat'];

	

	

	

	$db->db_update($table,"set cat='$cat' WHERE id='$id'");

	

	

		echo "

	

	<script language='JavaScript'> 

			window.location.href = 'cats_tree.php?cat=".$parent_cat."&type=".$type."&fuck=off'

	</script>

";



	

	

}











$cat= $db->db_select($table,"WHERE id='$id'");





echo "

<div style='margin-left:20px'>

<form action='cats_edit.php' method='post'>

<p>Редактировать категорию</p>

<textarea name='cat' cols='30'>".$cat[0]['cat']."</textarea>

<input type='hidden' name='id' value='".$id."'>

<input type='hidden' name='type' value='".$type."'>

<input type='hidden' name='parent_cat' value='".$parent_cat."'>







<br>

<input type='submit' value='Отправить'>

</form>



</div>



";











?>
