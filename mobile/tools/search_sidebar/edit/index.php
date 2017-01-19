<?php


$id= $_GET['id'];

$user_id=$_COOKIE['id'];
$ads= $db->db_select("ads","WHERE id='$id'");

$type=$ads[0]['type'];


if($_GET['edit']==2){
	
	
	echo "<font color='green'>Объявление обновлно и отправленно на повторную модерацию.	</font><hr>";
	
}

?>




<script src='http://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js'></script>
<script>
	function funcBefore(){
		$('#information').text('...');
	}

	function funcSuccess(data){
		$('#information').html(data);	
	}



	
		$.ajax({
			url: '../tools/search_sidebar/edit/lev1.php',
			type: 'POST',
			data: ({type: '<?php echo $type; ?>', id: <?php echo $id; ?>}),
			dataType: 'html',
			beforeSend: funcBefore,
			success: funcSuccess
		});
	
	
	
	
	
	
	
$(document).ready(function(){
		



		
		
		
		$('#radio').bind('change', function(){
			$.ajax({
					url: '../tools/search_sidebar/edit/lev1.php',
					type: 'POST',
					data: ({type: $('#radio').val(), id: <?php echo $id; ?>}),
					dataType: 'html',
					beforeSend: funcBefore,
					success: funcSuccess
				});
			});	
	

	
	
		
		
		$('#radio1').bind('change', function(){
		

				$.ajax({
					url: '../tools/search_sidebar/edit/lev1.php',
					type: 'POST',
					data: ({type: $('#radio1').val(), id: <?php echo $id; ?>}),
					dataType: 'html',
					beforeSend: funcBefore,
					success: funcSuccess
				});
			});	
		
		
		
		
		
		
		
		});

</script>






<form action='ads_edit.php?edit=1&id=<?php echo $id; ?>' method='post' enctype="multipart/form-data" data-ajax="false">
  
  <table width=100%>
  <tr>
  <td><input id='radio' type="radio" name="ads_type" value="0" <?php if($type==0) echo "checked"; ?>> <br> <b>Товары</b></td>
  <td><input id='radio1' type="radio" name="ads_type" value="1" <?php if($type==1) echo "checked"; ?>> <br> <b>Услуги</b></td>
  </tr>
  </table>
  
  <hr>
  
  <div id='information'><small>Выберите товары или услуги!</small></div>

</form>







<?php




if($_GET['edit']==1){
	

if($ads[0]['files']<>""){
	
$files= $db->db_post_files_mob('files',$ads[0]['files']);
	
}else{
	
	$files= $db->db_post_files_mob("files");
}	
	
$region_arr= $db->db_select("user","WHERE id='$user_id'");
$region=$region_arr[0]['region'];
$city=$region_arr[0]['city'];
	

$ads_type=$_POST['ads_type'];
$cat1=$_POST['cat1'];
$cat2=$_POST['cat2'];
$cat3=$_POST['cat3'];
$text=$_POST['text'];
$author=$_COOKIE['id'];
$status=0;

$arr['region']=$region;
$arr['city']=$city;
	
	
$db->db_update("ads","SET type='$ads_type', cat1='$cat1', cat2='$cat2', cat3='$cat3', text='$text', author='$author', status='$status',files='$files'  WHERE id='$id'");
	
	
//$headerr->redirect_to("ads_edit.php?&id=".$id,0);	
	
	}



if($_GET['del']<>""){
	$del=$_GET['del'];
	
	$ads= $db->db_select("ads","WHERE id='$id'");
	$file_folder=$ads[0]['files'];
	
	unlink("../../uploads/".$user_id."/".$file_folder."/".$del);
	$headerr->redirect_to("ads_edit.php?id=".$id,"0");
	
}



?>
