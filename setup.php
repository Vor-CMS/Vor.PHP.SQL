<?php
$response = array();
if (!isset($_POST['cryption'])) { exit; }  
$result = parseQuery($_POST['cryption']);  
if (!isset($result)) exit;
$json_string = $result;  
$jsonObj = json_decode($json_string);  
$username = $jsonObj->{'username'};  
$password = $jsonObj->{'password'};

$encrypted = base64_decode("data_base64");
$iv        = base64_decode("iv_base64");
$key       = base64_decode("key_base64");

$plaintext = rtrim( mcrypt_decrypt( MCRYPT_RIJNDAEL_128, $key, $encrypted, MCRYPT_MODE_CBC, $iv ), "\t\0 " );

?>