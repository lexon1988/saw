<?php


if($_GET['admin']<>"") {
	
	setcookie("admin","");
	
}


setcookie("auth","");
setcookie("user","");
setcookie("id","");


header("Location: index.php");


?>