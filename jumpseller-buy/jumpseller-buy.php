<?php
/*
Plugin Name: Jumpseller Buy
Plugin URI: 
Description: Jumpseller Buy Button
Version: 0.1 BETA
Author: 
Author URI: 
*/

/*
short code format is : [jumpseller product_id="value"]
*/

class Model {
		public function jumpseller_parse($atts, $storecode, $storetoken) {
				$product_id = $atts['product_id'];
				$call = $this->curl_call( $product_id, $storecode, $storetoken) ;
				$json_data =   json_decode($call, true);
				///munge file here and save it
			  	return $json_data;
		}

		public function curl_call($product_id, $storecode, $storetoken) {
			$url = 'https://api.jumpseller.com/v1/products/'.$product_id.'.json?login='.$storecode.'&authtoken='.$storetoken;
			//print_r($url);
			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_HTTPHEADER, array(
				'Content-Type: application/json',
				)
			);
			$result = curl_exec($ch);
				// Check HTTP status code
				if (!curl_errno($ch)) {
				  switch ($http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE)) {
				    case 200:  # OK
				      break;
				    default:
				      echo 'Unexpected HTTP code: ', $http_code, "\n";
				  }
				}
			curl_close($ch);
			return $result;
		}
}


class Controller {
     public $model;	
     public function __construct($storecode, $storetoken)  
     {  
     	            $this->model = new Model();
     	            $this->storecode = $storecode;
     	            $this->storetoken = $storetoken;
     } 
     public function jumpseller_handler( $atts ) {
          		$_output = $this->model->jumpseller_parse($atts, $this->storecode, $this->storetoken);
          		//print_r( $_output  );
          		ob_start();
          		include 'tmp.php';
          		return ob_get_clean();
	} 
}

$storecode = 'get from config';
$storetoken = 'get from config';
//instatiate functions
$controller = new Controller($storecode, $storetoken);
//tell wordpress to register the jumpseller shortcode
add_shortcode( 'jumpseller', array( $controller, 'jumpseller_handler' ) );












?>