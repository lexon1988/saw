<?php

include('../classes/class.php');



$headerr=new Headerr();


$db=new Database();


$headerr->headerrs("Регистрация","","","utf-8");



$headerr->user_bar();

?>









<script type="text/javascript" src="../js/bootstrapValidator.js"></script>

<script src='https://www.google.com/recaptcha/api.js'></script>







<div class='content Scontainer'>

<br /><br />

<div class='reg_c_bor'>

<div class='auth_r'>



<form action='../reg.php'  id="defaultForm" method="post"  novalidate="novalidate">

<div class="form-group has-success">

<label class=" control-label">Ник</label>

<br>

<input type="text" class="form-control" name="username">

</div>



<div class="form-group has-success">

<label class="control-label">Email</label>

<br>

<input type="text" class="form-control" name="email">

</div>





	

	

	

	<div class="form-group has-success">
<!--
	<label><b>Телефон:</b></label><br>

	<input class='form-control' type='text' size='30' name='phone'>

<br>
-->


<?php



include('../tools/region/reg/index.php');



?>

	</div>	

	

	

	

	

	

	

	

	

		

	

	

<div class="form-group has-error">

<label class="control-label">Пароль</label>

<br>

<input type="password" class="form-control" name="password">

</div>



	

	

	

	

<div class="form-group has-error">

<label class="control-label">Подтверждение пароля</label>

<br>

<input type="password" class="form-control" name="confirmPassword">

</div>



	

	



	

	

	


<br>

<div class="g-recaptcha" data-sitekey="6LcqIhAUAAAAAHkHVyZ7CaE7Ln3MozYiU1gXR9t0"></div>

<br>

	<input type="checkbox" id='ruls' checked="checked">  Я согласен с правилами сайта
	<br><br>



<button type="submit" class="btn btn-primary" id='but' disabled="disabled">Зарегистрировать</button>

</form>



		</div>

	</div>

</div>	









<script type="text/javascript">

$(document).ready(function() {

var ruls=1;

    $("#ruls").click(function () {
	
	ruls=ruls+1;
	
	
	if($("#ruls").attr("checked")=="checked" && ruls==2){
	
		$("#but").hide();	
	
		
	}
	
	if(ruls==3){
	
		$("#but").show();	
		ruls=1;
		
	}
	


	
	


	});


    // Generate a simple captcha

    function randomNumber(min, max) {

        return Math.floor(Math.random() * (max - min + 1) + min);

    };



    $('#defaultForm').bootstrapValidator({

        message: 'This value is not valid',

        fields: {

            username: {

                message: 'Не валидное имя',

                validators: {

                    notEmpty: {

                        message: 'Имя не должно быть пустым'

                    },

                    stringLength: {

                        min: 2,

                        max: 20,

                        message: 'Длинна имени может быть от 2 до 20 символов'

                    },

                    regexp: {

                        regexp: /^[а-яА-ЯёЁa-zA-Z0-9]+$/,

                        message: 'Запрещённые символы'

                    },

                    different: {

                        field: 'password',

                        message: 'Имя не должно совпадать с паролем'

                    }

                }

            },

            email: {

                validators: {

                    notEmpty: {

                        message: 'Email не должен быть пустым'

                    },

                    emailAddress: {

                        message: 'Не валидный Email адрес'

                    }

                }

            },

            password: {

                validators: {

                    notEmpty: {

                        message: 'Пароль не должен быть пустым'

                    },

                    identical: {

                        field: 'confirmPassword',

                        message: 'Пароли не совпадают'

                    },

                    different: {

                        field: 'username',

                        message: 'Пароль не должен совпадать с никнеймом'

                    }

                }

            },

            confirmPassword: {

                validators: {

                    notEmpty: {

                        message: 'Подтверждение пароля не должно быть пустым'

                    },

                    identical: {

                        field: 'password',

                        message: 'Пароли не совпадают'

                    },

                    different: {

                        field: 'username',

                        message: 'Пароль не должен совпадать с логином'

                    }

                }

            },

            

        }

    });

});

</script>





<?

$headerr->footerr();

?>
