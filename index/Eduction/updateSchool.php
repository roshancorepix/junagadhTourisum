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

        $result = $db->updateSchool($school_id, $school_name, $school_address, $school_phone, $school_rating, $school_web, $school_image_url);

        if($result == SCHOOL_UPDATED){
            $message = array(); 
            $message['error'] = false; 
            $message['message'] = 'School updated successfully';
            $school = $db->getSchoolByLocationId($school_id);
            $message['school'] = $school;

            echo json_encode($message);
        }else if($result == SCHOOL_NOT_UPDATED){
            $message = array(); 
            $message['error'] = true; 
            $message['message'] = 'School not found';

            echo json_encode($message);
        }else if($result == SCHOOL_NOT_FOUND){
            $message = array(); 
            $message['error'] = true; 
            $message['message'] = 'Some error occured please try again later';
            $school = $db->getSchoolByLocationId($school_id);
            $message['school'] = $school;
            
            echo json_encode($message);
        }
    }
}