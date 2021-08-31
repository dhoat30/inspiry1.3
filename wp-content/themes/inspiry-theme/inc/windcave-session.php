<?php


class Windcave_Sessions{
    var $sessionURL = "";

    public function __construct()
    {
        $this->authorizedPayment = '';
        $this->responseText= '';
        $this->sessionID = '';
        add_action('woocommerce_before_checkout_billing_form', array( $this, 'iFrame_container' )); 
        add_action('woocommerce_before_checkout_billing_form', array($this, 'windcave_session') ); 

    }

    public function iFrame_container(){
        echo '<div class="payment-gateway-container" data-seamless="asfddsaf'; 
        echo $this->sessionID; 
        echo '">';
        echo' <img src="https://inspiry.co.nz/wp-content/uploads/2021/08/windcave-logo.png" width="95%">
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
     curl_setopt($ch, CURLOPT_URL, "https://sec.windcave.com/api/v1/sessions");
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
     "Authorization: Basic SW5zcGlyeUxQOmRkYzdhZDg2ZDQ0NDA3NDk3OTNkZWM1OWU5YTk1MmI4ODU3ODlkM2Q0OGE2MzliODMwZWI0OTJhNjAyYmNhNjM="
     ));
  
     $response = curl_exec($ch);
     $obj = json_decode($response);
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
     echo '<div class="windcave-session-id" data-sessionid="'; 
        echo $this->sessionID; 
        echo '"> </div>';
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


  
  
}

$windcaveSession = new Windcave_Sessions();
// add iframe container 
?>