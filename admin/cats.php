<?php


//includes-----------------
include('../classes/class.php');
//-------------------------
$headerr=new Headerr();
$db=new Database();

$headerr->headerrs("Категории","","","utf-8");
$headerr->admin_bar();

$type=$_GET['type'];

if($_GET['type']=="") $type=$_POST['type'];
if($type==0 OR $type==1){$table='cats';}
if($type==2){$table='regions';}



echo "<div class='content container'>
<div align='left' class='sorting_block'>
<br />
<a href='cats.php?type=0'>Товары</a> | 
<a href='cats.php?type=1'>Услуги</a> |
<a href='cats.php?type=2'>Регионы</a>
<br /><br />


<b>Категория: </b>
<br />
<form action='cats.php' method='post'>
	<input type='text' size='20' name='cat'>
	<input type='hidden' size='20' name='type' value='".$type."'>
	<input type='submit' value='Добавить'>
</form>



";



$cats= $db->db_select($table,"WHERE parent_id=0 AND type='$type' order by id asc");

$cats_count=count($cats);




echo "<table class='table table-bordered'>";

for($i=0;$i<$cats_count;$i++){
	
	echo "<tr>";
		echo "<td><a href='cats_tree.php?cat=".$cats[$i]['cat']."&type=".$type."'>".$cats[$i]['cat']."</a></td>";
	
		echo "<td><a href='cats.php?del=".$cats[$i]['id']."&type=".$type."'>Удалить</a></td>";
	echo "</tr>";
	
}

echo "</table>";



//Записываем в базу категорию
if($_POST['cat']<>""){
	
	$cat['cat']=$_POST['cat'];
	$cat['type']=$_POST['type'];
	$db->db_insert($table,$cat);
	
	$headerr->redirect_to("cats.php?type=".$type,0);
}




//Удаляем из базы
if($_GET['del']<>""){
	
	$del=$_GET['del'];
	$db->db_delete($table,"WHERE id='$del'");
	
	$headerr->redirect_to("cats.php",0);
}

echo "</div></div>";




?>