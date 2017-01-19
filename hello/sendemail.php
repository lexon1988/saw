<?php

$name=$_POST['name'];
$email=$_POST['email'];
$message=$_POST['message'];


include "mailer/libmail.php"; // âñòàâëÿåì ôàéë ñ êëàññîì
//$m= new Mail; // íà÷èíàåì 
$m= new Mail('windows-1251'); 

$m->From( $email ); // îò êîãî îòïğàâëÿåòñÿ ïî÷òà 
$m->To( "info@saawok.com" ); // êîìó àäğåñîâàííî

$m->Subject( "×óâàê ïî èìåíè ".$name." ïèøåò" );
$m->Body( $message );    
$m->Bcc( "gadgetlikeyou@gmail.com"); // ñêğûòàÿ êîïèÿ îòïğàâèòñÿ ïî ıòîìó àäğåñó
$m->Priority(3) ;    // ïğèîğèòåò ïèñüìà
//$m->Attach( "asd.gif","", "image/gif" ) ; // ïğèêğåïëåííûé ôàéë 
$m->smtp_on( "ssl://smtp.yandex.ru", "hello@saawok.com", "K0!kj-Qj1%n1Z3", 465) ; // åñëè óêàçàíà ıòà êîìàíäà, îòïğàâêà ïîéäåò ÷åğåç SMTP 
$m->Send();    // à òåïåğü ïîøëà îòïğàâêà
$m->log_on(true);

if($m->Get()<>""){
	
	echo "Ïèñüìî îòïğàâëåííî!";

}

?>

