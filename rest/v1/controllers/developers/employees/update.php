<?php

require_once '../../../core/header.php';
require_once '../../../core/functions.php';
require_once '../../../models/developers/employees/Employees.php';

//get payload from frontend
$body = file_get_contents("php://input");
$data = json_decode($body, true);

$conn = null;
$conn = checkDbConnection();
$val = new Employees($conn);

if (array_key_exists("id", $_GET)) {
    checkPayload($data);

    $val->employee_aid = $_GET['id'];
    $val->employee_is_active = isset($data['employee_is_active']) ? trim($data['employee_is_active']) : 1;
    $val->employee_first_name = checkIndex($data, 'employee_first_name');
    $val->employee_middle_name = isset($data['employee_middle_name']) ? trim($data['employee_middle_name']) : "";
    $val->employee_last_name = checkIndex($data, 'employee_last_name');
    $val->employee_email = checkIndex($data, 'employee_email');
    $val->employee_updated = date("Y-m-d H:i:s");

    //Validations
    checkId($val->employee_aid);
    isEmailExist($val, $val->employee_email);

    $query = checkUpdate($val);
    http_response_code(200);
    returnSuccess($val, "Employees Update", $query);
}

checkEndpoint();
