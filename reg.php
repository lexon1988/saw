<?php

include('classes/class.php');


$headerr=new Headerr();
$db=new Database();




if($_POST['g-recaptcha-response']<>""){







        if($_POST['username']<>"" AND $_POST['email']<>"" AND $_POST['password']<>""){



                $email=$_POST['email'];



                $arr=$db->db_select("user","WHERE email='$email'");



                if($arr==""){



                        $arr['date']=$date=strtotime(date("Y-m-d H:i:s"));


                        $arr['name']=$_POST['username'];
                        $arr['email']=$_POST['email'];
                        $arr['pass']=$_POST['password'];
                        $arr['phone']=$_POST['phone'];
                        $arr['region']=$_POST['region'];
                        $arr['city']=$_POST['city'];









                        $db->db_insert("user",$arr);



                        $email_check=$_POST['email'];
                        $user_inf=$db->db_select("user","WHERE email='$email_check'");



                        $id=$user_inf[0]['id'];
                        $email=$user_inf[0]['email'];
                        $name=$user_inf[0]['name'];




                        setcookie("auth","welcome");
                        setcookie("email",$email);
                        setcookie("user",$name);
                        setcookie("id",$id);








                        include "classes/mailer/libmail.php"; // вставляем файл с классом
                        //$m= new Mail; // начинаем 
                        $m= new Mail('utf-8'); 

                        $m->From( "hello@saawok.com" ); // от кого отправляется почта 
                        $m->To( $email ); // кому адресованно

                        $m->Subject( "Добро пожаловать на SaaWok" );
                        $m->Body( "Здравствуйте, ".$name."!
Это письмо отправлено с сайта http://saawok.com 
Вы получили это письмо, потому что e-mail ".$email." был использован при регистрации на Портале. 

Если регистрация была проведена не Вами, непременно известите нас.

С уважением,

Администрация сайта saawok.com
                        " );    
                        $m->Bcc( "info@saawok.com"); // скрытая копия отправится по этому адресу
                        $m->Priority(3) ;    // приоритет письма
                        //$m->Attach( "asd.gif","", "image/gif" ) ; // прикрепленный файл 
                        $m->smtp_on( "ssl://smtp.yandex.ru", "hello@saawok.com", "K0!kj-Qj1%n1Z3", 465) ; // если указана эта команда, отправка пойдет через SMTP 
                        $m->Send();    // а теперь пошла отправка
                        $m->log_on(true);









                        $headerr->headerrs("Регистрация","","","utf-8");
                        $headerr->user_bar();
                        $headerr->notification("Вы зарегистрировались на сайте","");
                        $headerr->redirect_to('cabinet/index.php','500');



                }else{


                        ///ДУБЛЬ
                        $headerr->headerrs("Регистрация","","","utf-8");
                        $headerr->user_bar();
                        $headerr->error("ОШИБКА!","Такой email уже зарегистрирован на сайте");
                        $headerr->redirect_to('cabinet/reg.php','1000');

                }



        }





}else{





        echo "Поставте галочку на гугл капче!";

        $headerr->redirect_to('cabinet/reg.php','3000');





}





$headerr->footerr();





?>
