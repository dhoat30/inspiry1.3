<?php
//routes

add_action("rest_api_init", "email_route");

function email_route() {
    // 	add to board
    register_rest_route("inspiry/v1/", "professional-email", array(
        "methods" => "POST",
        "callback" => "professionalEmail"
    ));

}

// get board - new
function professionalEmail($data) {
    $name = sanitize_text_field($data["name"]);
    $email = sanitize_text_field($data["email"]);
    $phone = sanitize_text_field($data["phone"]);
    $message = sanitize_text_field($data["message"]);
    $formName = "Enquiry Form";

        $name = "\n Name: $name";
        $headers = 'From: '.$email;
        $email = "\n Email: $email";
        $message = " \n Message: $message";
        $phone = " \n Phone: $phone";


        $msg = "Inspiry $formName \n\n $name $email $phone $message";

        $to = 'designer@webduel.co.nz';
        $sub = $formName;
        wp_mail($to, $sub, $msg, $headers);
        return $msg;
}
?>