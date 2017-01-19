<?php

if($_COOKIE['type']==0 AND $_COOKIE['type']<>""){

$radio_check1="checked";	
//$radio_check1_style="active";
}


if($_COOKIE['type']==1){$radio_check2="checked";
//$radio_check2_style="active";
}

?>








  <table width=100%>
  <tr>
	  <td>
	  
	<div>
		<label>
			<input id='radio' type="radio" name="type" value="0" <?php echo $radio_check1; ?>><span style='color:white;'>Товары</span>
		</label>
		</td>
		<td>
		
		<label>
			<input id='radio1' type="radio" name="type" value="1" <?php echo $radio_check2; ?>><span style='color:white;'>Услуги</span>
		</label>
     </div>
	</td>
  </tr>
  </table>
  

  
  <div id='selector' style='text-align:center; border:1px solid white; border-radius: 5px; padding:10px;'><small>Выберите товары или услуги!</small></div>

  
  


<script>



	function funcBefore(){
		$('#selector').text('...');
		$('#selector2').html();
	
	}

	function funcSuccess(data){
		$('#selector').html(data);	
	}

	

	
<?php

if($_COOKIE['type']=='0'){

	
echo "	
	$(document).ready(function(){	
	if($('#radio').val()==0){

			$.ajax({
					url: 'tools/search_sidebar/index/lev1.php',
					type: 'POST',
					data: ({type: $('#radio').val()}),
					dataType: 'html',
					beforeSend: funcBefore,
					success: funcSuccess
				});	
		
	}
});	


	";

}

if($_COOKIE['type']=='1'){

echo "
	$(document).ready(function(){	
		
	if($('#radio1').val()==1){
		
	
		$.ajax({
			url: 'tools/search_sidebar/index/lev1.php',
			type: 'POST',
			data: ({type: $('#radio1').val()}),
			dataType: 'html',
			beforeSend: funcBefore,
			success: funcSuccess
		});
	}
	
});	

";	
	
	}
	
	?>

	


		$(document).ready(function(){
		
		$('#radio').bind('change', function(){
		

				$.ajax({
					url: 'tools/search_sidebar/index/lev1.php',
					type: 'POST',
					data: ({type: $('#radio').val()}),
					dataType: 'html',
					beforeSend: funcBefore,
					success: funcSuccess
				});
			});	
	
		});	
	
	
		$(document).ready(function(){
		
		$('#radio1').bind('change', function(){
		

				$.ajax({
					url: 'tools/search_sidebar/index/lev1.php',
					type: 'POST',
					data: ({type: $('#radio1').val()}),
					dataType: 'html',
					beforeSend: funcBefore,
					success: funcSuccess
				});
			});	
		});

</script>

