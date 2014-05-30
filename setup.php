<?php
require "php/gibberishAES.php";

$response = array();

if (!isset($_POST['cryption'])) { exit; }  
$result = $_POST['cryption'];  
if (!isset($result)) { exit; }

$json_str = $result;  
$jsonObj  = json_decode($json_str);

$encrypted = $jsonObj->{"data"};
$key       = $jsonObj->{"key"};
if ($encrypted == "" || $key == "")   {
    $response["success"] = 0;
    $response["message"] = "Required field(s) is missing";
    echo GibberishAES::enc(json_encode($response), $key);
    exit;  
}

$decrypted = GibberishAES::dec($encrypted, $key);
$jsonObj2  = json_decode($decrypted);
 
if ($jsonObj2->{"feature_8"} == "1") {
    $response["success"] = 2;
    $response["message"] = "Access successfully created.";
    echo json_encode($response);
} else {  
    $response["success"] = 1;    
    $response["message"] = "Oops! An error occurred.";
    echo json_encode($response);
} 


?>