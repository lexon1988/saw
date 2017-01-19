<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js'></script>



<?php



include('classes/class.php');







$db=new Database();



$headerr=new Headerr();











$headerr->headerrs("Объявление","","","utf-8");



$headerr->user_bar();











$user_id= $_COOKIE['id'];







$ads_id=$_GET['id'];











$ads= $db->db_select("ads","WHERE id='$ads_id'");



echo " 



<div class='uc_bor'>



<p class='obm_obl'>

".$db->get_region_by_id($ads[0]['region'])." /

".$db->get_region_by_id($ads[0]['city'])."

</p>

<table class='obm_style_tab'>

<tr class='ob1_tr'>
<td>

<p class='ht_style'>Автор</p>: <p class='in_style'>

";



echo $db->get_user_by_id($ads[0]['author']);


//Выводятся все данные



        if($ads[0]['type']==0){



                $type='Товары';

        }else{


                $type='Услуги';



        }


echo  "

</p></td><td>

<p class='ht_style'>ID</p>: 
<p class='in_style'>

".$ads[0]['id']." 

</p>

</td>

<td>

<p class='ht_style'>Тип</p>: 
<p class='in_style'>".$type."</p>

</td>

<td>





 



<p class='ht_style'>Дата</p>: <p class='in_style'>

".date("d.m.y в H:i",$ads[0]['date'])."

</p></td>
</tr>
<tr class='ob2_tr'><td colspan='4'>
<p class='ob2_text'>



".$ads[0]['text']."

</p>

</td></tr>

<tr class='ob3_tr'><td colspan='4' valign='middle'>







";


	echo "<br /><p class='ht_style'>Вложенные файлы</p> <p class='in_style'>";

			

			if($ads[0]['files']<>""){$db->get_files_public("uploads/".$ads[0]['author']."/".$ads[0]['files']."/","");}	

			
echo " <hr>
</td>

</tr>
<tr class='ob3_tr'>
<td colspan='2'>

";
			

			if($ads[0]['author']==$_COOKIE['id']){

					

					$nowrite="style='display:none;'";

					

				}else{ 

			

			$nowrite="";

			

			}

			







?>







<a class='m_btn' <?php echo $nowrite; ?> href='cabinet/massages.php?ads=<?php echo $ads_id; ?>&to=<?php echo $ads[0]['author']; ?>'>Написать письмо</a>



</td>

<td colspan='2'>



				  <div class='sdropup'>

			    <span class='m_btn'>Дополнительные действия</span>

                                  <div class='sdropup_content'>

					<p id='fav'>Добавить в избранное</p>

                                        <p id='hide_ob'>Скрыть</p>

				 </div>

			</div>

	

</td>

</tr>

</table>



</div>





<script>

$(document).ready(function() {



$('#fav').bind('click', function(){





			$.ajax({

				

				type: 'POST',

				data: ({

					

					id: '<?php echo $ads_id; ?>'

				

				

				}),

				

				url: 'cabinet/fav_add.php',

				dataType: 'html',

				success: function(html) {

				

				alert(html);

				

				}

			});





});







$('#hide_ob').bind('click', function(){





			$.ajax({

				

				type: 'POST',

				data: ({

					

					id: '<?php echo $ads_id; ?>'

				

				

				}),

				

				url: 'cabinet/hide_ob_add.php',

				dataType: 'html',

				success: function(html) {

				

				alert(html);

				

				}

			});





	});



});

</script>









