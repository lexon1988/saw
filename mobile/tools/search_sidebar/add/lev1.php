<?php



include('../../../../classes/class.php');



$db=new Database();







$type= $_POST['type'];

$cats=$db->db_select("cats", "WHERE type='$type' AND parent_id='0'");







$cats_count=count($cats);







echo "<select class='settings_select'  id='lev1' required>";

echo "<option></option>";



for($i=0;$i<$cats_count;$i++){

	

echo "<option value='".$cats[$i]['id']."'>".$cats[$i]['cat']."</option>";	

	

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

		

		$('#lev1').bind('change', function(){

		



				$.ajax({

					url: '../tools/search_sidebar/add/lev2.php',

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





<div id='information1'></div>

<div id='information2'></div>

<div id='information3'></div>







<br>



<input id='cat1' type='hidden' name='cat1' value=''>

<input id='cat2' type='hidden' name='cat2' value=''>

<input id='cat3' type='hidden' name='cat3' value=''>

