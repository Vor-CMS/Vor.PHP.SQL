<?php

require "../allFiles.php"; #Include all other files so that any page can do any primary function of the system

$session = session(); #Use the session function to add all information about the user to the session variable

if (!$setup) { $error .= '<div class="alert alert-info">Please setup the login system.</div>'; } #If the system is not setup, prompt them to set it up

if (verifySession() === true) { redirect301("//".$domain."/login?alreadyloggedin"); } #If the session was correctly verified, redirect them to the home page, they don't need 2 accounts

if (isset($_GET['fail']) && $_GET['fail'] === 'email') { $error = '<div class="alert alert-warning">Entered email does not match what we have on record.</div>'; }
if (isset($_GET['fail']) && $_GET['fail'] === 'username') { $error = '<div class="alert alert-warning">Entered username does not match one we have on record.</div>'; }

?>
<!DOCTYPE html>
<html>
	<head>
		<title>Recovery Page</title>
		<link rel="stylesheet" href="<?php echo $stylesheet; ?>">
		<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
	</head>
	<body>
		<div class="container" style="margin-top:30px">
			<div class="col-md-4 col-md-offset-4">
				<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">
						<strong>Recover Your Account</strong>
					</h3>
				</div>
				<div class="panel-body">
					<?php echo $error; ?>
					<form role="form" method="post" action="recovery.php?url=<?php echo urlencode(currentURL()); ?>">
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
				</div>
			</div>
		</div>
	</body>
</html>