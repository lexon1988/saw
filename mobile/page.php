<?php
include('../classes/class.php');
$db=new Database();

$user_id= $_COOKIE['id'];

$page=$_POST['page'];
$step=12;
$offset=$page*$step;






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




$ads= $db->db_select("ads","WHERE status=2 ".$sqls." ".$back_ads_sql." order by id desc LIMIT 12 OFFSET ".$offset."");	
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



$time=date("H:i");

//===================================================
	

	

	if($ads[$i]['type']==0){

		

		$type='Т';	

	

	}else{

		

		$type='У';	

	}

	
	
	
	if($_COOKIE['id']==$ads[$i]['author']){
			$author= "<font color='red'>Это ваше объявление!</font>";
		}else{
			$author=$db->get_user_by_id($ads[$i]['author']);
		}
	

	
	
	
?>	



<!-- %%%%%%%%%%%%%%%%%%%%%%%  ОБЪЯВЛЕНИЕ %%%%%%%%%%%%%%%%%%%%%%%%%%%% -->    
<table> 
    <tr>
        <td style='background-color:#1b1b1b; border-radius:20px 0px 0px 20px;'>
<div style=' padding:15px; border-radius:10  px 0px 0px 10px;' >
            
<a href="#" id='<?php echo "fav".$ads[$i]['id']; ?>' class="ui-btn ui-btn-b ui-shadow ui-corner-all ui-icon-star ui-btn-icon-notext ">fav</a>  
<a href="#" id='<?php echo "hide_ob".$ads[$i]['id']; ?>' class="ui-btn ui-btn-b ui-shadow ui-corner-all ui-icon-forbidden ui-btn-icon-notext">del</a>
   
<a href="<?php echo "cabinet/massages.php?to=".$ads[$i]['author']."&ads=".$ads[$i]['id']; ?>" class="ui-btn ui-btn-b ui-shadow ui-corner-all ui-icon-mail ui-btn-icon-notext">mas</a>

</div>
    </td>
        <td style='width:100%; '>
         <div class='ob'>
           <b><?php echo $author; ?></b>
            <br>
            <small><?php echo $date." в ".$time ?></small>
            <hr>
            
			<div class="content"><?php echo $ads[$i]['text']; ?></div>
           
		   <br>
			<?php
			
			
			if($ads[$i]['files']<>""){$db->get_files_public_mob("../../uploads/".$ads[$i]['author']."/".$ads[$i]['files']."/","");}	
			
			
			
			?>
            
        </div>
        </td>
    
    </tr>
</table> 
    




	





<script>

$(document).ready(function() {


$(".modal_window").hide();

$("img").bind("click", function() {
     var a= $(this).attr("src");
     $(".modal_window").show();
     $("#modal_img").attr("src",a);

});

 $("#close_modal_img").bind("click", function() {
     
     $(".modal_window").hide();
     
});




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



  $(".content").shorten({
      "showChars" : 150,              // - длина текста в символах.
      "moreText"  : "Подробнее",      // - текст "читать далее".
      "ellipsesText" : "...",         // - вместо многоточия можно вписать к примеру и "[...]".
      "lessText"  : "Скрыть текст",   // - текст возврата в исходное состояние.
  });

	

});

	

</script>	

	

	

<?php	





	}


}


if($ads_count<12){
	
	echo "
	<script>
	
		$('#show_more').html('Объявления кончились!');
	
	</script>
	";
	
}



?>