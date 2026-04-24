<?php
// CORS headers - must be first
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Credentials: true");
header('Access-Control-Allow-Headers: Content-Type, Authorization');
header("Access-Control-Allow-Methods: PUT, POST, GET, OPTIONS, DELETE");

// Handle preflight immediately
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    http_response_code(200);
    exit;
}

// check database connection 
$conn = null;
$conn = checkDbConnection();
// make use of classes for save database
$val = new Notification($conn);

if (array_key_exists("id", $_GET)) {
    $val->notification_aid = $_GET["id"];
    $val->notification_first_name = trim($data['notification_first_name']);
    $val->notification_last_name = trim($data['notification_last_name']);
    $val->notification_email = trim($data['notification_email']);
    $val->notification_purpose = $data['notification_purpose'];
    $val->notification_updated = date("Y-m-d H:m:s");

    $notification_first_name_old = trim($data['notification_first_name_old']);
    $notification_last_name_old = trim($data['notification_last_name_old']);
    $notification_email_old = $data['notification_email_old'];

    // validations
    checkId($val->notification_aid);
    compareFullName(
        $val,
        $notification_first_name_old,
        $val->notification_first_name,
        $notification_last_name_old,
        $val->notification_last_name,
        "User already exist."
    );
    compareEmail(
        $val, //models
        $notification_email_old, //old record
        $val->notification_email, //new record
        "Email already used"
    );

    $query = checkUpdate($val);
    http_response_code(200);
    returnSuccess($val, "Notification Update", $query);
}

checkEndpoint();
