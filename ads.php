<?php





$user_id= $_COOKIE['id'];





if($_COOKIE['type']<>"") $type="AND type='".$_COOKIE['type']."' ";

if($_COOKIE['cat1']<>"") $cat1="AND cat1='".$_COOKIE['cat1']."' ";

if($_COOKIE['cat2']<>"") $cat2="AND cat2='".$_COOKIE['cat2']."' ";

if($_COOKIE['cat3']<>"") $cat3="AND cat3='".$_COOKIE['cat3']."' ";











if($_COOKIE['sql_date']<>"") $sql_date="AND date>'".$_COOKIE['sql_date']."' ";

if($_COOKIE['region']<>"") $sql_region="AND region='".$_COOKIE['region']."' ";

if($_COOKIE['city']<>"") $sql_city="AND city='".$_COOKIE['city']."' ";







$sqls=$type.$cat1.$cat2.$cat3.$sql_date.$sql_region.$sql_city;





$search=$_GET['search'];

if($search<>""){

	

	$sqls=" AND text LIKE '%".$search."%'";

	

}







if($user_id<>""){



	$black_ads=$db->db_select("black_ads","WHERE user='$user_id'");

	$black_ads_count=count($black_ads);



	for($i=0; $i<$black_ads_count; $i++){

		

		$back_ads_sql=$back_ads_sql." and id<>".$black_ads[$i]['ads'];

		

	}



}









$ads= $db->db_select("ads","WHERE status=2 ".$sqls." ".$back_ads_sql." order by id desc LIMIT 12");

$ads_count=count($ads);









for($i=0;$i<$ads_count; $i++){

	




$ads_count=count($ads);

for($i=0;$i<$ads_count;$i++){


//===============================================
$today=date("d.m.y");



$get_date= date("d.m.y",$ads[$i]['date']);


if($get_date==$today){
	
	$date="Сегодня";
	
}


if($get_date==date("d.m.y", mktime(0, 0, 0, date('m'), date('d') - 1, date('Y')))){
	
	$date="Вчера";
	
}

if($get_date<>date("d.m.y", mktime(0, 0, 0, date('m'), date('d') - 1, date('Y'))) AND $get_date<>date("d.m.y", mktime(0, 0, 0, date('m'), date('d'), date('Y')))){
	
	$date=$get_date;
	
}



$time=date("H:i",$ads[$i]['date']);

//===================================================
	

	

	if($ads[$i]['type']==0){

		

		$type='Т';	

	

	}else{

		

		$type='У';	

	}

	



	

	

	

	

	

	echo "

	<div class='grid-item shadow'>

	

	".$page."



	<table class='ob_tab'>



		<tr class='sm_tr'>



			<td class='sm_td'>



				<div class='ob_type'>



	".$type."



				</div>



			</td>	

			<td colspan='2' class='md_td'>



				<div class='nick'>";



				if($_COOKIE['id']==$ads[$i]['author']){

	



			

		echo "<font color='red'>Это ваше объявление!</font>";

			

			

		}else{

			

			

			

			echo $db->get_user_by_id($ads[$i]['author']);



	

		}





if(iconv_strlen($ads[$i]['text'])>100) {$show_more="<a href='ob.php?id=".$ads[$i]['id']."'>[...]</a>";}else{$show_more="";}



	







echo "</div>

			<div class='text_date'>
	
"; 


echo $date." в ".$time;
	//Дата
	

	echo "

				</div>



			</td>



			<td class='sm_td'>



                                <div class='dropup'>

  <button class='btns btn-default dropdown-toggle' type='button' id='dropdownMenu1' data-toggle='dropdown' aria-haspopup='true' aria-expanded='true'>

    <i class='fa fa-ellipsis-h' aria-hidden='true'></i>



<!--    <span class='caret'></span> -->

  </button>

  <ul class='dropdown-menu' aria-labelledby='dropdownMenu1'>


    <li>

                                        <p id='fav".$ads[$i]['id']."'>Добавить в избранное</p>
        </li>

    <li class='divider'></li>
        <li>

                                        <p id='hide_ob".$ads[$i]['id']."'>Скрыть</p>

        </li>
  </ul>

</div>


				



			</td>			

			

		</tr>";

	

	

	

		

echo "

		<tr class='bg_tr'>



			<td class='bg_td' colspan='4'>

				<p class='ob_obl'><i class='fa fa-map-marker' aria-hidden='true'></i> 

<!-- ".$db->get_region_by_id($ads[$i]['region'])." -->

".$db->get_region_by_id($ads[$i]['city'])." 





</p>";

echo "

<div class='more_text'>



".mb_substr(strip_tags($ads[$i]['text']),0,100,'UTF-8').$show_more."



		</div>

						

			</td>

			

		</tr>



<tr class='bsm_tr'>





				<td class='lg_td' colspan='4'>

					





					<a class='l_btn' href='#'' title='Открыть в модальном окне' data-toggle='modal' data-target='#myModal".$ads[$i]['id']."'>Подробная информация</a>

					<a class='r_btn' href='ob.php?id=".$ads[$i]['id']."' title='Открыть в новом окне'><i class='fa fa-link fa_min' aria-hidden='true'></i></a>



				</td>

			

			</tr>



	</table>

</div>";

	

	

	

	

	

	

//модальное окно

echo "

<div class='modal fade bs-example-modal-lg' id='myModal".$ads[$i]['id']."' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true' style='z-index:99;'>

  <div class='modal-dialog' role='document' style='width:60%;'>

    <div class='modal-content modal_style'>

 

        <button type='button' class='close' data-dismiss='modal' aria-label='Close' style='padding: 4px;'>
          <i class='fa fa-times fa-lg' aria-hidden='true'></i>
        </button>

    <br>

      



	<div class='modal-body'>

                        <table class='mod_tab'>

				<tr><td class='mod_mid_td'>

					<div class='ob_type2'>



					".$type."

					</div>

				</td><td class='mod_mid_td' colspan='2'><p class='ht_style'>ID: ".$ads[$i]['id']."</p></td>

				<td class='mod_mid_td'><p class='ht_style'>".date("d.m.y в H:i",$ads[$i]['date'])."</p></td>

				</tr>

				<tr>

				<td class='mod_vsm_td' colspan='4'>

				<p class='ob_obl'>

                        ".$db->get_region_by_id($ads[$i]['city'])." /					

                        ".$db->get_region_by_id($ads[$i]['region'])."



				</p>

				</td></tr>

				 <tr>

                                <td class='mod_inf_td' colspan='4'>

				

				

			<p class='ht_style'> Автор</p>: <p class='in_style'>";

			

			if($_COOKIE['id']==$ads[$i]['author']){







 		               echo "<font class='in_style'>Это ваше объявление!</font>";



	

        	        }else{







                        echo $db->get_user_by_id($ads[$i]['author']);





               		 }

			

				

			echo "</p><br /><p class='ht_style'>Категории</p>: <p class='in_style'> 	

			".$db->get_cat_by_id($ads[$i]['cat1'])." / 

			".$db->get_cat_by_id($ads[$i]['cat2'])." /

			".$db->get_cat_by_id($ads[$i]['cat3'])." </p>



			

			  

			

			<br /><p class='ht_style'>Вложенные файлы</p>: <p class='in_style'>";

			

			

			if($ads[$i]['files']<>""){$db->get_files_public("uploads/".$ads[$i]['author']."/".$ads[$i]['files']."/","");}	

			

			

			

			if($ads[$i]['author']==$_COOKIE['id']){

				

				$nowrite="style='display:none;'";

				

			}else{ 

			

			$nowrite="";

			

			}

			

			

			

			echo "

			

			</p></td></tr>  

			<tr>                             

			 <td class='mod_big_td' colspan='4'>

	

			                      ".$ads[$i]['text']."



			</td></tr>

			<tr>

		                         <td class='mod_mid_td' colspan='2'>



			

			

			

			<a class='m_btn' ".$nowrite." href='cabinet/massages.php?to=".$ads[$i]['author']."&ads=".$ads[$i]['id']."' title='Написать автору'>Написать автору</a>

							

							

                        </td>

			<td class='mod_mid_td' colspan='2'>





			  <div class='sdropup'>

			    <span class='m_btn'>Дополнительные действия</span>

                                  <div class='sdropup_content'>

					<p id='fav2".$ads[$i]['id']."'>Добавить в избранное</p>
                    <p id='hide_ob2".$ads[$i]['id']."'>Скрыть</p>

				 </div>

			</div>



			</td>

			</tr>	

			

			</table>

        </div>

    </div>

  </div>

</div>







";

	

?>	

	

	





<script>

$(document).ready(function() {



$('#fav<?php echo $ads[$i]['id']; ?>').bind('click', function(){





			$.ajax({

				

				type: 'POST',

				data: ({

					

					id: '<?php echo $ads[$i]['id']; ?>'

				

				

				}),

				

				url: 'cabinet/fav_add.php',

				dataType: 'html',

				success: function(html) {

				

				alert(html);

				

				}

			});





});







$('#hide_ob<?php echo $ads[$i]['id']; ?>').bind('click', function(){





			$.ajax({

				

				type: 'POST',

				data: ({

					

					id: '<?php echo $ads[$i]['id']; ?>'

				

				

				}),

				

				url: 'cabinet/hide_ob_add.php',

				dataType: 'html',

				success: function(html) {

				

				alert(html);

				

				}

			});





	});


	
	
	
	$('#fav2<?php echo $ads[$i]['id']; ?>').bind('click', function(){





			$.ajax({

				

				type: 'POST',

				data: ({

					

					id: '<?php echo $ads[$i]['id']; ?>'

				

				

				}),

				

				url: 'cabinet/fav_add.php',

				dataType: 'html',

				success: function(html) {

				

				alert(html);

				

				}

			});





});







$('#hide_ob2<?php echo $ads[$i]['id']; ?>').bind('click', function(){





			$.ajax({

				

				type: 'POST',

				data: ({

					

					id: '<?php echo $ads[$i]['id']; ?>'

				

				

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

	

	

<?php	

	

	}

	



	

}















?>
