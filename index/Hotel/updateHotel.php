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

    if(isset($h_name) and isset($h_address) and isset($h_rating) and isset($h_desc) and isset($h_price) and isset($h_image) and isset($h_id)){
        $db = new DbOperations();

        $result = $db->updateHotel($h_name, $h_address, $h_rating, $h_desc, $h_price, $h_image, $h_id);

        if($result == HOTEL_UPDATED){
            $message = array(); 
            $message['error'] = false; 
            $message['message'] = 'Hotel updated successfully';
            $hotel = $db->getHotelByLocationId($h_id);
            $message['hotel'] = $hotel;

            echo json_encode($message);
        }else if($result == HOTEL_NOT_UPDATED){
            $message = array(); 
            $message['error'] = true; 
            $message['message'] = 'Hotel not found';

            echo json_encode($message);
        }else if($result == HOTEL_NOT_FOUND){
            $message = array(); 
            $message['error'] = true; 
            $message['message'] = 'Some error occured please try again later';
            $hotel = $db->getHotelByLocationId($h_id);
            $message['hotel'] = $hotel;
            
            echo json_encode($message);
        }
    }
}