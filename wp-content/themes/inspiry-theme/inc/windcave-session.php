<?php


class Windcave_Sessions{
    var $sessionURL = "";


    public function __construct()
    {
        add_action('woocommerce_before_checkout_billing_form', array( $this, 'iFrame_container' )); 
        add_action('woocommerce_before_checkout_billing_form', array($this, 'windcave_session') ); 
        add_action('woocommerce_before_checkout_billing_form', array( $this, 'test_container' ));
        add_action("rest_api_init", array($this, "windcave_query_session"));
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

    public function windcave_session(){
       
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
           $seamlessValue = $obj->href;
        }
        if($obj->rel=== "self"){
        $this->sessionID = basename($obj->href);
        }
     }

    //  $this->sessionURL = "https://uat.windcave.com/api/v1/sessions/".$this->sessionID;
    $this->sessionURL = "https://uat.windcave.com/api/v1/sessions/00001200057642070c56cd51cccd7b03"; 
     echo '<br><br>';
       
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

    public function setSessionURL($sessionID){
            // return "https://uat.windcave.com/api/v1/sessions/".$sessionID;
            return "https://uat.windcave.com/api/v1/sessions/00001200057642070c56cd51cccd7b03"; 
    }

  public function windcave_query_session(){ 
 
    //update board 
    register_rest_route("inspiry/v1/", "query-session", array(
      "methods" => "POST",
      "callback" => array($this, 'test_container')
      ));
  }
    public function test_container(){
       
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL =>  $this->sessionURL,
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
        print_r($response);
        return $response;
        // foreach ($sessionObj->transactions as $obj) {
        //     //    check authorization 
        //         if($obj->authorised){ 
        //             $GLOBALS['authorisedPayment'] = "true"; 
        //         }
        //         else { 
        //             $GLOBALS['authorisedPayment'] = "false"; 
        //         }

        //         $GLOBALS ['responseText'] = $obj->responseText;
        // }
        //         $returnValue = array(
        //             "authorize"=> $GLOBALS['authorisedPayment'], 
        //             "responseText"=> $GLOBALS['responseText']
        //         ); 
            // if($GLOBALS['authorisedPayment'] === "true"){
            //     return true;
            // }
            // else if($GLOBALS['authorisedPayment'] === "false") { 
            //     return $returnValue['responseText'];
            // }

    }


}

$windcaveSession = new Windcave_Sessions();
// add iframe container 
?>