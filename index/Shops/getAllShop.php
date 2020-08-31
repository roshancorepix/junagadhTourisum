<?php

require_once '../../includes/DbOperations.php';

if($_SERVER['REQUEST_METHOD'] == 'GET'){

    $db = new DbOperations();

    $shops = $db->getAllShops();

    $response_data = array();
    $response_data['error'] = false;
    $response_data['shops'] = $shops;

    echo json_encode($response_data);
}