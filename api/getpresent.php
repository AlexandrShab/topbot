<?php
header('Access-Control-Allow-Origin: *');
    require_once __DIR__ . '/mysql.php';
    
    $base = new BaseAPI;
    $inputJSON = file_get_contents('php://input');
    if ($inputJSON){
        //print_r($inputJSON);
        $input = json_decode( $inputJSON, TRUE ); 
        print_r(json_encode($input));
        print_r($input);

        
    } else{
        //$get = $_GET['present'];
        
        //print_r($get);
        $mas = $base->getPresent();
        //print_r($mas);
        $arr = json_encode($mas);
        header('Access-Control-Allow-Origin: *');
        header('Content-Type: application/json');
        print_r( $arr);
    }
    
    
    
    
 