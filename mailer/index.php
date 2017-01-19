<?php


include "libmail.php"; // вставляем файл с классом
//$m= new Mail; // начинаем 
$m= new Mail('windows-1251'); 

$m->From( "hello@saawok.com" ); // от кого отправляется почта 
$m->To( "gadgetlikeyou@list.ru" ); // кому адресованно

$m->Subject( "Тема сообщения" );
$m->Body( "Текст письма" );    
$m->Cc( "info@saawok.com"); // копия письма отправится по этому адресу
$m->Bcc( "gadgetlikeyou@gmail.com"); // скрытая копия отправится по этому адресу
$m->Priority(3) ;    // приоритет письма
//$m->Attach( "asd.gif","", "image/gif" ) ; // прикрепленный файл 
$m->smtp_on( "ssl://smtp.yandex.ru", "hello@saawok.com", "K0!kj-Qj1%n1Z3", 465) ; // если указана эта команда, отправка пойдет через SMTP 
$m->Send();    // а теперь пошла отправка
$m->log_on(true);

echo "Показывает исходный текст письма:<br><pre>", $m->Get(), "</pre>";

?>
