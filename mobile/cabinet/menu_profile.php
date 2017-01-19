<?php

$massages_count= count($db->db_select("massages","WHERE to_post='$user_id' AND status='0'"));

?>


        <a href="profile.php" rel="external" class=" ui-btn">Профиль</a>
		<a href="ads_my.php" rel="external" class="ui-btn">Объявления</a>
		<a href="ads_add.php" rel="external" class=" ui-btn">Подать объявление</a>
		<a href="massages.php" rel="external" class="ui-btn">Сообщения [<?php echo $massages_count; ?>]</a>
 
