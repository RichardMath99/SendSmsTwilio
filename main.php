<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/wp-load.php');  


function wpcodetips_send_sms( $smsMessage , $contactNumber ){
    // Mude para o SID da sua conta
    $accountSID = 'XXXXXXXXXXXXX' ;
    // Altere para a chave de autenticação da sua conta
    $authKey = 'XXXXXXXXXXXXX' ;
    // Altere para o número de avaliação da sua conta
    $sendNumber = '+XXXXXXXXXXX' ;

    // The Twilio API Url 
    $url = "https://api.twilio.com/2010-04-01/Accounts/".$accountSID."/Messages.json";
    // The data being sent to the API
    $data = array(
                'From' => $sendNumber,
                'To' => $contactNumber,
                'Body' => $smsMessage
            ); 
    // Set the authorisation header
    $headers = array( 'Authorization' => 'Basic ' . base64_encode($accountSID . ':' . $authKey));
    // Send the POST request and store the response in a variable
    $result = wp_remote_post($url, array( 'body' => $data, 'headers' => $headers));
    // Return the response body to ensure it has worked
    return json_decode($result['body'], true);
}


function clean($string) {
    $string = str_replace(' ', '', $string); // Replaces all spaces with hyphens.
    $string = preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
 
    return preg_replace('/-+/', '', $string); // Replaces multiple hyphens with single one.
}

$url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

$url_components = parse_url($url);
parse_str($url_components['query'], $params);
     
$myMessage = "Olá, segue sua nova senha para acessar o site de wordpress: ".$params['password'];
$sendTo = '+55'.clean($params['phone']) ;
$username = $params['cpf'];

$currentUser = get_user_by('login', $username);

if($currentUser){
    wp_set_password( $params['password'], $currentUser->ID);
    wpcodetips_send_sms ($myMessage, $sendTo);
}  
else {
    header("Location: https://localhost:8000/recuperar-senha/?user=not_found");
    die();
}