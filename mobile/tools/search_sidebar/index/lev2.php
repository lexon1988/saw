<?php
include('../../../../classes/class.php');
$db=new Database();



$type= $_POST['type'];
$parent_id= $_POST['parent_idd'];



$cats2=$db->db_select("cats", "WHERE type='$type' AND parent_id='$parent_id'");



$cats_count2=count($cats2);



echo "<select id='lev2' class='settings_select'>";
echo "<option></option>";

for($i=0;$i<$cats_count2;$i++){
	
unset($selected2);	
if($_COOKIE['cat2']==$cats2[$i]['id']) $selected2="selected";
	
	
	
echo "<option value='".$cats2[$i]['id']."' ".$selected2.">".$cats2[$i]['cat']."</option>";	
	
}
echo "<select>";



?>


<script>

$("#selector3").css({"display":"none"}); 

	function funcBefore2(){
	
		$('#selector2').text('...');
	}

	function funcSuccess2(data){
		
		$('#selector2').html(data);	
		$('#cat2').val($('#lev2').val());
	}


	
	
	<?php	
	if($_COOKIE['cat2']<>""){

	
	echo "	
	$(document).ready(function(){	
	
	if($('#lev2').val()!=''){

			$.ajax({
					url: 'tools/search_sidebar/index/lev3.php',
					type: 'POST',
					data: ({
						
						type: '".$type."',
						parent_idd: $('#lev2').val(),
					
					}),
					dataType: 'html',
					beforeSend: funcBefore2,
					success: funcSuccess2
				});
		
	}
});	


		";

	}
	
?>	
	
	
	
	
	
	$(document).ready(function(){
		
		$('#lev2').bind('change', function(){
		

				$.ajax({
					url: 'tools/search_sidebar/index/lev3.php',
					type: 'POST',
					data: ({
						
						type: '<?php echo $type; ?>',
						parent_idd: $('#lev2').val(),
					
					}),
					dataType: 'html',
					beforeSend: funcBefore2,
					success: funcSuccess2
				});
			});	
		});

</script>