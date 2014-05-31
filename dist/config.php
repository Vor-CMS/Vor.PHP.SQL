<?php

$sitename = "Zbee.me";

$stylesheet = "http://bootswatch.com/yeti/bootstrap.min.css";

$source = "hosted";
if ($source === "included") {
  $sources = [
    "html5shiv.js" => "lib/js/html5shiv.js"
  ];
} elseif ($source === "hosted") {
  $sources = [
    "htmlshiv"   => "http://dl.zbee.me/html5shiv.js",
    "respond"    => "http://dl.zbee.me/respond.min.js",
    "bootstrap"  => "//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"
  ];
}

?>