<?php
// check database connection 
$conn = null;
$conn = checkDbConnection();
// make use of classes for save database
$val = new Notification($conn);

$val->notification_is_active = 1;
$val->notification_first_name = trim($data['notification_first_name']);
$val->notification_last_name = trim($data['notification_last_name']);
$val->notification_email = trim($data['notification_email']);
$val->notification_purpose = $data['notification_purpose'];
$val->notification_created = date("Y-m-d H:m:s");
$val->notification_updated = date("Y-m-d H:m:s");

// validations
isFullNameExist($val, $val->notification_first_name, $val->notification_last_name, "User already exist.");
isEmailExist($val, $val->notification_email, "Email already used");

$query = checkCreate($val);
http_response_code(200);
returnSuccess($val, "Notification Create", $query);
