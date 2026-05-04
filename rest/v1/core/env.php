<?php

//FOR LOCAL COMPUTER CONFIGURATION
define('WEB_API_KEY',  require __DIR__ . '/../../../apikey.php');

//FOR PRODUCTION/DEPLOYMENT CONFIGURATION
//define('WEB_API_KEY',  require $_SERVER['DOCUMENT_ROOT'] . '/../../../apikey.php' );


// SET UP EMAIL CONFIGURATION
define('FROM', 'HRIS');
define('VERIFY_ACCOUNT', 'Account Verification');
define('RESET_PASSWORD', 'Reset Password');
define('VERIFY_EMAIL', 'Email Verification');
define('USERNAME',  'noreply@groupoptix.com');
define('PASSWORD',  "1s$42*Gs1CvBezsI");
define('HOST', 'smtp.hostinger.com');
define('PORT', '587');
define('SMTPSECURE', 'tls');


define('ROOT_DOMAIN', 'http://localhost/react-vite/viter-hris/');
define('IMAGES_URL', 'http://localhost/react-vite/viter-hris/img');
