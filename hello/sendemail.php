<?php

$name=$_POST['name'];
$email=$_POST['email'];
$message=$_POST['message'];


include "mailer/libmail.php"; // ��������� ���� � �������
//$m= new Mail; // �������� 
$m= new Mail('windows-1251'); 

$m->From( $email ); // �� ���� ������������ ����� 
$m->To( "info@saawok.com" ); // ���� �����������

$m->Subject( "����� �� ����� ".$name." �����" );
$m->Body( $message );    
$m->Bcc( "gadgetlikeyou@gmail.com"); // ������� ����� ���������� �� ����� ������
$m->Priority(3) ;    // ��������� ������
//$m->Attach( "asd.gif","", "image/gif" ) ; // ������������� ���� 
$m->smtp_on( "ssl://smtp.yandex.ru", "hello@saawok.com", "K0!kj-Qj1%n1Z3", 465) ; // ���� ������� ��� �������, �������� ������ ����� SMTP 
$m->Send();    // � ������ ����� ��������
$m->log_on(true);

if($m->Get()<>""){
	
	echo "������ �����������!";

}

?>

