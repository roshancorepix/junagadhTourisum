<?php

require_once '../../includes/DbOperations.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $r_id = $_POST['r_id'];
    $r_name = $_POST['r_name'];
    $r_address = $_POST['r_address'];
    $r_phone = $_POST['r_phone'];
    $r_category = $_POST['r_category'];
    $r_web = $_POST['r_web'];
    $r_rating = $_POST['r_rating'];
    $r_open = $_POST['r_open'];
    $r_close = $_POST['r_close'];
    $r_image = $_POST['r_image'];


    if(isset($r_id) and isset($r_name) and isset($r_address) and isset($r_phone) and isset($r_category) and isset($r_web) and isset($r_rating) and isset($r_open) and isset($r_close) and isset($r_image)){
        $db = new DbOperations();

        $result = $db->updateRestaurent($r_id, $r_name, $r_address, $r_phone, $r_category, $r_web, $r_rating, $r_open, $r_close, $r_image);

        if($result == RESTAURENT_UPDATED){
            $message = array(); 
            $message['error'] = false; 
            $message['message'] = 'Restaurent updated successfully';
            $restaurent = $db->getRestaurentByLocationId($r_id);
            $message['restaurent'] = $restaurent;

            echo json_encode($message);
        }else if($result == RESTAURENT_NOT_FOUND){
            $message = array(); 
            $message['error'] = true; 
            $message['message'] = 'Restaurent not found';

            echo json_encode($message);
        }else if($result == RESTAURENT_NOT_UPDATED){
            $message = array(); 
            $message['error'] = true; 
            $message['message'] = 'Some error occured please try again later';
            $restaurent = $db->getRestaurentByLocationId($r_id);
            $message['restaurent'] = $restaurent;
            echo json_encode($message);
        }
    }
}