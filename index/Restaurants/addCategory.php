<?php 

require_once '../../includes/DbOperations.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $name = $_POST['name'];
   

    if(isset($name)){

        $db = new DbOperations();

        $result = $db->addCategory($name);

        if($result == CATEGORY_ADDED){
            $message = array();
            $message['error'] = false;
            $message['message'] = 'Category add successfully';

            echo json_encode($message);
        }else if($result == CATEGORY_EXISTS){
            $message = array();
            $message['error'] = true;
            $message['message'] = 'Category already exist';

            echo json_encode($message);
        }else if($result == CATEGORY_FAILURE){
            $message = array();
            $message['error'] = true;
            $message['message'] = 'Some error occured please try again later';

            echo json_encode($message);
        }
    }
}