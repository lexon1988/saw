<?php

include('../../../../classes/class.php');

$db=new Database();


$type= $_POST['type'];
$cats=$db->db_select("cats", "WHERE type='$type' AND parent_id='0'");



$cats_count=count($cats);



echo "<select id='lev1' class='settings_select'>";
echo "<option></option>";

for($i=0;$i<$cats_count;$i++){

unset($selected);	
if($_COOKIE['cat1']==$cats[$i]['id']) $selected="selected";


echo "<option value='".$cats[$i]['id']."' ".$selected.">".$cats[$i]['cat']."</option>";	
	
}
echo "<select>";

//print_r($cats);
?>


<script>



	function funcBefore1(){
		$('#selector1').text('...');
		$('#cat2').val("");
		$("#lev2").css({"display":"none"}); 
		$("#lev3").css({"display":"none"});	 
		
	}

	function funcSuccess1(data){
		$('#selector1').html(data);	
		$('#cat1').val($('#lev1').val());
	}


	

	
	
	
	$(document).ready(function(){
		
		$('#lev1').bind('change', function(){
		

				$.ajax({
					url: 'tools/search_sidebar/index/lev2.php',
					type: 'POST',
					data: ({
						
						type: '<?php echo $type; ?>',
						parent_idd: $('#lev1').val(),
					
					}),
					dataType: 'html',
					beforeSend: funcBefore1,
					success: funcSuccess1
				});
			});	
		});


		
		
		
<?php	
if($_COOKIE['cat1']<>""){

	
	echo "	
	$(document).ready(function(){	
	
	if($('#lev1').val()!=''){

			$.ajax({
					url: 'tools/search_sidebar/index/lev2.php',
					type: 'POST',
					data: ({
						
						type: '".$type."',
						parent_idd: $('#lev1').val(),
					
					}),
					dataType: 'html',
					beforeSend: funcBefore1,
					success: funcSuccess1
				});
		
	}
});	


		";

	}
	
?>	
	
		
		
		
		</script>


<div id='selector1'></div>
<div id='selector2'></div>
<div id='selector3'></div>


<input id='cat1' type='hidden' name='cat1' value=''>
<input id='cat2' type='hidden' name='cat2' value=''>
<input id='cat3' type='hidden' name='cat3' value=''>











