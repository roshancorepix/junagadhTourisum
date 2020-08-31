<?php

require_once '../../includes/DbOperations.php';


if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $l_id = $_POST['placeId'];
    $l_name = $_POST['placeName'];
    $l_desc = $_POST['placeDesc'];
    $l_rating = $_POST['placeRating'];
    $l_url = $_POST['placeImageUrl'];

    if(isset($l_id) and isset($l_name) and isset($l_desc) and isset($l_rating) and isset($l_url)){
        $db = new DbOperations();

        $result = $db->addPlaces($l_id, $l_name, $l_desc, $l_rating, $l_url);

        if($result == PLACE_ADDED){
            $message = array(); 
            $message['error'] = false; 
            $message['message'] = 'Place added successfully';

            echo json_encode($message);
        }else if($result == PLACE_EXISTS){
            $message = array(); 
            $message['error'] = true; 
            $message['message'] = 'Place already exist';

            echo json_encode($message);
        }else if($result == PLASE_FAILURE){
            $message = array(); 
            $message['error'] = true; 
            $message['message'] = 'Some error occured please try again later';

            echo json_encode($message);
        }
    }
}