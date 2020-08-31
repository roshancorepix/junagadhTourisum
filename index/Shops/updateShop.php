<?php

require_once '../../includes/DbOperations.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $shop_id = $_POST['shop_id'];
    $shop_name = $_POST['shop_name'];
    $shop_address = $_POST['shop_address'];
    $shop_phone = $_POST['shop_phone'];
    $shop_rating = $_POST['shop_rating'];
    $shop_type = $_POST['shop_type'];
    $shop_open = $_POST['shop_open'];
    $shop_close = $_POST['shop_close'];
    $shop_image_url = $_POST['shop_image_url'];


    if(isset($shop_id) and isset($shop_name) and isset($shop_address) and isset($shop_phone) and isset($shop_rating) and isset($shop_type) and isset($shop_open) and isset($shop_close) and isset($shop_image_url)){
        $db = new DbOperations();

        $result = $db->updateShop($shop_id, $shop_name, $shop_address, $shop_phone, $shop_rating, $shop_type, $shop_open, $shop_close, $shop_image_url);

        if($result == SHOP_UPDATED){
            $message = array(); 
            $message['error'] = false; 
            $message['message'] = 'Shop updated successfully';
            $shop = $db->getShopByLocationId($shop_id);
            $message['shop'] = $shop;

            echo json_encode($message);
        }else if($result == SHOP_NOT_FOUND){
            $message = array(); 
            $message['error'] = true; 
            $message['message'] = 'Shop not found';

            echo json_encode($message);
        }else if($result == SHOP_NOT_UPDATED){
            $message = array(); 
            $message['error'] = true; 
            $message['message'] = 'Some error occured please try again later';
            $shop = $db->getShopByLocationId($shop_id);
            $message['shop'] = $shop;
            echo json_encode($message);
        }
    }
}