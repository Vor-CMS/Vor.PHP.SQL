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

$themes = array(
  "amelia"     => "http://bootswatch.com/amelia/bootstrap.min.css",
  "cerulean"   => "http://bootswatch.com/cerulean/bootstrap.min.css",
  "cosmo"      => "http://bootswatch.com/cosmo/bootstrap.min.css",
  "cyborg"     => "http://bootswatch.com/cyborg/bootstrap.min.css",
  "darkly"     => "http://bootswatch.com/darkly/bootstrap.min.css",
  "flatly"     => "http://bootswatch.com/flatly/bootstrap.min.css",
  "journal"    => "http://bootswatch.com/journal/bootstrap.min.css",
  "lumen"      => "http://bootswatch.com/lumen/bootstrap.min.css",
  "readable"   => "http://bootswatch.com/readable/bootstrap.min.css",
  "simplex"    => "http://bootswatch.com/simplex/bootstrap.min.css",
  "slate"      => "http://bootswatch.com/slate/bootstrap.min.css",
  "spacelab"   => "http://bootswatch.com/spacelab/bootstrap.min.css",
  "superhero"  => "http://bootswatch.com/superhero/bootstrap.min.css",
  "united"     => "http://bootswatch.com/united/bootstrap.min.css",
  "yeti"       => "http://bootswatch.com/yeti/bootstrap.min.css"
);

$source = "hosted";
if ($source === "included") {
  $sources = [
    "html5shiv.js" => "lib/js/html5shiv.js"
  ];
} elseif ($source === "hosted") {
  $sources = [
    "stylesheet" => $themes['yeti'],
    "htmlshiv"   => "http://dl.zbee.me/html5shiv.js",
    "respond"    => "http://dl.zbee.me/respond.min.js",
    "bootstrap"  => "//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js",
    "jquery"     => "https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.1/jquery.min.js"
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

$sitename = "Beta.zbee.me";

$metadesc = "An awesome website";

$emailfrom = "noreply@beta.zbee.me";

$emailreply = "replies@beta.zbee.me";

$notifications = [
  "emailchange"    => "false",
  "passwordchange" => "false",
  "accountrecover" => "false"
];

?>