<?php

$pageDyn = [
  "title" => "Admin Panel"
];

require "../header.php";

if (verifySession() !== true) { redirect301("//{$domain}?url=".currentURL()); }

?>

<?php
require "../footer.php";
?>