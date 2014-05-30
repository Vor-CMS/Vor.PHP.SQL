<?php
/*
Setting up
*/

require "gibberishAES.php";
require "emptyDir.php";

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
    $response["message"] = "Error 001: Encryption is broken, I think.";
    echo GibberishAES::enc(json_encode($response), $key);
    exit;  
}

$decrypted = GibberishAES::dec($encrypted, $key);
$jsonObj2  = json_decode($decrypted);

/*
Making sure all fields are valid
*/

$response["success"] = 2;

/*
Making everything
*/

if ($jsonObj2->{"feature_8"} === "1") { //If they selected to have the source files hosted versus included
  $response["message"] .= "> Source files will be hosted<br>";
  
} elseif ($jsonObj2->{"feature_8"} === "2") { //If they selected to have the source files included versus hosted
  if (!file_exists("lib")) { //If the lib folder doesn't already exist
    mkdir("lib");
    mkdir("lib/js");
    mkdir("lib/php");
    $response["message"] .= "> Lib (library) folder made<br>";
    
  } else { //If the lib folder does already exist
    $response["message"] .= "> Lib (library) folder already exists, emptying and deleting now<br>";
    emptydir("lib");
    rmdir("lib");
    
    mkdir("lib");
    mkdir("lib/js");
    mkdir("lib/php");
    $response["message"] .= "> Lib (library) folder made<br>";
  }
  
  $gibberishAESphp = file_get_contents("texts/gibberishAES.php.txt"); //Get the contents of a file
  file_put_contents("lib/php/gibberishAES.php", $gibberishAESphp); //Now make that file
  $response["message"] .= "> Made the gibberishAES.php file (lib/php/gibberishAES.php)<br>";
  
  $gibberishAESjs = file_get_contents("texts/gibberishAES.js.txt");
  file_put_contents("lib/js/gibberishAES.js", $gibberishAESjs);
  $response["message"] .= "> Made the gibberishAES.js file (lib/js/gibberishAES.js)<br>";
}

/*
Wrapping up
*/

if ($response["success"] === 2) {
    $response["message"] .= "> Vor setup completed<Br>";
    echo json_encode($response);
} else {  
    $response["success"] = 1;    
    $response["message"] = "Oops! An error occurred.";
    echo json_encode($response);
} 


?>