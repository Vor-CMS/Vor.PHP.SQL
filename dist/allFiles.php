<?php
ob_start(); #Just in case there are redirects that would normally get loaded after the headers for some reason
$all = true; #Making sure the included files know that they're all being included together
require "config.php"; #This is only variables, it needs to be included all the time
if (!$functions_included) { require "functions.php"; }
?>