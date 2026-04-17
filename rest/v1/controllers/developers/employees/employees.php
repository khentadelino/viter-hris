<?php

require_once '../../../core/header.php';
require_once '../../../core/functions.php';
require_once '../../../models/developers/employees/Employees.php';

//get payload from frontend
$body = file_get_contents("php://input");
$data = json_decode($body, true);

//Create / post
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $result = require 'create.php';
    sendResponse($result);
    exit;
}

//Read / Get
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $result = require 'read.php';
    sendResponse($result);
    exit;
}

//Update / PUT
if ($_SERVER['REQUEST_METHOD'] == 'PUT') {
    $result = require 'update.php';
    sendResponse($result);
    exit;
}

// Delete / DELETE
if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
    $result = require 'delete.php';
    sendResponse($result);
    exit;
}
