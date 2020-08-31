<?php

require_once '../../includes/DbOperations.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $h_id = $_POST['hotel_id'];
    $h_name = $_POST['hotel_name'];
    $h_address = $_POST['hotel_address'];
    $h_rating = $_POST['hotel_ratting'];
    $h_desc = $_POST['hotel_desc'];
    $h_price = $_POST['hotel_price'];
    $h_image = $_POST['hotel_image_url'];

    if(isset($h_id) and isset($h_name) and isset($h_address) and isset($h_rating) and isset($h_desc) and isset($h_price) and isset($h_image)){

        $db = new DbOperations();

        $result = $db->addHotel($h_id, $h_name, $h_address, $h_rating, $h_desc, $h_price, $h_image);

        if($result == HOTEL_ADDED){
            $message = array();
            $message['error'] = false;
            $message['message'] = 'Hotel add successfully';

            echo json_encode($message);
        }else if($result == HOTEL_EXISTS){
            $message = array();
            $message['error'] = true;
            $message['message'] = 'Hotel already exist';

            echo json_encode($message);
        }else if($result == HOTEL_FAILURE){
            $message = array();
            $message['error'] = true;
            $message['message'] = 'Some error occured please try again later';

            echo json_encode($message);
        }
    }
}