<?php


class Tools{
	
public function select_tools ($url){


$count=$_GET['count'] + 1;




$db=new Database();
$headerr=new Headerr();



$cat= $_POST['cat'];
$ids= $db->db_select("cats","WHERE cat='$cat'");
$parent_id= $ids[0]['id'];



if($parent_id==""){

	$cats= $db->db_select("cats","WHERE parent_id='0'");

}else{
	
	$cats= $db->db_select("cats","WHERE parent_id='$parent_id'");
	
}




echo "
<script src='http://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js'></script>
<script>
	function funcBefore".$count."(){
		$('#information".$count."').text('');
	}

	function funcSuccess".$count."(data){
		$('#information".$count."').html(data);	
	}


	$(document).ready(function(){
		
		$('#load".$count."').bind('change', function(){
		

				$.ajax({
					url: '../".$url."&count=".$count."',
					type: 'POST',
					data: ({cat: $('#load".$count."').val()}),
					dataType: 'html',
					beforeSend: funcBefore".$count.",
					success: funcSuccess".$count."
				});
			});	
		});

	

</script>

";





$cats_count=count($cats);

if($cats_count<>0){

echo "

<select id='load".$count."'>
";
echo "<option></option>";
for($i=0; $i<$cats_count; $i++)
{	

	
	echo "<option>".$cats[$i]['cat']."</option>";
	

}

echo "
</select>

<br>
<div id='information".$count."'></div>
";

		}else{
			
		
			
		}

	}

}
?>