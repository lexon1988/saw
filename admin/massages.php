<?php
include('../classes/class.php');

$headerr=new Headerr();

$db=new Database();





$headerr->headerrs("Сообщения","","","utf-8");

$headerr->admin_bar();









//GET данные

$ads_id=$_GET['ads'];

$to_post=$_GET['to'];

$from_post="000";

$ads=$db->db_select("ads","WHERE id='$ads_id'");






//===========================================





//Входящие

$in_mass=$db->db_select("massages","WHERE to_post='$from_post' AND status='0' group by from_post order by id desc LIMIT 10");

$in_mass_count=count($in_mass);



//Исходящие

$out_mass=$db->db_select("massages","WHERE from_post='$from_post' group by to_post order by id desc LIMIT 10");

$out_mass_count=count($out_mass);







//============================================







echo "

<style>



.chat_inner{

	

	overflow-y:auto;

	

}





</style>





 

    <div class='content Scontainer'>

        <div class='user_block'> 
	<h3>Переговорная</h3>
        <hr>
	<table class='content_table'>

        

        <tr>

            

             <td class='messages_ls_td'>

                <div class='messages_ls_block'>

                   <div class='h4_st1'>Входящие

                  </div>    

                      <div class='messages_p'>                     

					  ";

					  

					 

					for($i=0;$i<$in_mass_count;$i++){

					

					$temp_user= $db->get_user_by_id($in_mass[$i]['from_post']);

					$temp_ads=$in_mass[$i]['ads'];





					echo "<p><a href='massages.php?to=".$in_mass[$i]['from_post']."&ads=".$in_mass[$i]['ads']."'>".$temp_user." <span class='ch_style'>".$temp_ads."</span></a></p>";

					



					

					}

					



				   echo "

				   

				   </div>

                   <div class='h4_st1'>Исходящие

                   </div>

                   <div class='messages_p'>  


					";





				for($i=0;$i<$out_mass_count;$i++){

					

				$temp_user= $db->get_user_by_id($out_mass[$i]['to_post']);

				$temp_ads=$out_mass[$i]['ads'];



					echo "<p><a href='massages.php?to=".$out_mass[$i]['to_post']."&ads=".$out_mass[$i]['ads']."'>".$temp_user." <span class='ch_style'>".$temp_ads."</span></a></p>";

					

					

					

					}		

		 

	 

	 

					echo "

                   </div>

					";

                
				

				echo "

				
		

			<div class='h4_st1'>Списки

                   </div>   
				<div class='messages_p'> 
				<a href='black_list.php'>Черный список</a>
				
                 </div>
				 </div>

            </td>

			   <td class='messages_c_td'>



			

			";

			

			

			if($_GET['to']<>""){

			

			

		echo "

		 <div class='messages_c_block'>

		  <div class='chatbox'>

			<div class='h4_st1'>Переговорная</div>

			<div class='chat_inner' id='chat'>

			

			";

			

			

			$massages=$db->db_select("massages","WHERE (to_post='$from_post' AND from_post='$to_post' AND ads='$ads_id') OR (to_post='$to_post' AND from_post='$from_post' AND ads='$ads_id')");

			$massages_count=count($massages);



			for($i=0;$i<$massages_count;$i++){

				

				

				if($massages[$i]['from_post']==$from_post){

					

					$user_post="Вы: ";

					$div_class='chat_in clearfix';

				}else{

					

					$user_post=$db->get_user_by_id($massages[$i]['from_post']);

					$div_class='chat_out clearfix';

					

				}

			

			

			

			

			

			

			echo "

			



					 <div class='".$div_class."'>

                        <span class='message'>".$massages[$i]['massage']."</span>

                        <span class='author'>".$user_post." ".date("d.m.y в H:i:s",$massages[$i]['date'])."</span>

                      </div>

                     

					 

					 

					 ";

				

					  }

					  

			 
echo "</div>";
                   

				   
				   
			$bl=$db->db_select("black_list","WHERE (good_user='$from_post' AND bad_user='$to_post') OR (good_user='$to_post' AND bad_user='$from_post')");	   
				   
				   
				   
				   
				   
				   
				   
			if($bl[0]['id']==""){	   
				   
				   
				   
				   
				   
					echo "

                    <div class='form'>

					  

					  <form action='massages.php?to=".$to_post."&ads=".$ads_id."'method='post'>

                        <textarea name='massage' placeholder='Напишите сообщение и нажмите кнопку отпарвить...' cols='54'></textarea>
							<br />
							<div align='center'>
								<input class='submit_st2' type='submit' class='btn'  value='Отправить сообщение'>
							</div>
					 </form>
							<div align='center'>
					  		<a href='massages.php?read=".$to_post."&ads=".$ads_id."'> 
								<button class='submit_st3' >Отметить как прочитанное</button></a>

								<a class='submit_st3' title='Прикрепить файл' data-toggle='modal' data-target='#myModal' href='#navigation-main'>
								<i class='fa fa-file' aria-hidden='true'></i> Прикрепить файл</a>
							</div>
                          
						";
							

						}
					
					
					
					echo "

						  </div>           

                    </div>

                  </div>

                </div>

           
		








<div class='modal fade bs-example-modal-lg' id='myModal' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true' style='z-index:99999;'>

  <div class='modal-dialog' role='document' style='width:95%;'>

    <div class='s_modal_content'>

 

        <button type='button' class='close' data-dismiss='modal' aria-label='Close'>

	 <i class='fa fa-times fa-lg' aria-hidden='true'></i>

        </button>

    <br>

      



	<div class='s_modal_body'>



	";

	

	

	$dirr="../uploads/".$from_post."/chat/";

	

	if(file_exists($dirr)){



		}else{

			

			mkdir("../uploads/".$from_post);

			mkdir("../uploads/".$from_post."/chat/");

			

		}

		



			if(file_exists($dirr)){

			$dir= scandir($dirr);

			$dir_count=count($dir);

			

			echo "
			
			<h3>Управление файлами</h3>
			<hr>
			<table class='table_content'>";

			

			for($i=2;$i<$dir_count;$i++){

				

				

				echo "

				<tr>

				

					<td class='modal_td_bg'><img src='".$dirr."".$dir[$i]."' height=60em></td>

					";

					

					echo "<td class='modal_td_sm'><a href='massages.php?post_file=".$dir[$i]."&to=".$_GET['to']."&ads=".$_GET['ads']."'><div class='submit_st2'>Отправить</div></a></td>";

				

					echo "<td class='modal_td_sm'><a href='massages.php?del_file=".$dir[$i]."&to=".$_GET['to']."&ads=".$_GET['ads']."'><div class='submit_st2'>Удалить</div></a></td>";

					echo "	

					 

				 

				 </tr>

				";



			}



			echo "</table>";

			

			}else{

				

				echo "Нет файлов";

				

			}

	

	

	

	

	

	

echo "	

	<hr>
<div align='center'>
<form action='massages.php?to=".$to_post."&ads=".$ads_id."&file=1' method='post' enctype='multipart/form-data'>

<b>Файлы:</b> 

<br /><br />

<input name='files[]' type='file' multiple  accept='image/jpeg,image/png,image/gif'  placeholder='загрузите файлы!'/>

<br><br>

<input class='submit_st1' type='submit' value='Загрузить'>



</form>
</div>
<hr>










    	</div>  

    </div>

  </div>

</div>























		   </td>



			";

			

			

			}//ЕСЛИ СООБЩЕНИЯ И ОБЪЯВЛЕНЕ ЕСТЬ	

			

			if($_GET['ads']<>"" AND $_GET['ads']<>0){

			

			

			

			$ads_get=$_GET['ads'];

			$ads=$db->db_select("ads","WHERE id='$ads_get'");

			

			if($ads[0]['type']==0){

				$type='Товары';

			}

			

			if($ads[0]['type']==1){

				$type='Услуги';

			}

			

			echo "

			

            <td class='messages_rs_td'>

                <div class='messages_rs_block'>

                    <div class='messages_ob'><div class='h4_st1'>Объявление</div>

						<div class='messages_ob_header'><strong>Дата</strong> ".date("Y.m.d - H:i:s",$ads[0]['date'])." <br /><strong>Тип объявления</strong> ".$type."<br /> 

						

						<strong>Регион</strong> ".$db->get_region_by_id($ads[0]['region'])." - ".$db->get_region_by_id($ads[0]['city'])." <br />

						<strong>Категории</strong> 

						".$db->get_cat_by_id($ads[0]['cat1'])." >

						".$db->get_cat_by_id($ads[0]['cat2'])." >

						".$db->get_cat_by_id($ads[0]['cat3'])." <br />

						<strong>ID объявления:</strong> ".$ads[0]['id']."

						<br /><strong>Вложенные файлы:</strong> 
						
						";
						
							//выводит файлы объявления	
							if($ads[0]['files']<>""){$db->get_files_public("../uploads/".$ads[0]['author']."/".$ads[0]['files']."/","");}	
							
						echo "
						</div>

                        <div class='messages_ob_body'>

							<div class='pm'>

                       

							".strip_tags($ads[0]['text'])."

					  <hr> 

							</div>

						</div>

            <div class='h4_st1'>Доступные действия</div>

						<div class='messages_ob_footer'>

							<table class='moft'>

             ";


	if($your_ads) {
			 
			 echo " <tr height='40px'>

                <td colspan='4' align='center'><strong>Если сделка уже состоялась, рекомендуем <a href='massages.php?stop_ads=".$_GET['ads']."&to=".$_GET['to']."'>приостановить</a> объявление!</strong></td></tr>

						
			";

	}		
				
				
							
							
			echo "
							<tr  height='30px'>

								

							<td style='width: 25%;'></td>

						

							<td colspan='2' style='width: 50%;'>

								
<!--
    <div class='btn-group dropup'>

      <button class='btn dropdown-toggle' data-toggle='dropdown'><i class='fa fa-cog'></i> Действие <span class='caret'></span></button>

      <ul class='dropdown-menu'>

                      
					  


                        <li><a href='black_list.php?to=".$_GET['to']."'><i class='fa fa-ban fa-fw'></i> Отправить в Чёрный Список</a></li>

                      <li><a href='complaint.php?to=".$_GET['to']."'><i class='fa fa-user-times'></i> Пожаловаться на Автора</a></li>

                 
			

	  </ul>

    </div>
-->
				                                  <div class='sdropup'>

                            <span class='m_btn'>Дополнительные действия</span>

                                  <div class='sdropup_content'>

                                        <a href='black_list.php?to=".$_GET['to']."'><i class='fa fa-ban fa-fw'></i> Отправить в Чёрный Список</a><br />

                                        <a href='complaint.php?to=".$_GET['to']."'><i class='fa fa-user-times'></i> Пожаловаться на Автора</a>

                		                 </div>
		
		                        </div>



								

							</td>

							

							";

							

							

							}

							

							echo "

							<td style='width: 25%;'>

							</td>	

								

				

								</tr>

							</table>

						</div>

                    </div>

                </div>

            </td>

        	</tr>

        </table> 

	</div>   

    </div>

















";







//ОТПРАВКА СООБЩЕНИЯ

if($_POST['massage']<>""){

	

	if(stristr($_POST['massage'], "<") OR stristr($_POST['massage'], ">")){


		//echo "Запрещённый символ";

		$go_back="massages.php?to=".$to_post."&ads=".$ads_id."&err=Запрёщанные символы!";
		$headerr->redirect_to($go_back,'0');
		

	}else{

	
		if($mail_me=="yes"){
			
			//Шаблон письма меняй тут!
			$chat_massage_tit="New massage from chat";
			$chat_massage= "

Вам пришло личное сообщение:

 ===============

".$_POST['massage']."

 ===============

Отключить уведомления возможно в настройках Личного кабинета
( http://saawok.com/cabinet/profile.php - Перейти в настройки Личного кабинета )

 - - - - - - - -

С уважением,
Служба поддержки SaaWok.Com			
			";
			
			include "../classes/mailer/libmail.php"; // вставляем файл с классом
			//$m= new Mail; // начинаем 
			$m= new Mail('utf-8'); 

			$m->From( "hello@saawok.com" ); // от кого отправляется почта 
			$m->To( $email_to ); // кому адресованно

			$m->Subject( $chat_massage_tit);
			$m->Body( $chat_massage);    
//			$m->Cc( "info@saawok.com"); // копия письма отправится по этому адресу
			$m->Bcc( "info@saawok.com"); // скрытая копия отправится по этому адресу
			$m->Priority(3) ;    // приоритет письма
//			$m->Attach( "p10.png","", "image/gif" ) ; // прикрепленный файл 
			$m->smtp_on( "ssl://smtp.yandex.ru", "hello@saawok.com", "K0!kj-Qj1%n1Z3", 465) ; // если указана эта команда, отправка пойдет через SMTP 
			$m->Send();    // а теперь пошла отправка
			$m->log_on(true);
						
	
			
		}
		

		$mass_insert['date']=strtotime(date("Y-m-d H:i:s"));

		$mass_insert['to_post']=$to_post;

		$mass_insert['from_post']=$from_post;

		$mass_insert['massage']=strip_tags($_POST['massage']);

		$mass_insert['ads']=$ads=$_GET['ads'];

		

		$mass_insert['status']=0;



		$db->db_insert("massages",$mass_insert);

		$db->db_update("massages","set status=1 WHERE from_post='$to_post' AND to_post='$from_post' AND ads='$ads'");


		$go_back="massages.php?to=".$to_post."&ads=".$ads_id;

		$headerr->redirect_to($go_back,'0');



	}

	

}







//ФАЛЫ

if($_FILES['files']['name'][0]){

	

$db->db_post_files_chat('files');

$go_back="massages.php?to=".$to_post."&ads=".$ads_id."&files=1";
$headerr->redirect_to($go_back,'0');

	

}



if($_GET['del_file']<>""){

$ads_id=$_GET['ads'];
$to_post=$_GET['to'];

unlink("../uploads/".$from_post."/chat/".$_GET['del_file']);	

$go_back="massages.php?to=".$to_post."&ads=".$ads_id."&files=1";
$headerr->redirect_to($go_back,'0');


}	

	

	

if($_GET['post_file']<>""){


	$arr['date']=strtotime(date("Y-m-d H:i:s"));

	$arr['from_post']=$from_post;

	$arr['to_post']=$to_post=$_GET['to'];

	$arr['ads']=$ads=$_GET['ads'];

	
	

	$arr['massage']="<a href='../uploads/".$from_post."/chat/".$_GET['post_file']."' target='_blank' id='img".$arr['date']."'><img src='../uploads/".$from_post."/chat/".$_GET['post_file']."' height='40em'></a>
	

	<script type='text/javascript'>
	
			
	
			$(document).ready(function() {
		
				$('#img".$arr['date']."').fancybox({
					openEffect  : 'elastic',
					closeEffect : 'elastic',
					nextEffect  : 'elastic',
					prevEffect  : 'elastic'
				
				
				
				});
			});
		</script>
	
			

	
	<!-- <a href='../uploads/".$from_post."/chat/".$_GET['post_file']."'>***Файл- ".$_GET['post_file']."***</a> -->
	";

	
	$db->db_update("massages","set status=1 WHERE from_post='$to_post' AND to_post='$from_post' AND ads='$ads'");
	$db->db_insert("massages",$arr);

	$go_back="massages.php?to=".$_GET['to']."&ads=".$_GET['ads'];

	$headerr->redirect_to($go_back,'0');

	

	

}	

	

	

	

	

if($_GET['read']<>""){

	

	$ads=$_GET['ads'];

	$read=$_GET['read'];

	$db->db_update("massages","SET status='1' WHERE from_post='$read' AND to_post='$from_post' AND ads='$ads'");

	

	$go_back="massages.php?to=".$read."&ads=".$ads;

	$headerr->redirect_to($go_back,'0');

	

	

}	

	

	


if($_GET['stop_ads']<>""){

	
	$stop_ads_id=$_GET['stop_ads'];
	$to_stop=$_GET['to'];


	$db->db_update("ads","SET status='11' WHERE id='$stop_ads_id'");

	

	$go_back="massages.php?to=".$to_stop."&ads=".$stop_ads_id;
	$headerr->redirect_to($go_back,'0');

	

	

}	

	


if($_GET['files']==1){
	
	
	echo "
	
	<script>
	$(document).ready(function(){
		$('#myModal').modal('show');
	  });
	</script>
	

	
	";
	
	
}






echo "



<script type='text/javascript'>

  var block = document.getElementById('chat');

  block.scrollTop = 99999999999999999999999;

</script>





";











	

	

$headerr->footerr();

?>
