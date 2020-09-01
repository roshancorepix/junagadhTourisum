<?php

require_once '../../includes/DbOperations.php';

if($_SERVER['REQUEST_METHOD'] == 'GET'){

    $db = new DbOperations();

    $school = $db->getAllSchool();

    $response_data = array();
    $response_data['error'] = false;
    $response_data['school'] = $school;

    echo json_encode($response_data);
}