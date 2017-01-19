<?php
include('../../../classes/class.php');
$db=new Database();


$id=$_POST['id'];

$type= $_POST['type'];
$parent_id= $_POST['parent_id'];


$ads= $db->db_select("ads","WHERE id='$id'");


$cats3=$db->db_select("cats", "WHERE type='$type' AND parent_id='$parent_id'");



$cats_count3=count($cats3);



echo "<select class='input_st1' id='lev3'>";
echo "<option></option>";

for($i=0;$i<$cats_count3;$i++){
	
	
if($ads[0]['cat3']==$cats3[$i]['id']) {
	$check='selected';
}else{
	
	$check='';
	
}
	
	
	
	
echo "<option value='".$cats3[$i]['id']."' ".$check.">".$cats3[$i]['cat']."</option>";	
	
}
echo "<select>";



?>


<script>
	function funcBefore3(){
		$('#information3').text('...');
	}

	function funcSuccess3(data){
		$('#information3').html(data);	
		$('#cat3').val($('#lev3').val());
	}


	
	$.ajax({
		url: '../tools/search_sidebar/edit/lev4.php',
		type: 'POST',
		data: ({
			
			type: '<?php echo $type; ?>',
			parent_id: $('#lev3').val(),
			id: <?php echo $id; ?>
		}),
		dataType: 'html',
		beforeSend: funcBefore3,
		success: funcSuccess3
	});

	
	
	
	
	
	
	
	$(document).ready(function(){
		
		$('#lev3').bind('change', function(){
		

				$.ajax({
					url: '../tools/search_sidebar/edit/lev4.php',
					type: 'POST',
					data: ({
						
						type: '<?php echo $type; ?>',
						parent_id: $('#lev3').val(),
						id: <?php echo $id; ?>
					}),
					dataType: 'html',
					beforeSend: funcBefore3,
					success: funcSuccess3
				});
			});	
		});

</script>
