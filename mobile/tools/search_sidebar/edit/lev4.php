<?php

include('../../../../classes/class.php');
$db=new Database();


$id=$_POST['id'];


$ads= $db->db_select("ads","WHERE id='$id'");

$user_id=$_COOKIE['id'];
$files= $ads[0]['files'];




?>


<br>

<p>Введите текст объявления:</p>
<textarea name='text' cols='50' rows='5' class='settings_select' required><?php echo $ads[0]['text']; ?></textarea>
<input type='hidden' name='old_files' value='<?php echo $ads[0]['files']; ?>'>

<br>


<?php 

if($files<>""){

	$db->get_files("../../../../uploads/".$user_id."/".$files."/",$id); 

}

?>


<br> 
 
<input name='files[]' type='file' multiple   placeholder="загрузите файлы!"/>

<hr>

<input class='ui-btn ui-btn-b'  type='submit' style='width:100%;' value='Отправить'>



</form>
