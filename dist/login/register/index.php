<?php

require "../../header.php";
if (!$all) { require "../../allFiles.php"; } #Include all other files so that any page can do any primary function of the system

$session = session(); #Use the session function to add all information about the user to the session variable

if (verifySession() === true) { redirect301("//".$domain."/login?alreadycreated"); } #If the session was correctly verified, redirect them to the home page, they don't need 2 accounts

if (isset($_GET['fail']) && $_GET['fail'] === "match") { $error = '<div class="alert alert-warning">Entered passwords do not match.</div>'; } 
if (isset($_GET['fail']) && $_GET['fail'] === "set") { $error = '<div class="alert alert-warning">Not all fields were entered.</div>'; } 

?>
<div class="col-md-4 col-md-offset-4">
  <a href=".." class="btn btn-default">&lt; Login</a>
  <Br><Br>
  <?php echo $error; ?>
  <form class="form" method="post" action="create.php?url=<?php echo urlencode(currentURL()); ?>">
    <div class="form-group well">
      <label class="control-label" for="username">Username</label>
      <input type="text" class="form-control" name="u">
    </div>
    <div class="form-group well">
      <label class="control-label" for="email">Email</label>
      <input type="email" class="form-control" name="e">
    </div>
    <div class="well">
    <div class="form-group" id="Field1Group">
        <label class="control-label" for="Field1">Password</label>
        <input type="password" id="Field1" class="form-control" name="p">
      </div>
      <div class="form-group" id="Field2Group">
        <label class="control-label" for="Field2">Confirm Password</label>
        <input type="password" id="Field2" class="form-control" name="cp">
      </div>
    </div>
    <input type="submit" class="btn btn-primary btn-block button btn-lg" value="Sign Up!">
  </form>
</div>
	
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>
<script type="text/javascript">
/*JQuery made by Matthew Turner of Fractal Noise: Design Studio*/
var clearValidity=function(e){e=typeof e==="string"?$(e):e;if(e.hasClass("has-success")){e.removeClass("has-success")}if(e.hasClass("has-error")){e.removeClass("has-error")}};var makeValid=function(e){e=typeof e==="string"?$(e):e;clearValidity(e);if(!e.hasClass("has-success")){e.addClass("has-success")}};var makeInvalid=function(e){e=typeof e==="string"?$(e):e;clearValidity(e);if(!e.hasClass("has-error")){e.addClass("has-error")}};var doMatch=function(e,t){e=typeof e==="string"?$(e):e;t=typeof t==="string"?$(t):t;var n=e.val();var r=t.val();return n===r};var validateFields=function(e,t,n,r){e=typeof e==="string"?$(e):e;t=typeof t==="string"?$(t):t;n=typeof n==="string"?$(n):n;r=typeof r==="string"?$(r):r;var i=e.val();if(i.length>0){if(doMatch(e,t)){makeValid(n);makeValid(r);if($(".button").hasClass("disabled")){$(".button").removeClass("disabled")}}else{makeInvalid(n);makeInvalid(r);$(".button").addClass("disabled")}}else{clearValidity(n);clearValidity(r)}};$(document).ready(function(){var e=$("#Field1");var t=$("#Field2");e.keyup(function(){validateFields(e,t,"#Field1Group","#Field2Group")});t.keyup(function(){validateFields(e,t,"#Field1Group","#Field2Group")})})
</script>