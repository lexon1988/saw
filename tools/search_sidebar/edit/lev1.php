<?php

include('../../../classes/class.php');

$db=new Database();



$type= $_POST['type'];
$cats=$db->db_select("cats", "WHERE type='$type' AND parent_id='0'");


$id=$_POST['id'];
$ads= $db->db_select("ads","WHERE id='$id'");





$cats_count=count($cats);



echo "<select class='input_st1' id='lev1' required>";
echo "<option></option>";

for($i=0;$i<$cats_count;$i++){
	
	
	if($ads[0]['cat1']==$cats[$i]['id']) {
		$check='selected';
	}else{
		
		$check='';
		
	}
	
echo "<option value='".$cats[$i]['id']."' ".$check.">".$cats[$i]['cat']."</option>";	
	
}
echo "<select>";

//print_r($cats);
?>


<script>
	function funcBefore1(){
		$('#information1').text('...');
	}

	function funcSuccess1(data){
		$('#information1').html(data);	
		$('#cat1').val($('#lev1').val());
	}


	$(document).ready(function(){
		
		
		$.ajax({
			url: '../tools/search_sidebar/edit/lev2.php',
			type: 'POST',
			data: ({
				
				type: '<?php echo $type; ?>',
				parent_id: $('#lev1').val(),
				id: <?php echo $id; ?>,
			}),
			dataType: 'html',
			beforeSend: funcBefore1,
			success: funcSuccess1
		});

		
		
		
		
		
		$('#lev1').bind('change', function(){
		

				$.ajax({
					url: '../tools/search_sidebar/edit/lev2.php',
					type: 'POST',
					data: ({
						
						type: '<?php echo $type; ?>',
						parent_id: $('#lev1').val(),
						id: <?php echo $id; ?>,
					}),
					dataType: 'html',
					beforeSend: funcBefore1,
					success: funcSuccess1
				});
			});	
		});

</script>


<div id='information1'></div>
<div id='information2'></div>
<div id='information3'></div>



<br>

<input id='cat1' type='hidden' name='cat1' value=''>
<input id='cat2' type='hidden' name='cat2' value=''>
<input id='cat3' type='hidden' name='cat3' value=''>
