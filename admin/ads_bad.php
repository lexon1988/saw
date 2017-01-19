<?php
include('../classes/class.php');

$headerr=new Headerr();
$db=new Database();

$headerr->headerrs("Мои объявления","","","utf-8");
$headerr->admin_bar();

$user_id=$_COOKIE['id'];


$ads=$db->db_select("ads","WHERE status=3 order by id DESC");
$ads_count=count($ads);


echo "

<div class='content container'>
<br /><br />

<a href='ads_my.php'>Новые</a>

|

<a href='ads_good.php'>Одобренные</a>

|

<a href='ads_bad.php'>Отклонённые</a>

";


echo "<hr>";


echo "<table class='table table-bordered'";

echo "<tr>
	
		<th>№</th>
			<th>Автор</th>
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
	
	if($ads[$i]['status']==1){
		
		$status='<font color=red>Приостановлено</font>';
		
	}
	
	
	if($ads[$i]['status']==2){
		
		$status='<font color=red>Обобренно</font>';
		
	}
	
	
	if($ads[$i]['status']==3){
		
		$status='<font color=red>Отклонено</font>';
		
	}
	
	
	
	
	echo "<tr>
	
		<td>".($i+1)."</td>
			<td>".$db->get_user_by_id($ads[$i]['author'])." [".$ads[$i]['author']."]</td>
		<td>".$type."</td>
		<td><small>".$db->get_cat_by_id($ads[$i]['cat1'])."<b> > </b>	
		".$db->get_cat_by_id($ads[$i]['cat2'])."<b> > </b>	
		".$db->get_cat_by_id($ads[$i]['cat3'])."</small></td>	
		<td>".$ads[$i]['text']."</td>
		<td>".$status."</td>	
		<td><a href='ads_good.php?good=".$ads[$i]['id']."'>Одобрить</a></td>	
		<td>
		

		<a href='ads_good.php?bad=".$ads[$i]['id']."'>Отклонить</a>
		

		</td>	
	</tr>
		
		
	<tr>
	
	<td colspan=8 style='background-color: #D6FFF9;  padding:10px;'>
	<small>
	
	";
	
	
	$db->get_files("../uploads/".$ads[$i]['author']."/".$ads[$i]['files']."/","");
	
	
	echo "
	</small>
	
		
	<form action='ads_bad.php' metchod='get'>
	<hr>
	<b>Комментарий модератора: </b>
	<br>
	<textarea name='comment' rows='2' cols='20'>".$ads[$i]['comment']."</textarea>
	<br>
	<input type='hidden' value='".$ads[$i]['id']."' name='author'>
	<input type='submit' name='Отправить'>
	
	</form>
	
	
	";
	
	$author= $ads[$i]['author'];
	
	$bun_uer=$db->db_select("user","WHERE id='$author'");
	
	
	if($bun_uer[0]['status']==0){
	echo "
	<hr>
	<b><a href='ads_bad.php?bun=".$author."'>Заблокировать автора объявления!</a><b>";
	
	
	}else{
		
	echo "
	<hr>
	<font color='red'>Автор заблокирован! ----</font>
	
	<b><a href='ads_bad.php?unbun=".$author."'>Разблокировать!</a><b>";
		
	}
	

	
	
	echo "
	
	</td>
	
	
	</tr>
	
	
	
	
	
	
	
	
	
	
	";
	
}

echo "</table>";

/*УДАЛИТЬ
if($_GET['id']<>"" ){
	
	$del_id=$_GET['id'];
	$db->db_delete("ads","WHERE id='$del_id'");
	$headerr->redirect_to("ads_my.php",1000);
	
}

*/

if($_GET['good']<>"" ){
	
	$id=$_GET['good'];
	$db->db_update("ads","set status='2' WHERE id='$id'");
	$headerr->redirect_to("ads_my.php",1000);
	
}

if($_GET['bad']<>"" ){
	
	$id=$_GET['bad'];
	$db->db_update("ads","set status='3' WHERE id='$id'");
	$headerr->redirect_to("ads_my.php",1000);
	
}



if($_GET['comment']<>""){
	
	$id=$_GET['author'];
	$comment=$_GET['comment'];
	$db->db_update("ads","SET comment='".$comment."', status=3 WHERE id='$id'");
	
	$headerr->redirect_to("ads_bad.php",300);
	
}


if($_GET['bun']<>""){

$bun=$_GET['bun'];

$db->db_update("user","SET status=1 WHERE id='$bun'");


$headerr->redirect_to("ads_bad.php",300);
}



if($_GET['unbun']<>""){

$bun=$_GET['unbun'];

$db->db_update("user","SET status=0 WHERE id='$bun'");


$headerr->redirect_to("ads_bad.php",300);
}





echo "</div>";

$headerr->footerr();


?>