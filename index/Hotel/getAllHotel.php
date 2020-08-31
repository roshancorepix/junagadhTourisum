<?php

require_once '../../includes/DbOperations.php';

if($_SERVER['REQUEST_METHOD'] == 'GET'){

    $db = new DbOperations();

    $hotel = $db->getAllHotels();

    $response_data = array();
    $response_data['error'] = false;
    $response_data['hotel'] = $hotel;

    echo json_encode($response_data);
}