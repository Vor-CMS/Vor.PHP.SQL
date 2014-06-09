<?php
$pageDyn = [
  "title" => "New Page"
];
require "header.php";
if (isset($_GET['url'])) { $url = substr(currentURL(), 0, -(strlen("?url=".$_GET['url']))); redirect301($url); } //If a url to redirect to is set, get rid of it
?>


So much content!
<!--<div id="select"></div>-->


<?php
require "footer.php";
?>