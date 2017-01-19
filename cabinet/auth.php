<?php
include('../classes/class.php');

$headerr=new Headerr();
$db=new Database();

$headerr->headerrs("Авторизация","","","utf-8");
$headerr->user_bar();

?>

<div class='content Scontainer'>
<br /><br />
<div class='all_c_bor'>
<div class='auth_d'>
<form action='../login.php' method='post'>
<h1>Авторизация</h1>
<hr>

	<label><b>E-mail:</b></label><br>
	<input class='input_st1' type='text' size='30' name='email' value='<?php echo $_GET['email']; ?>'>
	<br>
	<label><b>Пароль:</b></label><br>
	<input class='input_st1' type='password' size='30' name='pass' value='<?php echo $_GET['pass']; ?>'>
	<br><br>
	<input class='submit_st1' type='submit' value='Отправить'>

</form>
</div>
</div>
</div>
<?php

$headerr->footerr();


?>