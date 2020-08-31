<?php

require_once '../../includes/DbOperations.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $l_id = $_POST['placeId'];
    $l_name = $_POST['placeName'];
    $l_desc = $_POST['placeDesc'];
    $l_rating = $_POST['placeRating'];
    $l_url = $_POST['placeImageUrl'];

    if(isset($l_name) and isset($l_desc) and isset($l_rating) and isset($l_url) and isset($l_id)){
        $db = new DbOperations();

        $result = $db->updatePlace($l_name, $l_desc, $l_rating, $l_url, $l_id);

        if($result == PLACE_UPDATED){
            $message = array(); 
            $message['error'] = false; 
            $message['message'] = 'Place updated successfully';
            $location = $db->getPlaceByLocationId($l_id);
            $message['place'] = $location;

            echo json_encode($message);
        }else if($result == PLACE_NOT_FOUND){
            $message = array(); 
            $message['error'] = true; 
            $message['message'] = 'Place not found';

            echo json_encode($message);
        }else if($result == PLACE_NOT_UPDATED){
            $message = array(); 
            $message['error'] = true; 
            $message['message'] = 'Some error occured please try again later';
            $location = $db->getPlaceByLocationId($l_id);
            $message['place'] = $location;
            echo json_encode($message);
        }
    }
}