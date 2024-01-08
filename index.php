<?php

session_start();

require_once "autoloader.php";

//load recaptcha autoloader
// require_once 'recaptcha/autoload.php';

//Load Composer's autoloader
require '../PHPMailer/PHPMailerAutoload.php';

//Load mail
require '../mail/Mailer.php';


Router::route();