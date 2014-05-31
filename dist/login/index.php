<?php
require "../allFiles.php"; #Include all other files so that any page can do any primary function of the system

$session = session(); #Use the session function to add all information about the user to the session variable

if (verifySession() === true) { $error .= '<div class="alert alert-success">You\'re logged in as: '.$session['username'].'</div>'; } #If the session was correctly verified, display a message saying the user is logged in

#Error displaying: Checks the URL to see if any of them are set
if (isset($_GET['activate'])) { $error = '<div class="alert alert-warning">Your account is not activated. Please check your email.</div>'; } 
if (isset($_GET['ActivateFail']) || isset($_GET['ActivateMissing'])) { $error = '<div class="alert alert-warning">The Activation link you tried was invalid.</div>'; }
if (isset($_GET['old'])) { $error = '<div class="alert alert-warning">Your account has been logged out due to inactivity.</div>'; } 
if (isset($_GET['ban'])) { $error = '<div class="alert alert-warning">Your account is currently banned.</div>'; } 
if (isset($_GET['oldpass'])) { $error = '<div class="alert alert-warning">You just tried to use your old password.<br>You changed your password on '.date("Y-m-j gA", $_GET['passwordchanged']).'.</div>'; } 
if (isset($_GET['wrongpass'])) { $error = '<div class="alert alert-warning">That password is wrong.</div>'; } 
if (isset($_GET['wrongusername'])) { $error = '<div class="alert alert-warning">There is no user with that username.</div>'; } 
if (isset($_GET['oldusername'])) { $error = '<div class="alert alert-warning">You just tried to use your old username.</div>'; } 
if (isset($_GET['firstusername'])) { $error = '<div class="alert alert-warning">You just tried to use your first username.</div>'; } 
if (isset($_GET['2Step'])) { $error = '<div class="alert alert-info">An email has been sent to your email to finish logging in.</div>'; } 
if (isset($_GET['StepFail'])) { $error = '<div class="alert alert-warning">The 2Step link you tried was invalid.</div>'; }
if (isset($_GET['emailchanged'])) { $error = '<div class="alert alert-success">Your email was successfully changed.<br>An email has been sent to both your new one and your old one with a link to reactivate your account.</div>'; } 
if (isset($_GET['alreadycreated'])) { $error = '<div class="alert alert-info">You already have an account on '.$sitename.', you don\'t need another.</div>';  }
if (isset($_GET['acccreated'])) { $error = '<div class="alert alert-success">Your '.$sitename.' account has been created! An email has been sent to you with a link to activate your account.</div>'; } 
if (isset($_GET['failverify'])) { $error = '<div class="alert alert-success">Your account could not be verified.</div>'; } 
if (isset($_GET['recoversent'])) { $error = '<div class="alert alert-success">The recovery email has been sent.</div>'; } 
if (isset($_GET['alreadyloggedin'])) { $error = '<div class="alert alert-info">You are already logged in. You don\'t need to recover an account if you\'re logged in.</div>'; } 
if (isset($_GET['recovered'])) { $error = '<div class="alert alert-success">Your account has been recovered, you may now log in.</div>'; } 
if (isset($_GET['logout'])) { $error = '<div class="alert alert-warning">You have been logged out.</div>'; } 
if (isset($_GET['deleting'])) { $error = '<div class="alert alert-warning">An email has been sent to you to queue your acount for deletion.</div>'; } 
if (isset($_GET['deleted'])) { $error = '<div class="alert alert-warning">Your account has been queued for deletion.</div>'; } 
if (isset($_GET['baddeletecode'])) { $error = '<div class="alert alert-warning">The code you tried to use to delete your account was not correct.</div>'; } 
if (isset($_GET['notSet'])) { $error = '<div class="alert alert-warning">Username and Password were not entered.</div>'; }

?>
<!DOCTYPE html>
<html>
	<head>
		<title>Login Page</title>
		<link rel="stylesheet" href="<?php echo $sources['stylesheet']; ?>">
		<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
	</head>
	<body>
		<div class="container" style="margin-top:30px">
			<div class="col-md-4 col-md-offset-4">
				<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">
						<strong>Sign in</strong>
					</h3>
				</div>
				<div class="panel-body">
					<?php echo $error; ?>
					<form role="form" method="post" action="login.php?url=<?php echo urlencode(currentURL()); ?>">
					<div class="form-group">
					<label for="u">Username</label>
					<input type="text" class="form-control" id="u" name="u" placeholder="Username">
					</div>
					<div class="form-group">
					<label for="p">Password <a href="recover.php">(forgot password)</a></label>
					<input type="password" class="form-control" id="p" name="p" placeholder="Password">
					</div>
					<button type="submit" class="btn btn-sm btn-default">Sign in</button>
					<a href="register.php" class="btn btn-sm btn-default">Register</a>
					</form>
				</div>
				</div>
			</div>
		</div>
	</body>
</html>