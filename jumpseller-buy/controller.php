<?php
include_once(ABSPATH.'wp-content/plugins/jumpseller-buy/model.php');

class Controller {

    


     public $model;	

     public function __construct()  
     {  
          $this->model = new Model();
     } 
	




     public function invoke()
     {

               
               $articles = $this->model->jproc_function($atts) ;
              // echo 'hhh';
			   
			  // include 'tmp.php';
     }
	 
	 
}

?>