<?php

require '../../../../core/header.php';
require '../../../../core/functions.php';
require '../../../../core/Encryption.php';
require '../../../../models/developers/settings/users/Users.php';


$conn = null;
$conn = checkDbConnection();

$val = new Users($conn);
$encrypt = new Encryption();


$body = file_get_contents("php://input");
$data = json_decode($body, true);
if (isset($_SERVER['HTTP_AUTHORIZATION'])) {
    checkPayload($data);
    $val->users_password = $encrypt->doPasswordHash($data['new_password']);
    $val->users_key = $data['key'];
    $query = checkSetPassword($val);
    http_response_code(200);
    returnSuccess($val, "User set password", $query);
}

http_response_code(200);
checkAccess();
