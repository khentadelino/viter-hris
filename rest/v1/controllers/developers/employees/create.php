<?php

require_once '../../../core/header.php';
require_once '../../../core/functions.php';
require_once '../../../models/developers/employees/Employees.php';

//get payload from frontend
$body = file_get_contents("php://input");
$data = json_decode($body, true);

checkPayload($data);

$conn = null;
$conn = checkDbConnection();
$val = new Employees($conn);
$val->employee_is_active = 1;
$val->employee_first_name = checkIndex($data, 'employee_first_name');
$val->employee_middle_name = isset($data['employee_middle_name']) ? trim($data['employee_middle_name']) : "";
$val->employee_last_name = checkIndex($data, 'employee_last_name');
$val->employee_email = checkIndex($data, 'employee_email');
$val->employee_created = date("Y-m-d H:i:s");
$val->employee_updated = date("Y-m-d H:i:s");

//VALIDATIONS
isEmailExist($val, $val->employee_email);

$query = checkCreate($val);
http_response_code(200);
returnSuccess($val, "Employees Create", $query);
