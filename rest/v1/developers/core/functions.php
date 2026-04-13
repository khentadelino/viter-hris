<?php

require 'Database.php';
require 'Response.php';

function sendResponse($result)
{
    $response = new Response();
    $response->setSuccess(true);
    $response->setStatusCode(200);
    $response->setData($result);
    $response->send();
}

function checkDbConnection()
{
    try {
        $conn = Database::connectDb();
        return $conn;
    } catch (PDOException $error) {
        $response = new Response();
        $response->setSuccess(false);
        $error = [];
        $error['type'] = "invalid_request_error";
        $error['success'] = false;
        $error['error'] = "Database connection false";
        $response->setData($error);
        $response->send();
        exit;
    }
}
