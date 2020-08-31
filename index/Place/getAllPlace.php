<?php

require_once '../../includes/DbOperations.php';

if($_SERVER['REQUEST_METHOD'] == 'GET'){

    $db = new DbOperations();

    $place = $db->getAllPlace();

    $response_data = array();
    $response_data['error'] = false;
    $response_data['place'] = $place;

    echo json_encode($response_data);
}