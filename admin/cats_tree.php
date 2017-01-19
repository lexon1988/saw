<?php





//includes-----------------

include('../classes/class.php');

//-------------------------

$headerr=new Headerr();

$db=new Database();



$headerr->headerrs("Уровни","","","utf-8");

$headerr->admin_bar();





$cat= $_GET['cat'];



if($_GET['type']<>""){

$type=$_GET['type'];

}else{

$type=$_GET['post'];	

	

}	



if($_GET['type']=="") $type=$_POST['type'];

if($type==0 OR $type==1){$table='cats';}

if($type==2){$table='regions';}



$lev0= $db->db_select($table,"WHERE cat='$cat' and type='$type'");









echo "



<div style='padding:0;' class='content container'>



<div style='width:100%; margin:0 auto;'>

<div class='cats_level0'>



".$lev0[0]['cat']."



<form action='cats_tree.php?cat=".$cat."&type=".$type."' method='post'>

<input type='hidden' name='parent_id' value=".$lev0[0]['id'].">

<input type='text' size=25 name='cat'>

<input type='submit' value='go'>

</form>



</div>

";



$parent_id1=$lev0[0]['id'];



//============================\\





//####################################################################

$lev1= $db->db_select($table,"WHERE parent_id='$parent_id1' and type='$type'");

$lev1_count=count($lev1);

for($i1=0;$i1<$lev1_count;$i1++){



echo "<div class='cats_level1'>";

echo $lev1[$i1]['cat']."<a href='cats_tree.php?cat=".$cat."&del=".$lev1[$i1]['id']."&type=".$type."' style='text-decoration: none;'>[x]</a>********<a href='cats_edit.php?cat=".$cat."&id=".$lev1[$i1]['id']."&type=".$type."' style='text-decoration: none;'>Редактировать</a><br>";

echo "<form action='cats_tree.php?cat=".$cat."&type=".$type."' method='post'>

<input type='hidden' name='parent_id' value=".$lev1[$i1]['id'].">

<input type='text' size=25 name='cat'>

<input type='submit' value='go'>

</form>

";

echo "</div>";

$parent_id2=$lev1[$i1]['id'];

//####################################################################







	//####################################################################

	$lev2= $db->db_select($table,"WHERE parent_id='$parent_id2' and type='$type'");

	$lev2_count=count($lev2);

	for($i2=0;$i2<$lev2_count;$i2++){



	echo "<div class='cats_level2'>";

	echo $lev2[$i2]['cat']."<a href='cats_tree.php?cat=".$cat."&del=".$lev2[$i2]['id']."&type=".$type."' style='text-decoration: none;'>[x]</a>********<a href='cats_edit.php?cat=".$cat."&id=".$lev2[$i2]['id']."&type=".$type."' style='text-decoration: none;'>Редактировать</a><br>";

	echo "<form action='cats_tree.php?cat=".$cat."&type=".$type."' method='post'>

	<input type='hidden' name='parent_id' value=".$lev2[$i2]['id'].">

	<input type='text' size=25 name='cat'>

	<input type='submit' value='go'>

	</form>

	";

	echo "</div>";

	$parent_id3=$lev2[$i2]['id'];

	//####################################################################



	

		//####################################################################

		$lev3= $db->db_select($table,"WHERE parent_id='$parent_id3' and type='$type'");

		$lev3_count=count($lev3);

		for($i3=0;$i3<$lev3_count;$i3++){



		echo "<div class='cats_level3'>";

		echo $lev3[$i3]['cat']."<a href='cats_tree.php?cat=".$cat."&del=".$lev3[$i3]['id']."&type=".$type."' style='text-decoration: none;'>[x]</a><br>";

		echo "

		

		<!--

		<form action='cats_tree.php?cat=".$cat."&type=".$type."' method='post'>

		<input type='hidden' name='parent_id' value=".$lev3[$i3]['id'].">

		<input type='text' size=25 name='cat'>

		<input type='submit' value='go'>

		</form>

		

		-->

		";

		echo "</div>";

		$parent_id4=$lev3[$i3]['id'];

		//####################################################################





				//####################################################################

				$lev4= $db->db_select($table,"WHERE parent_id='$parent_id4'  and type='$type'");

				$lev4_count=count($lev4);

				for($i4=0;$i4<$lev4_count;$i4++){



				echo "<div class='cats_level4'>";

				echo $lev4[$i4]['cat']."<a href='cats_tree.php?cat=".$cat."&del=".$lev4[$i4]['id']."&type=".$type."' style='text-decoration: none;'>[x]</a><br>";

				

				

				echo "<form action='cats_tree.php?cat=".$cat."&type=".$type."' method='post'>

				<input type='hidden' name='parent_id' value=".$lev4[$i4]['id'].">

				<input type='text' size=25 name='cat'>

				<input type='submit' value='go'>

				</form>

				";

				

				

				echo "</div>";

				$parent_id5=$lev4[$i4]['id'];

				//####################################################################







		//3

		}

	

	



	//2

	}













//1

}







}

















if($_GET['fuck']<>"off"){





if($_POST['parent_id']<>"" AND $_POST['cat']<>""){





	$arr['parent_id']=$_POST['parent_id'];

	$arr['cat']=$_POST['cat'];

	$arr['type']=$type;

	$db->db_insert($table,$arr);



	echo "

	

	<script language='JavaScript'> 

			window.location.href = 'cats_tree.php?cat=".$cat."&type=".$type."&fuck=off'

	</script>

";

	

	}



}





if($_GET['del']<>""){



	$del=$_GET['del'];

	$db->db_delete($table,"WHERE id='$del'");

	

	

	echo "

	

	<script language='JavaScript'> 

			window.location.href = 'cats_tree.php?cat=".$cat."&type=".$type."&fuck=off'

	</script>

";



	

}

	

	











echo "</div></div>";





?>
