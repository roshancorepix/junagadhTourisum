<?php 

	class DbOperations{

		private $con;

		function __construct(){
			require_once dirname(__FILE__) . '/DbConnect.php';
		

			$db = new DbConnect;

			$this->con = $db->connect();

		}

// Place Database Information

		public function addPlaces($l_id, $l_name, $l_desc, $l_rating, $image_url){
           if(!$this->isPlaceExist($l_id)){
                $stmt = $this->con->prepare("INSERT INTO place_info (placeId, placeName, placeDesc, placeRating, placeImageUrl) VALUES (?, ?, ?, ?, ?)");
                $stmt->bind_param("sssds", $l_id, $l_name, $l_desc, $l_rating, $image_url);
                if($stmt->execute()){
                    return PLACE_ADDED; 
                }else{
                    return PLASE_FAILURE;
                }
           }
           return PLACE_EXISTS; 
        }

        public function updatePlace($l_name, $l_desc, $l_rating, $image_url, $l_id){
            if($this->isPlaceExist($l_id)){
                $stmt = $this->con->prepare("UPDATE place_info SET placeName = ?, placeDesc = ?, placeRating = ?, placeImageUrl = ? WHERE placeId = ?");
                $stmt->bind_param("ssdss", $l_name, $l_desc, $l_rating, $image_url, $l_id);
                if($stmt->execute()){
                    return PLACE_UPDATED;
                }else{
                    return PLACE_NOT_UPDATED;
                } 
            }
            return PLACE_NOT_FOUND;
        }

        public function getPlaceByLocationId($l_id){
            if($this->isPlaceExist($l_id)){
                $stmt = $this->con->prepare("SELECT placeId, placeName, placeDesc, placeRating, placeImageUrl FROM place_info WHERE placeId = ?");
                $stmt->bind_param("s", $l_id); 
                $stmt->execute();
                $stmt->bind_result($l_id, $l_name, $l_desc, $l_rating, $image_url);
        	    $stmt->fetch();
        	    $place = array();
        	    $place['placeId'] = $l_id;
        	    $place['placeName'] = $l_name;
                $place['placeDesc'] = $l_desc;
                $place['placeRating'] = $l_rating;
                $place['placeImageUrl'] = $image_url;
        	    return $place;
            }
        }

        public function getAllPlace(){
        	$stmt = $this->con->prepare("SELECT placeId, placeName, placeDesc, placeRating, placeImageUrl FROM place_info");
        	$stmt->execute();
        	$stmt->bind_result($l_id, $l_name, $l_desc, $l_rating, $image_url);
        	$places = array();
        	while($stmt->fetch()){
        		$place = array();
        		$place['placeId'] = $l_id;
        		$place['placeName'] = $l_name;
                $place['placeDesc'] = $l_desc;
                $place['placeRating'] = $l_rating;
                $place['placeImageUrl'] = $image_url;
        		array_push($places, $place);
       	 	}
       	 	return $places;
        }

        private function isPlaceExist($l_id){
            $stmt = $this->con->prepare("SELECT placeId FROM place_info WHERE placeId = ?");
            $stmt->bind_param("s", $l_id);
            $stmt->execute(); 
            $stmt->store_result(); 
            return $stmt->num_rows > 0;  
        }


// Hotel Database information
        public function addHotel($h_id, $h_name, $h_address, $h_ratting, $h_desc, $h_price, $h_image_url){
            if(!$this->isHotelExist($h_id)){
                $stmt = $this->con->prepare("INSERT INTO hotel_info (hotel_id, hotel_name, hotel_address, hotel_ratting, hotel_desc, hotel_price, hotel_image_url) VALUES (?, ?, ?, ?, ?, ?, ?)");
                $stmt->bind_param("sssdsis", $h_id, $h_name, $h_address, $h_ratting, $h_desc, $h_price, $h_image_url);
                if($stmt->execute()){
                    return HOTEL_ADDED;
                }else{
                    return HOTEL_EXISTS;
                }
            }
            return HOTEL_FAILURE;
        }

        public function updateHotel($h_name, $h_address, $h_ratting, $h_desc, $h_price, $h_image_url, $h_id){
            if($this->isHotelExist($h_id)){
                $stmt = $this->con->prepare("UPDATE hotel_info SET hotel_name = ?, hotel_address = ?, hotel_ratting = ?, hotel_desc = ?, hotel_price = ?, hotel_image_url = ? WHERE hotel_id = ?");
                $stmt->bind_param("ssdsiss", $h_name, $h_address, $h_ratting, $h_desc, $h_price, $h_image_url, $h_id);
                if($stmt->execute()){
                    return HOTEL_UPDATED;
                }else{
                    return HOTEL_NOT_UPDATED;
                }
            }

            return HOTEL_NOT_FOUND;
        }

        public function getAllHotels(){
        	$stmt = $this->con->prepare("SELECT hotel_id, hotel_name, hotel_address, hotel_ratting, hotel_desc, hotel_price, hotel_image_url FROM hotel_info");
        	$stmt->execute();
        	$stmt->bind_result($h_id, $h_name, $h_address, $h_ratting, $h_desc, $h_price, $h_image_url);
        	$hotels = array();
        	while($stmt->fetch()){
        		$hotel = array();
        		$hotel['hotel_id'] = $h_id;
        		$hotel['hotel_name'] = $h_name;
                $hotel['hotel_address'] = $h_address;
                $hotel['hotel_ratting'] = $h_ratting;
                $hotel['hotel_desc'] = $h_desc;
                $hotel['hotel_price'] = $h_price;
                $hotel['hotel_image_url'] = $h_image_url;
        		array_push($hotels, $hotel);
       	 	}
       	 	return $hotels;
        }
        public function getHotelByLocationId($h_id){
            if($this->isHotelExist($h_id)){
                $stmt = $this->con->prepare("SELECT hotel_id, hotel_name, hotel_address, hotel_ratting, hotel_desc, hotel_price, hotel_image_url FROM hotel_info WHERE hotel_id = ?");
                $stmt->bind_param("s", $h_id); 
                $stmt->execute();
                $stmt->bind_result($h_id, $h_name, $h_address, $h_ratting, $h_desc, $h_price, $h_image_url);
        	    $stmt->fetch();
        	    $hotel = array();
        	    $hotel['hotel_id'] = $h_id;
        	    $hotel['hotel_name'] = $h_name;
                $hotel['hotel_address'] = $h_address;
                $hotel['hotel_ratting'] = $h_ratting;
                $hotel['hotel_desc'] = $h_desc;
                $hotel['hotel_price'] = $h_price;
                $hotel['hotel_image_url'] = $h_image_url;
        	    return $hotel;
            }
        }

        private function isHotelExist($h_id){
            $stmt = $this->con->prepare("SELECT hotel_id FROM hotel_info WHERE hotel_id = ?");
            $stmt->bind_param("s", $h_id);
            $stmt->execute();
            $stmt->store_result();
            return $stmt->num_rows > 0;
        }
    
        
        // Restaurent Database Information

        public function addRestaurent($r_id, $r_name, $r_address, $r_phone, $r_category, $r_web, $r_rating, $r_open, $r_close, $r_image){
            if(!$this->isRestaurentExist($r_id)){
                $stmt = $this->con->prepare("INSERT INTO restaurants_info (r_id, r_name, r_address, r_phone, r_category, r_web, r_rating, r_open, r_close, r_image) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                $stmt->bind_param("ssssssdsss", $r_id, $r_name, $r_address, $r_phone, $r_category, $r_web, $r_rating, $r_open, $r_close, $r_image);
                if($stmt->execute()){
                    return RESTAURENT_ADDED;
                }else{
                    return RESTAURENT_EXISTS;
                }
            }
            return RESTAURENT_FAILURE;
        }

        public function addCategory($name){
            if(!$this->isCategoryExist($name)){
                $stmt = $this->con->prepare("INSERT INTO categories (name) VALUES (?)");
                $stmt->bind_param("s", $name);
                if($stmt->execute()){
                    return CATEGORY_ADDED;
                }else{
                    return CATEGORY_FAILURE;
                }
            }
            return CATEGORY_EXISTS;
        }
        
        public function getCategories(){
            $stmt = $this->con->prepare("SELECT * FROM categories");
        	$stmt->execute();
        	$stmt->bind_result($id, $name);
            $Categories = array();
            while($stmt->fetch()){
                $category = array();
        		$category['id'] = $id;
        		$category['name'] = $name;
        		array_push($Categories, $category);
            }
            return $Categories;
        }
        public function updateRestaurent($r_id, $r_name, $r_address, $r_phone, $r_category, $r_web, $r_rating, $r_open, $r_close, $r_image){
            if($this->isRestaurentExist($r_id)){
                $stmt = $this->con->prepare("UPDATE restaurants_info SET r_name = ?, r_address = ?, r_phone = ?, r_category = ?, r_web = ?, r_rating = ?, r_open = ?, r_close = ?, r_image = ? WHERE r_id = ?");
                $stmt->bind_param("sssssdssss", $r_name, $r_address, $r_phone, $r_category, $r_web, $r_rating, $r_open, $r_close, $r_image, $r_id);
                if($stmt->execute()){
                    return RESTAURENT_UPDATED;
                }else{
                    return RESTAURENT_NOT_UPDATED;
                }
            }

            return RESTAURENT_NOT_FOUND;
        }

        public function getAllRestaurent(){
        	$stmt = $this->con->prepare("SELECT r_id, r_name, r_address, r_phone, r_category, r_web, r_rating, r_open, r_close, r_image FROM restaurants_info");
        	$stmt->execute();
        	$stmt->bind_result($r_id, $r_name, $r_address, $r_phone, $r_category, $r_web, $r_rating, $r_open, $r_close, $r_image);
        	$restaurents = array();
        	while($stmt->fetch()){
        		$restaurent = array();
        		$restaurent['r_id'] = $r_id;
        		$restaurent['r_name'] = $r_name;
                $restaurent['r_address'] = $r_address;
                $restaurent['r_phone'] = $r_phone;
                $restaurent['r_category'] = $r_category;
                $restaurent['r_web'] = $r_web;
                $restaurent['r_rating'] = $r_rating;
                $restaurent['r_open'] = $r_open;
                $restaurent['r_close'] = $r_close;
                $restaurent['r_image'] = $r_image;
        		array_push($restaurents, $restaurent);
       	 	}
       	 	return $restaurents;
        }

        public function getRestaurentByLocationId($r_id){
            if($this->isRestaurentExist($r_id)){
                $stmt = $this->con->prepare("SELECT r_id, r_name, r_address, r_phone, r_category, r_web, r_rating, r_open, r_close, r_image FROM restaurants_info WHERE r_id = ?");
                $stmt->bind_param("s", $r_id); 
                $stmt->execute();
                $stmt->bind_result($r_id, $r_name, $r_address, $r_phone, $r_category, $r_web, $r_rating, $r_open, $r_close, $r_image);
        	    $stmt->fetch();
        	    $restaurent = array();
        	    $restaurent['r_id'] = $r_id;
        	    $restaurent['r_name'] = $r_name;
                $restaurent['r_address'] = $r_address;
                $restaurent['r_phone'] = $r_phone;
                $restaurent['r_category'] = $r_category;
                $restaurent['r_web'] = $r_web;
                $restaurent['r_rating'] = $r_rating;
                $restaurent['r_open'] = $r_open;
                $restaurent['r_close'] = $r_close;
                $restaurent['r_image'] = $r_image;
        	    return $restaurent;
            }
        }

        private function isRestaurentExist($r_id){
            $stmt = $this->con->prepare("SELECT r_id FROM restaurants_info WHERE r_id = ?");
            $stmt->bind_param("s", $r_id);
            $stmt->execute();
            $stmt->store_result();
            return $stmt->num_rows > 0;
        }

        private function isCategoryExist($name){
            $stmt = $this->con->prepare("SELECT name FROM categories WHERE name = ?");
            $stmt->bind_param("s", $name);
            $stmt->execute();
            $stmt->store_result();
            return $stmt->num_rows > 0;
        }

        // Shop Database Information

        public function addShope($shop_id, $shop_name, $shop_address, $shop_phone, $shop_rating, $shop_type, $shop_open, $shop_close, $shop_image_url){
            if(!$this->isShopExist($shop_id)){
                $stmt = $this->con->prepare("INSERT INTO shop_info (shop_id, shop_name, shop_address, shop_phone, shop_rating, shop_type, shop_open, shop_close, shop_image_url) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
                $stmt->bind_param("ssssdssss", $shop_id, $shop_name, $shop_address, $shop_phone, $shop_rating, $shop_type, $shop_open, $shop_close, $shop_image_url);
                if($stmt->execute()){
                    return SHOP_ADDED;
                }else{
                    return SHOP_EXISTS;
                }
            }
            return SHOP_FAILURE;
        }

        public function updateShop($shop_id, $shop_name, $shop_address, $shop_phone, $shop_rating, $shop_type, $shop_open, $shop_close, $shop_image_url){
            if($this->isShopExist($shop_id)){
                $stmt = $this->con->prepare("UPDATE shop_info SET shop_name = ?, shop_address = ?, shop_phone = ?, shop_rating = ?, shop_type = ?, shop_open = ?, shop_close = ?, shop_image_url = ? WHERE shop_id = ?");
                $stmt->bind_param("sssdsssss", $shop_name, $shop_address, $shop_phone, $shop_rating, $shop_type, $shop_open, $shop_close, $shop_image_url, $shop_id);
                if($stmt->execute()){
                    return SHOP_UPDATED;
                }else{
                    return SHOP_NOT_UPDATED;
                }
            }
            return SHOP_NOT_FOUND;
        }

        public function getAllShops(){
        	$stmt = $this->con->prepare("SELECT shop_id, shop_name, shop_address, shop_phone, shop_rating, shop_type, shop_open, shop_close, shop_image_url FROM shop_info");
        	$stmt->execute();
        	$stmt->bind_result($shop_id, $shop_name, $shop_address, $shop_phone, $shop_rating, $shop_type, $shop_open, $shop_close, $shop_image_url);
        	$shops = array();
        	while($stmt->fetch()){
        		$shop = array();
        	    $shop['shop_id'] = $shop_id;
        	    $shop['shop_name'] = $shop_name;
                $shop['shop_address'] = $shop_address;
                $shop['shop_phone'] = $shop_phone;
                $shop['shop_rating'] = $shop_rating;
                $shop['shop_type'] = $shop_type;
                $shop['shop_open'] = $shop_open;
                $shop['shop_close'] = $shop_close;
                $shop['shop_image_url'] = $shop_image_url;
        		array_push($shops, $shop);
       	 	}
       	 	return $shops;
        }

        public function getShopByLocationId($shop_id){
            if($this->isShopExist($shop_id)){
                $stmt = $this->con->prepare("SELECT shop_id, shop_name, shop_address, shop_phone, shop_rating, shop_type, shop_open, shop_close, shop_image_url FROM shop_info WHERE shop_id = ?");
                $stmt->bind_param("s", $shop_id); 
                $stmt->execute();
                $stmt->bind_result($shop_id, $shop_name, $shop_address, $shop_phone, $shop_rating, $shop_type, $shop_open, $shop_close, $shop_image_url);
        	    $stmt->fetch();
        	    $shop = array();
        	    $shop['shop_id'] = $shop_id;
        	    $shop['shop_name'] = $shop_name;
                $shop['shop_address'] = $shop_address;
                $shop['shop_phone'] = $shop_phone;
                $shop['shop_rating'] = $shop_rating;
                $shop['shop_type'] = $shop_type;
                $shop['shop_open'] = $shop_open;
                $shop['shop_close'] = $shop_close;
                $shop['shop_image_url'] = $shop_image_url;
                
        	    return $shop;
            }
        }

        private function isShopExist($shop_id){
            $stmt = $this->con->prepare("SELECT shop_id FROM shop_info WHERE shop_id = ?");
            $stmt->bind_param("s", $shop_id);
            $stmt->execute();
            $stmt->store_result();
            return $stmt->num_rows > 0;
        }

        // School Database Information

        public function addSchool($school_id, $school_name, $school_address, $school_phone, $school_rating, $school_web, $school_image_url){
            if(!$this->isSchoolExist($school_id)){
                $stmt = $this->con->prepare("INSERT INTO education_info (school_id, school_name, school_address, school_phone, school_rating, school_web, school_image_url) VALUES (?, ?, ?, ?, ?, ?, ?)");
                $stmt->bind_param("ssssdss", $school_id, $school_name, $school_address, $school_phone, $school_rating, $school_web, $school_image_url);
                if($stmt->execute()){
                    return SCHOOL_ADDED;
                }else{
                    return SCHOOL_EXISTS;
                }
            }
            return SCHOOL_FAILURE;
        }

        public function updateSchool($school_id, $school_name, $school_address, $school_phone, $school_rating, $school_web, $school_image_url){
            if($this->isSchoolExist($school_id)){
                $stmt = $this->con->prepare("UPDATE education_info SET school_name = ?, school_address = ?, school_phone = ?, school_rating = ?, school_web = ?, school_image_url = ? WHERE school_id = ?");
                $stmt->bind_param("sssdsss", $school_name, $school_address, $school_phone, $school_rating, $school_web, $school_image_url, $school_id);
                if($stmt->execute()){
                    return SCHOOL_UPDATED;
                }else{
                    return SCHOOL_NOT_UPDATED;
                }
            }
            return SCHOOL_NOT_FOUND;
        }

        public function getAllSchool(){
        	$stmt = $this->con->prepare("SELECT school_id, school_name, school_address, school_phone, school_rating, school_web, school_image_url FROM education_info");
        	$stmt->execute();
        	$stmt->bind_result($school_id, $school_name, $school_address, $school_phone, $school_rating, $school_web, $school_image_url);
        	$schools = array();
        	while($stmt->fetch()){
        		$school = array();
        	    $school['school_id'] = $school_id;
        	    $school['school_name'] = $school_name;
                $school['school_address'] = $school_address;
                $school['school_phone'] = $school_phone;
                $school['school_rating'] = $school_rating;
                $school['school_web'] = $school_web;
                $school['school_image_url'] = $school_image_url;
        		array_push($schools, $school);
       	 	}
       	 	return $schools;
        }

        public function getSchoolByLocationId($school_id){
            if($this->isSchoolExist($school_id)){
                $stmt = $this->con->prepare("SELECT school_id, school_name, school_address, school_phone, school_rating, school_web, school_image_url FROM education_info WHERE school_id = ?");
                $stmt->bind_param("s", $school_id); 
                $stmt->execute();
                $stmt->bind_result($school_id, $school_name, $school_address, $school_phone, $school_rating, $school_web, $school_image_url);
        	    $stmt->fetch();
        	    $school = array();
        	    $school['school_id'] = $school_id;
        	    $school['school_name'] = $school_name;
                $school['school_address'] = $school_address;
                $school['school_phone'] = $school_phone;
                $school['school_rating'] = $school_rating;
                $school['school_web'] = $school_web;
                $school['school_image_url'] = $school_image_url;
                
        	    return $school;
            }
        }

        private function isSchoolExist($school_id){
            $stmt = $this->con->prepare("SELECT school_id FROM education_info WHERE school_id = ?");
            $stmt->bind_param("s", $school_id);
            $stmt->execute();
            $stmt->store_result();
            return $stmt->num_rows > 0;
        }
    }