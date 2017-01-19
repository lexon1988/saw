<?php

include('../../../../classes/class.php');

$db=new Database();







$type= $_POST['type'];

$parent_id= $_POST['parent_id'];







$cats2=$db->db_select("cats", "WHERE type='$type' AND parent_id='$parent_id'");







$cats_count2=count($cats2);







echo "<select class='settings_select' id='lev2' required>";

echo "<option></option>";



for($i=0;$i<$cats_count2;$i++){

	

echo "<option value='".$cats2[$i]['id']."'>".$cats2[$i]['cat']."</option>";	

	

}

echo "<select>";







?>





<script>

	function funcBefore2(){

		$('#information2').text('...');

	}



	function funcSuccess2(data){

		$('#information2').html(data);	

		$('#cat2').val($('#lev2').val());

	}





	$(document).ready(function(){

		

		$('#lev2').bind('change', function(){

		



				$.ajax({

					url: '../tools/search_sidebar/add/lev3.php',

					type: 'POST',

					data: ({

						

						type: '<?php echo $type; ?>',

						parent_id: $('#lev2').val(),

					

					}),

					dataType: 'html',

					beforeSend: funcBefore2,

					success: funcSuccess2

				});

			});	

		});



</script>
