<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/wp-load.php');  

function wpcodetips_send_sms( $smsMessage, $contactNumber){
    $accountSID = 'XXXXXXXXXXXXX';
    $authKey = 'XXXXXXXXXXXXX';
    $sendNumber = '+XXXXXXXXXXX';

    $url = "https://api.twilio.com/2010-04-01/Accounts/".$accountSID."/Messages.json";
    $data = array(
        'From' => $sendNumber,
        'To' => $contactNumber,
        'Body' => $smsMessage
    ); 

    $headers = array( 'Authorization' => 'Basic ' . base64_encode($accountSID . ':' . $authKey));
    $result = wp_remote_post($url, array( 'body' => $data, 'headers' => $headers));

    return json_decode($result['body'], true);
}


function clean($string) {
    $string = str_replace(' ', '', $string); 
    $string = preg_replace('/[^A-Za-z0-9\-]/', '', $string); 
 
    return preg_replace('/-+/', '', $string); 
}

$url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

$url_components = parse_url($url);
parse_str($url_components['query'], $params);
     


$username = $params['cpf'];
$currentUser = get_user_by('login', $username);

if($currentUser){
    $myMessage = "Olá, segue sua nova senha para realizar o login: ".$params['password'];
    $sendTo = '+55'.clean($params['phone']) ;
    
    wp_set_password( $params['password'], $currentUser->ID);
    wpcodetips_send_sms ($myMessage, $sendTo);
}  
else {
    header("Location: https://localhost:8000/recuperar-senha/?user=not_found");
    die();
}