<?php

if (!$all) { require "../allFiles.php"; } #Include Functions if they're not already here

$u = session()['username']; #Gets the current user's username
if (!isset($_GET['url'])) { $url = "//".$domain; } else { $url = urldecode($_GET['url']); } #If a redirect url is not set, set it to be the domain root

session_start(); #In case the user information was put in a session, pick up the session
session_destroy(); #Now destroy that entire session

mysql_query("DELETE FROM userblobs WHERE code='".$_COOKIE[str_replace(".", "", $sitename)]."' AND action='session' LIMIT 1"); #Delete the current session blob

if (isset($_GET['all'])) { #If every single session is supposed to be destroyed
  mysql_query("DELETE FROM userblobs WHERE user='".$u."' and action='session'"); #Destroy ever associated session blob
}

setcookie(str_replace(".", "", $sitename), $hash, strtotime('-30 days'), "/", $simpledomain); #Destroy the cookie by outdating it
redirect301($url); #Redirect to the desired url

?>