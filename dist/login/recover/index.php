<?php

require "../../header.php";
if (!$all) { require "../../allFiles.php"; } #Include all other files so that any page can do any primary function of the system

$session = session(); #Use the session function to add all information about the user to the session variable

if (verifySession() === true) { redirect301("//".$domain."/login?alreadyloggedin"); } #If the session was correctly verified, redirect them to the home page, they don't need 2 accounts

if (isset($_GET['recoversent'])) { $error = '<div class="alert alert-success">An email with a link to recover your account was sent to your email address.</div>'; }
if (isset($_GET['badBlob']) || isset($_GET['noBlob'])) { $error = '<div class="alert alert-warning">The recovery url you used is not valid.</div>'; }
if (isset($_GET['fail']) && $_GET['fail'] === 'email') { $error = '<div class="alert alert-warning">Entered email does not match what we have on record.</div>'; }
if (isset($_GET['fail']) && $_GET['fail'] === 'username') { $error = '<div class="alert alert-warning">Entered username does not match one we have on record.</div>'; }

?>
<div class="col-md-4 col-md-offset-4">
  <?php echo $error; ?>
  <form role="form" method="post" action="../recovery.php?url=<?php echo urlencode(currentURL()); ?>">
  <div class="form-group">
  <label for="u">Username</label>
  <input type="text" class="form-control" id="u" name="u" placeholder="Username">
  </div>
  <div class="form-group">
  <label for="e">Email</label>
  <input type="email" class="form-control" id="e" name="e" placeholder="email">
  </div>
  <button type="submit" class="btn btn-sm btn-default">Recover</button>
  </form>
</div>