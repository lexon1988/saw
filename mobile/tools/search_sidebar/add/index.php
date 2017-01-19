<script src='http://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js'></script>

<script>

	function funcBefore(){

		$('#information').text('...');

	}



	function funcSuccess(data){

		$('#information').html(data);	

	}





	$(document).ready(function(){

		

		$('#radio').bind('change', function(){

		



				$.ajax({

					url: '../tools/search_sidebar/add/lev1.php',

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

					url: '../tools/search_sidebar/add/lev1.php',

					type: 'POST',

					data: ({type: $('#radio1').val()}),

					dataType: 'html',

					beforeSend: funcBefore,

					success: funcSuccess

				});

			});	

		});



</script>







<form action='ads_post.php' method='post' enctype="multipart/form-data" data-ajax="false">

  

  <table style='width: 400px;'>

  <tr>

  <td style='padding-left:15px;'><input  id='radio' type="radio" name="ads_type" value="0"><br> <b>Товары</b></td>

  <td><input id='radio1' type="radio" name="ads_type" value="1"><br> <b>Услуги</b></td>

  </tr>

  </table>

  

  <hr>

  

  <div style='padding-left: 20px;' id='information'><small>Выберите товары или услуги!</small></div>



</form>
