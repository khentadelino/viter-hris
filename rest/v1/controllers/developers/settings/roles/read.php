<?php

$conn = null;
$conn = checkDbConnection();

$val = new Roles($conn);


if (isset($_SERVER['HTTP_AUTHORIZATION'])) {
    if (empty($_GET)) {
        $query = checkReadAll($val);
        http_response_code(200);
        getQueriedData($query);
    }
}


//Return 404
checkEndpoint();
