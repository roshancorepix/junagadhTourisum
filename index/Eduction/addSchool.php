<?php

require_once '../../includes/DbOperations.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $school_id = $_POST['school_id'];
    $school_name = $_POST['school_name'];
    $school_address = $_POST['school_address'];
    $school_phone = $_POST['school_phone'];
    $school_rating = $_POST['school_rating'];
    $school_web = $_POST['school_web'];
    $school_image_url = $_POST['school_image_url'];

    if(isset($school_id) and isset($school_name) and isset($school_address) and isset($school_phone) and isset($school_rating) and isset($school_web) and isset($school_image_url)){

        $db = new DbOperations();

        $result = $db->addSchool($school_id, $school_name, $school_address, $school_phone, $school_rating, $school_web, $school_image_url);

        if($result == SCHOOL_ADDED){
            $message = array();
            $message['error'] = false;
            $message['message'] = 'School add successfully';

            echo json_encode($message);
        }else if($result == SCHOOL_EXISTS){
            $message = array();
            $message['error'] = true;
            $message['message'] = 'School already exist';

            echo json_encode($message);
        }else if($result == SCHOOL_FAILURE){
            $message = array();
            $message['error'] = true;
            $message['message'] = 'Some error occured please try again later';

            echo json_encode($message);
        }
    }
}