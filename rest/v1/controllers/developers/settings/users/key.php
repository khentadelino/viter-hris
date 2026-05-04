<?php

require '../../../../core/header.php';
require '../../../../core/functions.php';
require '../../../../models/developers/settings/users/Users.php';

//DATABASE CONNECTION
$conn = null;
$conn = checkDbConnection();

//MODELS
$val = new Users($conn);

//GET PAYLOAD FROM FRONTEND
$body = file_get_contents("php://input");
$data = json_decode($body, true);

if (isset($_SERVER['HTTP_AUTHORIZATION'])) {
    // VALIDATE DATA
    // checkPayload($data);
    if (array_key_exists('key', $_GET)) {
        $val->users_key = $_GET['key'];
        $query = checkSetPassword($val);
        http_response_code(200);
        getQueriedData($query);
    }
    checkEndpoint();
}
http_response_code(200);
checkAccess();
