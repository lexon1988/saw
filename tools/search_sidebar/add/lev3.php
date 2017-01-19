<?php

include('../../../classes/class.php');

$db=new Database();







$type= $_POST['type'];

$parent_id= $_POST['parent_id'];







$cats3=$db->db_select("cats", "WHERE type='$type' AND parent_id='$parent_id'");







$cats_count3=count($cats3);







echo "<select class='input_st1' id='lev3'>";

echo "<option></option>";



for($i=0;$i<$cats_count3;$i++){

	

echo "<option value='".$cats3[$i]['id']."'>".$cats3[$i]['cat']."</option>";	

	

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





	$(document).ready(function(){

		

		$('#lev3').bind('change', function(){

		



				$.ajax({

					url: '../tools/search_sidebar/add/lev4.php',

					type: 'POST',

					data: ({

						

						type: '<?php echo $type; ?>',

						parent_id: $('#lev3').val(),

					

					}),

					dataType: 'html',

					beforeSend: funcBefore3,

					success: funcSuccess3

				});

			});	

		});



</script>







<br>



<p>Введите текст объявления:</p>

<textarea name='text' cols='50' rows='5' required></textarea>

<br><br>



<input name='files[]' type='file' multiple  accept='image/*'  placeholder="загрузите файлы!"/>



<hr>



<input class='submit_st1' type='submit' value='Отправить'>



</form>
