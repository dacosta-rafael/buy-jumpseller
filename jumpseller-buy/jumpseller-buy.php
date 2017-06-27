<?php
/*
Plugin Name: Jumpseller Buy
Plugin URI: 
Description: Jumpseller Buy Button
Version: 0.3
Author: 
Author URI: 
*/

/*
short code format is : [jumpseller product_id="value"]
*/
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

include "includes/config.php";


class jump_Model {
		public function jumpseller_parse($atts, $storecode, $storetoken) {
				$product_id = $atts['product_id'];
				$call = $this->curl_call( $product_id, $storecode, $storetoken) ;
				$json_data =   json_decode($call, true);
				///munge file here and save it
				//print_r($json_data);
				$json_data = array_merge($json_data, 
					array( 'storecode' => $storecode )
					);
				//print_r($json_data);
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


class jump_Controller {
     public $jump_model;	
     public function __construct($storecode, $storetoken)  
     {  
     	            $this->jump_model = new jump_Model();
     	            $this->storecode = $storecode;
     	            $this->storetoken = $storetoken;
     } 
     public function jumpseller_handler( $atts ) {
          		$_output = $this->jump_model->jumpseller_parse($atts, $this->storecode, $this->storetoken);
          		//print_r( $_output  );
          		ob_start();
          		include 'tmp/tmp.php';
          		return ob_get_clean();
	} 
}



// add conditional here, if above fails?
//instatiate functions
$jump_controller = new jump_Controller($storecode, $storetoken);
//tell wordpress to register the jumpseller shortcode
add_shortcode( 'jumpseller', array( $jump_controller, 'jumpseller_handler' ) );
?>