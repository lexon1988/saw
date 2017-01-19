<?php

$type= 2;
$cats=$db->db_select("regions", "WHERE type='$type' AND parent_id=''");



$cats_count=count($cats);



echo "

<b>Область:</b> <br>	
<select class='form-control' id='lev1' name='region' required>";


for($i=0;$i<$cats_count;$i++){
	
echo "<option value='".$cats[$i]['id']."'>".$cats[$i]['cat']."</option>";	
	
}
echo "</select>";

//print_r($cats);
?>


<script>
	function funcBefore1(){
		$('#information_reg').text('...');
	}

	function funcSuccess1(data){
		$('#information_reg').html(data);	
		$('#cat1').val($('#lev1').val());
	}


	$(document).ready(function(){
		
		
		$.ajax({
					url: '../tools/region/reg/lev2.php',
					type: 'POST',
					data: ({
						
						type: '<?php echo $type; ?>',
						parent_id: $('#lev1').val(),
					
					}),
					dataType: 'html',
					beforeSend: funcBefore1,
					success: funcSuccess1
				});
		
		
		
		
		
		
		$('#lev1').bind('change', function(){
		
		
				$.ajax({
					url: '../tools/region/reg/lev2.php',
					type: 'POST',
					data: ({
						
						type: '<?php echo $type; ?>',
						parent_id: $('#lev1').val(),
					
					}),
					dataType: 'html',
					beforeSend: funcBefore1,
					success: funcSuccess1
				});
			});	
		});

</script>



<div id='information_reg'></div>