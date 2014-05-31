<?php
/*
Setting up
*/

function currentURL() {
	return "//$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
}

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
    $response["message"] = "<span class='bg-danger text-danger'>>Error 001: Encryption is broken, I think.</span><br>";
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

//Features
$response["message"] .= "Features<Br>----------------------<br>";
//feature_1 (login system)
if ($jsonObj2->{"feature_1"} === "1") {
  if (!file_exists("login")) { //If the login folder doesn't already exist
    mkdir("login");
    $response["message"] .= "> Made login folder (login/)<br>";
    
  } else { //If the login folder does already exist
    $response["message"] .= "<span class='bg-warning text-warning'>> Login folder already exists, emptying and deleting now</span><br>";
    emptydir("login");
    rmdir("login");
    
    mkdir("login");
    $response["message"] .= "> Made login folder (login/)<br>";
  }
} elseif (!isset($jsonObj2->{"feature_1"})) {
  $response["message"] .= "> Login system will be skipped<br>";
}

//feature_2 (forums)
if ($jsonObj2->{"feature_2"} === "1" && $jsonObj2->{"feature_1"} === "1") {
  mkdir("forums");
  $response["message"] .= "> Made forums folder (forums/)<br>";
} elseif (!isset($jsonObj2->{"feature_2"})) {
  $response["message"] .= "> Forums will be skipped<br>";
}

//feature_3 (blog)
if ($jsonObj2->{"feature_3"} === "1" && $jsonObj2->{"feature_1"} === "1") {
  if (!file_exists("blog")) { //If the blog folder doesn't already exist
    mkdir("blog");
    $response["message"] .= "> Made blog folder (blog/)<br>";
    
  } else { //If the blog folder does already exist
    $response["message"] .= "<span class='bg-warning text-warning'>> Blog folder already exists, emptying and deleting now</span><br>";
    emptydir("blog");
    rmdir("blog");
    
    mkdir("blog");
    $response["message"] .= "> Made blog folder (blog/)<br>";
  }
} elseif (!isset($jsonObj2->{"feature_3"})) {
  $response["message"] .= "> Blog will be skipped<br>";
}

//feature_3_1 (blog comments)
if ($jsonObj2->{"feature_3_1"} === "1" && $jsonObj2->{"feature_3"} === "1" && $jsonObj2->{"feature_1"} === "1") {
  if (!file_exists("blog/comments")) { //If the blog comments folder doesn't already exist
    mkdir("blog/comments");
    $response["message"] .= "---> Made blog comments folder (blog/comments/)<br>";
    
  } else { //If the blog comments folder does already exist
    $response["message"] .= "<span class='bg-warning text-warning'>---> Blog comments folder already exists, emptying and deleting now</span><br>";
    emptydir("blog/comments");
    rmdir("blog/comments");
    
    mkdir("blog/comments");
    $response["message"] .= "---> Made blog comments folder (blog/comments/)<br>";
  }
} elseif (!isset($jsonObj2->{"feature_3_1"})) {
  $response["message"] .= "---> Blog comments will be skipped<br>";
}

//feature_3_2 (blog multi-authors)
if ($jsonObj2->{"feature_3_2"} === "1" && $jsonObj2->{"feature_3"} === "1" && $jsonObj2->{"feature_1"} === "1") {
  $response["message"] .= "---> Blog multi-authors will be turned on<br>";
} elseif (!isset($jsonObj2->{"feature_3_2"})) {
  $response["message"] .= "---> Blog multi-authors will be skipped<br>";
}

//feature_4 (link shrinker)
if ($jsonObj2->{"feature_4"} === "1") {
  
} elseif (!isset($jsonObj2->{"feature_4"})) {
  $response["message"] .= "> Link shrinker will be skipped<br>";
}

//feature_4_1 (link shrinker administration)
if ($jsonObj2->{"feature_4_1"} === "1" && $jsonObj2->{"feature_4"} === "1" && $jsonObj2->{"feature_1"} === "1") {
  
} elseif (!isset($jsonObj2->{"feature_4_1"})) {
  $response["message"] .= "---> Link shrinker administration will be skipped<br>";
}

//feature_4_2 (link shrinker tracking)
if ($jsonObj2->{"feature_4_2"} === "1" && $jsonObj2->{"feature_4"} === "1") {
  
} elseif (!isset($jsonObj2->{"feature_4_2"})) {
  $response["message"] .= "---> Link shrinker tracking will be skipped<br>";
}

//feature_5 (logging)
if ($jsonObj2->{"feature_5"} === "1") {
  
} elseif (!isset($jsonObj2->{"feature_5"})) {
  $response["message"] .= "> Logging will be skipped<br>";
}

//feature_6 (encryption)
if ($jsonObj2->{"feature_6"} === "1") {
  
} elseif (!isset($jsonObj2->{"feature_6"})) {
  $response["message"] .= "> Encryption will be skipped<br>";
}

//feature_7 (pages)
if ($jsonObj2->{"feature_7"} === "1") {
  
} elseif (!isset($jsonObj2->{"feature_7"})) {
  $response["message"] .= "> Pages will be skipped<br>";
}

//feature_8 (source files: hosted or included)
if ($jsonObj2->{"feature_8"} === "1") { //If they selected to have the source files hosted versus included
  $response["message"] .= "> Source files will be hosted<br>";
  
} elseif ($jsonObj2->{"feature_8"} === "2") { //If they selected to have the source files included versus hosted
  if (!file_exists("lib")) { //If the lib folder doesn't already exist
    mkdir("lib");
    mkdir("lib/js");
    mkdir("lib/php");
    $response["message"] .= "> Lib (library) folder made<br>";
    
  } else { //If the lib folder does already exist
    $response["message"] .= "<span class='bg-warning text-warning'>> Lib (library) folder already exists, emptying and deleting now</span><br>";
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

//Database
$response["message"] .= "<Br>Database<Br>----------------------<br>";
//db_loc (location of mysql database)
if ($jsonObj2->{"db_loc"} !== "") {
  
} elseif ($jsonObj2->{"db_loc"} === "") {
  $response["message"] .= "<span class='bg-warning text-warning'>>  Database location is required, but is blank -  setting to 'localhost'</span><br>";
  $jsonObj2->{"db_loc"} = "localhost";
}

//db_name (name of mysql database)
if ($jsonObj2->{"db_name"} !== "") {
  
} elseif ($jsonObj2->{"db_name"} === "") {
  $response["message"] .= "<span class='bg-warning text-warning'>>  Database name is required, but is blank -  creating database called 'site'</span><br>";
}

//db_uname (username for mysql database)
if ($jsonObj2->{"db_uname"} !== "") {
  
} elseif ($jsonObj2->{"db_uname"} === "") {
  $response["message"] .= "<span class='bg-warning text-warning'>>  Database username is required, but is blank -  setting to 'root'</span><br>";
  $jsonObj2->{"db_uname"} = "root";
}

//db_pass (pass for mysql database)
if ($jsonObj2->{"db_pass"} !== "") {
  
} elseif ($jsonObj2->{"db_pass"} === "") {
  $response["message"] .= "<span class='bg-warning text-warning'>>  Database password is required, but is blank -  keeping as '' (blank)</span><br>";
}

$testConnection = ""; //Attempt to connect to the DB -- Use mysqli (http://s.zbee.me/zah)

//Meta-Data
$response["message"] .= "<Br>Meta Data<Br>----------------------<br>";
//meta_domain ( domain of the site)
if ($jsonObj2->{"meta_domain"} !== "") {
  
} elseif ($jsonObj2->{"meta_domain"} === "") {
  $curURL = preg_replace("/(setup.php|\/install\/|\/\/)/i","",currentURL());
  $response["message"] .= "<span class='bg-warning text-warning'>>  The meta data 'domain' is blank - setting to be the current url (".$curURL.")</span><br>";
  $jsonObj2->{"meta_domain"} = $curURL;
}
//meta_simpledomain (simple domain of the site)
if ($jsonObj2->{"meta_simpledomain"} !== "") {
  
} elseif ($jsonObj2->{"meta_simpledomain"} === "") {

  $simpleURL = explode("/", $jsonObj2->{"meta_domain"})[0];
  $simpleURL = explode(".", $simpleURL);
  if (count($simpleURL) > 1) {
    for ($x = 0; $x < count($simpleURL)+1; $x++) {
      if ($x !== count($simpleURL)) {
        $suf .= $simpleURL[$x].".";
      } else {
        $suf .= $simpleURL[$x];
      }
    }
    $simpleURL = substr($suf, 0, -1); //Substr removes a trailing ".", which can probably be avoided by fixing the for loop's if statement (which is supposed to only include a period on every case of a period existing except the last one)
  } else {
    $simpleURL = $simpleURL[0].".".$simpleURL[1];
  }
  
  $response["message"] .= "<span class='bg-warning text-warning'>>  The meta data 'simpledomain' is blank - setting to be the same as a simplified version of domain (result: ".$simpleURL.")</span><br>";
  $jsonObj2->{"meta_simpledomain"} = $simpleURL;
}

//meta_sitename (name of the site)
if ($jsonObj2->{"meta_sitename"} !== "") {
  
} elseif ($jsonObj2->{"meta_sitename"} === "") {
  $response["message"] .= "<span class='bg-warning text-warning'>>  The meta data 'sitename' is blank - setting to be the same as the simple domain</span><br>";
  $jsonObj2->{"meta_sitename"} = $jsonObj2->{"meta_simpledomain"};
}

//meta_description of the site)
if ($jsonObj2->{"meta_description"} !== "") {
  
} elseif ($jsonObj2->{"meta_description"} === "") {
  $metaDesc = "A ";
  if ($jsonObj2->{"feature_6"} == "1") {
    $metaDesc .= "very secure ";
  }
  if ($jsonObj2->{"feature_2"} == "1") {
    $metaDesc .= "forum, ";
  }
  if ($jsonObj2->{"feature_3"} == "1") {
    $metaDesc .= "blog, ";
  }
  if ($jsonObj2->{"feature_4"} == "1") {
    $metaDesc .= "link shrinker, ";
  }

  $response["message"] .= "<span class='bg-warning text-warning'>>  The meta data 'description' is blank - setting to be a rough list of selected features</span><br>";
  $jsonObj2->{"meta_description"} = $metaDesc;
}

//Email
$response["message"] .= "<Br>Email<Br>----------------------<br>";
//email_from (address emails will come from)
if ($jsonObj2->{"email_from"} !== "") {
  
} elseif ($jsonObj2->{"email_from"} === "") {
  $response["message"] .= "<span class='bg-warning text-warning'>>  The email from field is blank - setting to be 'noreply@".$jsonObj2->{"meta_simpledomain"}."'</span><br>";
  $jsonObj2->{"email_from"} = "noreply@".$jsonObj2->{"meta_simpledomain"};
}

//email_reply (address emails will come from)
if ($jsonObj2->{"email_reply"} !== "") {
  
} elseif ($jsonObj2->{"email_reply"} === "") {
  $response["message"] .= "<span class='bg-warning text-warning'>>  The email from field is blank - setting to be 'replies@".$jsonObj2->{"meta_simpledomain"}."' make sure to set this up</span><br>";
  $jsonObj2->{"email_from"} = "replies@".$jsonObj2->{"meta_simpledomain"};
}

//email_checkbox_1 (email notification for email changing)
if ($jsonObj2->{"email_checkbox_1"} === "1") {
  
} elseif (!isset($jsonObj2->{"email_checkbox_1"})) {
  $response["message"] .= "> Users will not be notified if their email is changed<br>";
}

//email_checkbox_2 (email notification for password changing)
if ($jsonObj2->{"email_checkbox_2"} === "1") {
  
} elseif (!isset($jsonObj2->{"email_checkbox_2"})) {
  $response["message"] .= "> Users will not be notified if their password is changed<br>";
}

//email_checkbox_3 (email notification for account recovered)
if ($jsonObj2->{"email_checkbox_3"} === "1") {
  
} elseif (!isset($jsonObj2->{"email_checkbox_3"})) {
  $response["message"] .= "> Users will not be notified if their account is recovered<br>";
}

/*
Wrapping up
*/

if ($response["success"] === 2) {
    $response["message"] .= "<br><strong>> Vor setup completed</strong><Br>";
    echo json_encode($response);
} else {  
    $response["success"] = 1;    
    $response["message"] = "Oops! An error occurred.";
    echo json_encode($response);
} 


?>