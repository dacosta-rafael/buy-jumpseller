<?php 

class Model {




	public function jproc_function($atts) {
		$product_id = $atts['product_id'];
		$storecode = 'pihaus';
		$storetoken = 'FFIPTJVUHAMBUJUILADGGNOLTSQANSCD';
		$call = $this->curl_call( $product_id, $storecode, $storetoken) ;
		$json_data =   json_decode($call, true);
		$permalink = 'https://'.$storecode.'.jumpseller.com/'.$json_data['product']['permalink'];


	  	return $permalink;
	}




	public function curl_call($product_id, $storecode, $storetoken) {
	$url = 'https://api.jumpseller.com/v1/products/'.$product_id.'.json?login='.$storecode.'&authtoken='.$storetoken;
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array(
		'Content-Type: application/json',
		)
	); 
	                                                                                                                  
	                                                                                                                     
	$result = curl_exec($ch);
		// Check HTTP status code
		/* 
		if (!curl_errno($ch)) {
		  switch ($http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE)) {
		    case 200:  # OK
		      break;
		    default:
		      echo 'Unexpected HTTP code: ', $http_code, "\n";
		  }
		}
		*/
	curl_close($ch);
	return $result;
	}
}

?>
