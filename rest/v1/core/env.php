<?php

// for local computer configuration
define('WEB_API_KEY_PATH', require __DIR__ . "/../../../apikey.php");
// for production/deployment configuration
// define('WEB_API_KEY_PATH', require $_SERVER['DOCUMENT_ROOT'] . "/../../apikey.php");

//for set email
define('FROM', 'HRIS');
define('VERIFY_ACCOUNT', 'ACCOUNT VERIFICATION');
define('RESET_PASSWORD', 'Reset Password');
define('VERIFY_EMAIL', 'Email Verification');
//email account
// define('USERNAME', 'noreply@groupoptix.com');
// define('PASSWORD', '1s$42*Gs1CvBezsI');
// define('HOST', 'smtp.hostinger.com');
// define('PORT', '587');
// define('SMTPSECURE', 'tls');

//ROOT DOMAIN
//LOCAL COMPUTER
define('ROOT_DOMAIN', 'http://localhost:5173');
define('IMAGES_URL', 'http://localhost:5173/img');
// //production
// define('ROOT_DOMAIN', 'www.example.com');
// define('IMAGES_URL', 'www.example.com/img');

// // GROUP OPTIX HOSTINGER EMAIL
define("USERNAME", "noreply@groupoptix.com");
define("PASSWORD", "1s$42*Gs1CvbEzsI");
// // GROUP OPTIX HOSTINGER
define("HOST", "smtp.hostinger.com");
define("PORT", 587);
define("SMTPSECURE", "tls");
