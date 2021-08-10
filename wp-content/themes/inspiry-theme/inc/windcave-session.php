<?php


class Windcave_Sessions{
    public function __construct()
    {
        echo "This is a class0";

        add_action('woocommerce_before_checkout_billing_form', array( $this, 'iFrame_container' )); 

    }

    public function iFrame_container(){
        echo '<div class="payment-gateway-container" data-seamlessHpp="'; 
        echo "customer data"; 
        echo '">';
        echo'
        <div id="payment-iframe-container"> 
        <div class="button-container" >
        <button class="windcave-submit-button" >Submit</button> 
        <div class="cancel-payment" >Cancel Payment</div> 
        </div>
       
        </div> 
        </div> 
        ';
    }
}

$windcaveSession = new Windcave_Sessions();
// add iframe container 

$sessionIDSecond = 3; 
$a=5; 
$b=10; 
// windcave session 
add_action('woocommerce_before_checkout_billing_form', 'windcave_session'); 

function windcave_session(){
      // get order details
      $totalAmount = WC()->cart->total; 
   
   // https request to windcave to create a session 
   $ch = curl_init();
   curl_setopt($ch, CURLOPT_URL, "https://uat.windcave.com/api/v1/sessions");
   curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
   curl_setopt($ch, CURLOPT_HEADER, FALSE);

   curl_setopt($ch, CURLOPT_POST, TRUE);

   curl_setopt($ch, CURLOPT_POSTFIELDS, "{
   \"type\": \"purchase\",
   \"methods\": [
      \"card\"
   ],
   \"amount\": \"$totalAmount\",
   \"currency\": \"NZD\",
   \"callbackUrls\": {
      \"approved\": \"https://localhost/success\",
      \"declined\": \"https://localhost/failure\"
   }
   }");

   curl_setopt($ch, CURLOPT_HTTPHEADER, array(
   "Content-Type: application/json",
   "Authorization: Basic SW5zcGlyeV9SZXN0OmI0NGFiMjZmOWFkNzIwNDQ4OTc0MGQ1YWM3NmE5YzE2ZDgzNDJmODUwYTRlYjQ1NTc1NmRiNDgyYjFiYWVjMjk="
   ));

   $response = curl_exec($ch);
   $obj = json_decode($response);
   var_dump($obj); 
   curl_close($ch);

   echo '<br><br>';
   $seamlessValue = ''; 
   // for each loop to get seamless_hpp url 
   foreach ($obj->links as $obj) {
      if($obj->rel=== "seamless_hpp"){
         $GLOBALS['seamlessHpp'] = $obj->href;
         $seamlessValue = $obj->href;
      }
      if($obj->rel=== "self"){
        $GLOBALS['sessionID'] = basename($obj->href);
        global $a, $b; 
        $sessionIDSecond = $a+$b;
      }
   }
   
 

   echo '<br><br>';

   echo  'https://uat.windcave.com/api/v1/sessions/'.$sessionIDSecond;


   ?>
        <script>
                    WindcavePayments.Seamless.prepareIframe({
                        url: "<?php echo $seamlessValue; ?>",
                        containerId: "payment-iframe-container",
                        loadTimeout: 30,
                        width: 400,
                        height: 500,
                        onProcessed: function () { console.log('iframes is loaded properly ') },
                        onError: function (error) {
                            console.log(error)
                            console.log('this is and error event after loading ')
                        }
                    });
                    </script> 
   <?php
}
 

// register query session route

add_action("rest_api_init", "windcave_query_session");

function windcave_query_session(){ 
   
 //update board 
 register_rest_route("inspiry/v1/", "query-session", array(
   "methods" => "POST",
   "callback" => "querySession"
   ));
 
//    register_rest_route("inspiry/v1/", "test-session", array(
//     "methods" => "POST",
//     "callback" => "testSessions"
//     ));
}

// function testSessions($data){
//     $returnValue = array(
//         "authorize"=> "true", 
//         "responseText"=> "this is respone header. something went wrong"
//     ); 
//     if($returnValue['authorize']=== 'true'){ 
//         return "true";
//     }
//     else{ 
//         return $returnValue['responseText'];
//     }
    
// }
   


function querySession($data){
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://uat.windcave.com/api/v1/sessions/00001200057642070c56cd51cccd7b03',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => array(
        'Content-Type: application/json',
        'Authorization: Basic SW5zcGlyeV9SZXN0OmI0NGFiMjZmOWFkNzIwNDQ4OTc0MGQ1YWM3NmE5YzE2ZDgzNDJmODUwYTRlYjQ1NTc1NmRiNDgyYjFiYWVjMjk='
        ),
    ));
    
    $response = curl_exec($curl);
    
    curl_close($curl);
    $sessionObj = json_decode($response); 

    
    foreach ($sessionObj->transactions as $obj) {
        //    check authorization 
            if($obj->authorised){ 
                $GLOBALS['authorisedPayment'] = "true"; 
            }
            else { 
                $GLOBALS['authorisedPayment'] = "false"; 
            }

            $GLOBALS ['responseText'] = $obj->responseText;
    }
            $returnValue = array(
                "authorize"=> $GLOBALS['authorisedPayment'], 
                "responseText"=> $GLOBALS['responseText']
            ); 
           if($GLOBALS['authorisedPayment'] === "true"){
               return true;
           }
           else if($GLOBALS['authorisedPayment'] === "false") { 
            return $returnValue['responseText'];
        }
}



?>