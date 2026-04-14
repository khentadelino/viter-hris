<?php

$conn = null;
$conn = checkDbConnection($conn);

$role_name = $data['role_name'];

returnError($role_name);
