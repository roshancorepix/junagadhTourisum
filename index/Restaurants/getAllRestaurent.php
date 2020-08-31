<?php

require_once '../../includes/DbOperations.php';

if($_SERVER['REQUEST_METHOD'] == 'GET'){

    $db = new DbOperations();

    $restaurent = $db->getAllRestaurent();

    $response_data = array();
    $response_data['error'] = false;
    $response_data['restaurent'] = $restaurent;

    echo json_encode($response_data);
}