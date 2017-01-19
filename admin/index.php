<?php
include('../classes/class.php');

$headerr=new Headerr();
$db=new Database();

$headerr->headerrs("Админка","","","utf-8");

$headerr->admin_bar();


echo "


<div class='content Scontainer'>
<table class='content_table'>
 <div class='hc4'>Админка</div>
 <br /><br /><br /><br /> <br /><br /> <br />
 <h2>Привет, мой дорогой админ! Я так тебя ждал...</h2>

</div>
</table>
";


?>