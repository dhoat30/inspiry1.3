<?php
 $requestPayload = file_get_contents("php://input"); 
 $object = json_decode($requestPayload); 
   
    $sessionID = $object->sessionID; 
   
   $curl = curl_init();
   
   curl_setopt_array($curl, array(
       CURLOPT_URL => "https://sec.windcave.com/api/v1/sessions/".$sessionID,
       CURLOPT_RETURNTRANSFER => true,
       CURLOPT_ENCODING => '',
       CURLOPT_MAXREDIRS => 10,
       CURLOPT_TIMEOUT => 0,
       CURLOPT_FOLLOWLOCATION => true,
       CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
       CURLOPT_CUSTOMREQUEST => 'GET',
       CURLOPT_HTTPHEADER => array(
       'Content-Type: application/json',
       'Authorization: Basic SW5zcGlyeUxQOmRkYzdhZDg2ZDQ0NDA3NDk3OTNkZWM1OWU5YTk1MmI4ODU3ODlkM2Q0OGE2MzliODMwZWI0OTJhNjAyYmNhNjM='
       ),
   ));
   
   $response = curl_exec($curl);
  
   curl_close($curl);
   $sessionObj = json_decode($response);
   
   
       $newValue = $sessionObj->transactions[0]->authorised; 
       if($newValue){
           echo "true";
       }
       else{ 
            echo $sessionObj->transactions[0]->responseText; ; 
       }
  ?>