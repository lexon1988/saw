<?php include( '../../classes/class.php'); $headerr=new Headerr(); $db=new Database(); ?>




<meta charset='utf-8'>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel='stylesheet' href='../../css/bootstrap.min.css' type='text/css' media='all'>
<link rel="stylesheet" href="../css/style.css" />
<link rel="stylesheet" href="../css/jquery.mobile-1.4.5.min.css" />
<link rel="stylesheet" href="../css/jqm-demos.css" />



<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js'></script>
<script async src='../../js/bootstrap.min.js'></script>
<script type="text/javascript" src="../../js/bootstrapValidator.js"></script>
<script src='https://www.google.com/recaptcha/api.js'></script>
<script src="../js/jquery.mobile-1.4.5.js"></script>
<script src="../js/jquery.shorten.1.0.js"></script>



<div data-role="page" style="min-height: 613px;">
    <div role="main" class="ui-content grid">




        <form action='../../reg_mob.php' id="defaultForm" method="post" novalidate="novalidate">

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




                <?php include( '../tools/region/reg/index.php'); ?>

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


            <button type="submit" class="btn btn-primary" disabled="disabled">Зарегистрировать</button>

        </form>



    </div>





    <script type="text/javascript">
        $(document).ready(function() {




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





    <? $headerr->footerr(); ?>