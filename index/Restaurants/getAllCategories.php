<?php

require_once '../../includes/DbOperations.php';

if($_SERVER['REQUEST_METHOD'] == 'GET'){

    $db = new DbOperations();

    $Category = $db->getCategories();

    $response_data = array();
    $response_data['error'] = false;
    $response_data['categories'] = $Category;

    echo json_encode($response_data);
}