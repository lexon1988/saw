<?php


include "libmail.php"; // ��������� ���� � �������
//$m= new Mail; // �������� 
$m= new Mail('windows-1251'); 

$m->From( "hello@saawok.com" ); // �� ���� ������������ ����� 
$m->To( "gadgetlikeyou@list.ru" ); // ���� �����������

$m->Subject( "���� ���������" );
$m->Body( "����� ������" );    
$m->Cc( "info@saawok.com"); // ����� ������ ���������� �� ����� ������
$m->Bcc( "gadgetlikeyou@gmail.com"); // ������� ����� ���������� �� ����� ������
$m->Priority(3) ;    // ��������� ������
//$m->Attach( "asd.gif","", "image/gif" ) ; // ������������� ���� 
$m->smtp_on( "ssl://smtp.yandex.ru", "hello@saawok.com", "K0!kj-Qj1%n1Z3", 465) ; // ���� ������� ��� �������, �������� ������ ����� SMTP 
$m->Send();    // � ������ ����� ��������
$m->log_on(true);

echo "���������� �������� ����� ������:<br><pre>", $m->Get(), "</pre>";

?>
