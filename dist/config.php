<?php

$apps = [
  "login"         => "1",
  "forums"        => "false",
  "blog"          => ["main"=>"false","comments"=>"false","multi-author"=>"false"],
  "linkShrinker"  => ["main"=>"false","administration"=>"false","tracking"=>"false"],
  "logging"       => "false",
  "encryption"    => "false",
  "pages"         => "false"
];

$source = "hosted";
if ($source === "included") {
  $sources = [
    "html5shiv.js" => "lib/js/html5shiv.js"
  ];
} elseif ($source === "hosted") {
  $sources = [
    "stylesheet" => "http://bootswatch.com/yeti/bootstrap.min.css",
    "htmlshiv"   => "http://dl.zbee.me/html5shiv.js",
    "respond"    => "http://dl.zbee.me/respond.min.js",
    "bootstrap"  => "//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"
  ];
}

$database = array(
	"location" => "localhost",
	"database" => "",
	"username" => "root",
	"password" => ""
);
mysql_connect($database['location'], $database['username'], $database['password']); mysql_select_db($database_preface.$database['database']);

$database_preface = "vor_";

$domain = "beta.zbee.me/vor/vor.php.sql/dist";

$simpledomain = "zbee.me";

$sitename = "Zbee.me";

$metadesc = "An awesome website";

$emailfrom = "noreply@beta.zbee.me";

$emailreply = "replies@beta.zbee.me";

$notifications = [
  "emailchange"    => "false",
  "passwordchange" => "false",
  "accountrecover" => "false"
];

?>