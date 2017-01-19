<?php
include('../classes/class.php');

$headerr=new Headerr();
$db=new Database();

$headerr->headerrs("Мои объявления","","","utf-8");
include('noauth.php');

$headerr->user_bar();

$user_id=$_COOKIE['id'];


$ads=$db->db_select("ads","WHERE author='$user_id' and (status=0 OR status=2 OR status=3) order by id desc");
$ads_count=count($ads);


echo "
<div class='content Scontainer'>
 <div class='user_block'>
  <h3>Мои объявления</h3>
<hr>
<a class='nav_st1' href='ads_my.php'><i class='fa fa-address-card-o' aria-hidden='true'></i> Мои объявления</a>

<a class='nav_st1' href='ads_my_arh.php'><i class='fa fa-lock' aria-hidden='true'></i> Приостановленные мной</a>

<a class='nav_st1' href='fav_ob.php'><i class='fa fa-star-o' aria-hidden='true'></i> Избранные</a>

<a class='nav_st1' href='hide_ob.php'><i class='fa fa-eye-slash' aria-hidden='true'></i> Скрытые</a>

";


echo "<hr>";


echo "<table class='table table-bordered'>";

echo "<tr>
	
		<th>№</th>
		<th>Тип объявления</th>
		<th>Категории</th>		

		<th>Текст объявления</th>	
		<th>Статус</th>
		<th></th>
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
		
		$status='<font color=green>Одобрено!</font>';
		
	}
	
	

	
	
	
	if($ads[$i]['status']==3){
		
		$status='<font color=red>Отклонено!</font>';
		
	}
	
	
	echo "<tr>
	
		<td>".($i+1)."</td>
		<td>".$type."</td>
		<td><small>".$db->get_cat_by_id($ads[$i]['cat1'])."<b> > </b>	
		".$db->get_cat_by_id($ads[$i]['cat2'])."<b> > </b>	
		".$db->get_cat_by_id($ads[$i]['cat3'])."</small></td>	
		<td><a href='../ob.php?id=".$ads[$i]['id']."'>".$ads[$i]['text']."</a></td>
		<td>".$status."</td>	
		<td><a href='ads_my.php?id=".$ads[$i]['id']."'>Приостановить</a></td>	
		<td>
		

		<a href='ads_edit.php?id=".$ads[$i]['id']."'>Редактировать</a>
		

		</td>	
	</tr>
	
	
	<tr>
	
	<td colspan=7 style='background-color: #D6FFF9;  padding:10px;'>
	<small>
	
	";
		
	if($ads[$i]['files']<>""){
	
		$db->get_files("../uploads/".$ads[$i]['author']."/".$ads[$i]['files']."/","");
	
	}
	
	echo "
	</small>
	</td>
	
	
	</tr>
	
	
	";
	
	
	if($ads[$i]['status']==3){
		
		echo "
			<tr>
				<td colspan=7>
				<br />
				<b style='background-color: #A80000; color:white; padding: 2px 8px;'>Комментарий модератора :</b> ".$ads[$i]['comment']."
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
	
if($ads[0]['status']==2){$status=11;}
if($ads[0]['status']==0 OR $ads[0]['status']==3){$status=1;}	


	$db->db_update("ads","set status='$status' WHERE id='$del_id'");
	$headerr->redirect_to("ads_my.php",1000);
	
}




echo "</div></div>";

$headerr->footerr();


?>
