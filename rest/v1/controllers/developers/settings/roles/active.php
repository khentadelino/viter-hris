<?php

require '../../../../core/header.php';
require '../../../../core/functions.php';
require '../../../../models/developers/settings/roles/Roles.php';

$conn = null;
$conn = checkDbConnection();
$val = new Roles($conn);

//get payload from frontend
$body = file_get_contents("php://input");
$data = json_decode($body, true);

if (array_key_exists('id', $_GET)) {
    checkPayload($data);
    $val->role_aid = $_GET['id'];
    $val->role_is_active = trim($data['isActive']);
    $val->role_updated = date("Y-m-d H:m:s");


    checkId($val->role_aid);
    $query = checkActive($val);
    http_response_code(200);
    returnSuccess($val, "Roles Active", $query);
}

checkEndpoint();
