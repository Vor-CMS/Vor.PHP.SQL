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
  "amelia"     => "//netdna.bootstrapcdn.com/bootswatch/3.1.1/amelia/bootstrap.min.css",
  "cerulean"   => "//netdna.bootstrapcdn.com/bootswatch/3.1.1/cerulean/bootstrap.min.css",
  "cosmo"      => "//netdna.bootstrapcdn.com/bootswatch/3.1.1/cosmo/bootstrap.min.css",
  "cyborg"     => "//netdna.bootstrapcdn.com/bootswatch/3.1.1/cyborg/bootstrap.min.css",
  "darkly"     => "//netdna.bootstrapcdn.com/bootswatch/3.1.1/darkly/bootstrap.min.css",
  "flatly"     => "//netdna.bootstrapcdn.com/bootswatch/3.1.1/flatly/bootstrap.min.css",
  "journal"    => "//netdna.bootstrapcdn.com/bootswatch/3.1.1/journal/bootstrap.min.css",
  "lumen"      => "//netdna.bootstrapcdn.com/bootswatch/3.1.1/lumen/bootstrap.min.css",
  "readable"   => "//netdna.bootstrapcdn.com/bootswatch/3.1.1/readable/bootstrap.min.css",
  "simplex"    => "//netdna.bootstrapcdn.com/bootswatch/3.1.1/simplex/bootstrap.min.css",
  "slate"      => "//netdna.bootstrapcdn.com/bootswatch/3.1.1/slate/bootstrap.min.css",
  "spacelab"   => "//netdna.bootstrapcdn.com/bootswatch/3.1.1/spacelab/bootstrap.min.css",
  "superhero"  => "//netdna.bootstrapcdn.com/bootswatch/3.1.1/superhero/bootstrap.min.css",
  "united"     => "//netdna.bootstrapcdn.com/bootswatch/3.1.1/united/bootstrap.min.css",
  "yeti"       => "//netdna.bootstrapcdn.com/bootswatch/3.1.1/yeti/bootstrap.min.css"
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