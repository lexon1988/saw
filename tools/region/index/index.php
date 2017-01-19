

<?php






$type_region=2;
$cats=$db->db_select("regions", "WHERE type='$type_region' AND parent_id=''");



$cats_count=count($cats);



echo "


<td class='filter_td_m'>
<br />

  <div align='center'>
  <select id='lev1_region' name='region' >";

  
if($_COOKIE['region']==""){$selected00="selected";}else{$selected00="";}
echo "<option disabled ".$selected00.">Выберите область </option>";


for($i=0;$i<$cats_count;$i++){

if($_COOKIE['region']==$cats[$i]['id']){$selected0="selected";}else{$selected0="";}


echo "<option value='".$cats[$i]['id']."' ".$selected0.">".$cats[$i]['cat']."</option>";	
	
}
echo "
<option value='xxx'>Не выбрано</option>
</select></div></td><td class='filter_td_m'>";

//print_r($cats);
?>


<script>
	function funcBefore1_region(){
		$('#information1').text('');
	}

	function funcSuccess1_region(data){
		$('#information1').html(data);	
		$('#cat1').val($('#lev1_region').val());
	}



	
	$.ajax({
		url: 'tools/region/index/lev_region_2.php',
		type: 'POST',
		data: ({
			
			type: '<?php echo $type_region; ?>',
			parent_id: $('#lev1_region').val(),
		
		}),
		dataType: 'html',
		beforeSend: funcBefore1_region,
		success: funcSuccess1_region
	});
	
	
	

		$(document).ready(function(){
	
		
		$('#lev1_region').bind('change', function(){
		
		
				$.ajax({
					url: 'tools/region/index/lev_region_2.php',
					type: 'POST',
					data: ({
						
						type_region: '<?php echo $type_region; ?>',
						parent_id: $('#lev1_region').val(),
					
					}),
					dataType: 'html',
					beforeSend: funcBefore1_region,
					success: funcSuccess1_region
				});
			});	
		});

</script>
<br />


<div align='center'>


<div id="information1">



</div> 



</div>
</td>

