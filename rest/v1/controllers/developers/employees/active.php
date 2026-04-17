<?php

require_once '../../../core/header.php';
require_once '../../../core/functions.php';
require_once '../../../models/developers/employees/Employees.php';

$conn = null;
$conn = checkDbConnection();
$val = new Employees($conn);

//get payload from frontend
$body = file_get_contents("php://input");
$data = json_decode($body, true);

if (array_key_exists('id', $_GET)) {
    checkPayload($data);
    $val->employee_aid = $_GET['id'];
    $val->employee_is_active = trim($data['isActive']);
    $val->employee_updated = date("Y-m-d H:i:s");

    checkId($val->employee_aid);
    $query = checkActive($val);
    http_response_code(200);
    returnSuccess($val, "Employees Active", $query);
}

checkEndpoint();
