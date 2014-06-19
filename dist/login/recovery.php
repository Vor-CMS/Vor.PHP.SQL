<?php

$pageDyn = [
  "title" => "Recover Your Account"
];
require "../header.php";
if (!$all) { require "../allFiles.php"; } #Include Functions if they're not already here

if (!isset($_GET['blob'])) { #If the blob variable is not set in the url
	if (isset($_POST['u']) && isset($_POST['e'])) { #If the username and email were entered for a user
		#Username
		$u       = sanitize($_POST['u']);
		$uR      = numberOfRows("users", "username", $u);
		
		#Email
		$e       = strtolower(sanitize($_POST['e']));
    $ce      = $e;
    if ($apps['encryption'] === true) { $e = encrypt($e, $u); }
		$rE      = strtolower(session($u)['email']);
		
		#Blob
		$b       = hash("sha256", $u."recover account".substr(str_shuffle(str_repeat("1234567890", 7)), 1, 20)); #Make a 20 character blob for recovery (sent to the user to click)
		$b       = $b.md5($u.$b);
		
		#Time
		$t       = time();
		
		if ($uR == 1) { #If there is a user with that username
			if ($e === $rE) { #If the entered email is equal to the actual email of the user
				insertUserBlob($u, $b, 'recover'); #Actually insert the blob

				$to      = $ce; #Send to the email
				$subject = 'Finish Recovering Your '.$sitename.' Account'; #Set the subject of the email
				$message = "
Hello {$u}

You have received this message because you -or someone pretending to be you- recently attempted to recover your {$sitename} account.

If this WAS you, please follow this link in order to reset your password:
//{$domain}/login/recovery.php?blob={$b}

======

If this was not you, we advise that you update your password on at least {$sitename} immediately.

Thank you"; #Set the text of the message
				$headers = 'From: noreply@'.$domain_simple."\r\n" .
					'Reply-To: support@'.$domain_simple."\r\n" .
					'X-Mailer: PHP/' . phpversion(); #Set the headers of the email

				mail($to, $subject, $message, $headers); #Send the message
				redirect301("//{$domain}/login/recover?recoversent"); #Redirect to the home page saying the account recovery email was sent
			} else { #If the entered email did not match the user's actual email
				redirect301("//{$domain}/login/recover?fail=email"); #Redirect to the home page stating the problem
			}
		} else { #If there was not a matching user
			redirect301("//{$domain}/login/recover??fail=username"); #Redirect to the home page stating the problem
		}
	}
} elseif (isset($_GET['blob'])) { #If there is a blob set in the url (example.com?blob=)
	$query = mysql_query("SELECT * FROM userblobs WHERE code='".$_GET['blob']."' AND date<'".strtotime('+3 days')."' AND action='recover'"); #Find the matching blob
	$numrows = mysql_num_rows($query);
	if ($numrows === 1) { #If the blob was found
		while($value = mysql_fetch_array($query)) { $username = $value['user']; $uname = $username; }
    if (isset($_GET['match'])) { $error .= "<div class='alert alert-warning'>The entered passwords must match</div>"; }
    echo '
			<div class="col-md-4 col-md-offset-4">
				<div class="login-panel panel panel-default">
					<div class="panel-body">
					'.$error.'
					<form class="form" method="post" action="#">
            <div class="form-group" id="Field1Group">
              <label class="control-label" for="Field1">New Password</label>
              <input type="password" id="Field1" class="form-control" name="p">
            </div>
            <div class="form-group" id="Field2Group">
              <label class="control-label" for="Field2">Confirm New Password</label>
              <input type="password" id="Field2" class="form-control" name="cp">
            </div>
					  <input type="submit" class="btn btn-primary btn-block button btn-lg" value="Reset Password"></input>
					</form>
					</div>
				</div>
			</div>
		'; #Echo the page to change the password
		if (isset($_POST['p']) && isset($_POST['cp'])) { #If the new passwords were entered
      $session = session();
			$q       = $_POST['p'];
      $w       = $_POST['cp'];
      
      if ($q === $w) { #If the entered passwords match
        $ns      = hash("sha256", "new salt: recovery".substr(str_shuffle(str_repeat("abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@$%^&_+{}[]:<.>?", 27)), 1, 32)); #Make a new salt for the user
        $date    = time();
        $action  = "sql";
        $item    = "oldpassword";
        $answer  = session()['password']; #Setting the old pasword to be set in the database
        $newpass = hash("sha256", $q.$ns); #Hash the new password with the new salt
        $extra   = ", password='".$newpass."', passwordchanged='".$date."', oldsalt='".$session['salt']."', salt='".$ns."'"; #Extra SQL for the query

        $to      = session()['email']; #Send the alert to the user
        if ($apps['encryption'] === true) { $to = decrypt(session()['email'], $u); } #Decrypts the user's email if encryption is turned on
        $subject = 'Your password on '.$sitename.' has changed!'; #Sets the message's subject
        $message = '
  Hello '.$session['username'].'

  You have received this message because your password was recently changed on '.$sitename.' through way of recovering your account.

  ======

  If this was not you, we advise that you update your password on at least '.$sitename.' immediately.

  Thank you'; #Sets the content of the message
        $headers = 'From: noreply@'.$domain_simple."\r\n" .
          'Reply-To: support@'.$domain_simple."\r\n" .
          'X-Mailer: PHP/' . phpversion(); #Sets the header of the message

        mail($to, $subject, $message, $headers); #Sends the message
        mysql_query("UPDATE users SET $item='$answer'".$extra." WHERE id='".$id."'"); #Update the user
        redirect301("//{$domain}/login?recovered"); #Redirect to the home page saying the account was recovered
        mysql_query("DELETE FROM userblobs WHERE code='".$_GET['blob']."' AND action='recover' LIMIT 1"); #Delete the currently set blob from the database
      } else { #If the entered passwords do not match
        redirect301(currentURL()."&match");
      }
    }
	} else { #If blob was not found
    redirect301("//{$domain}/login/recover?badBlob");
  }
} else { #If no blob was found
  redirect301("//{$domain}/login/recover?noBlob");
}
?>
	
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>
	<script type="text/javascript">
	/*Inline Validation created by Matthew Turner*/
	var clearValidity=function(e){e=typeof e==="string"?$(e):e;if(e.hasClass("has-success")){e.removeClass("has-success")}if(e.hasClass("has-error")){e.removeClass("has-error")}};var makeValid=function(e){e=typeof e==="string"?$(e):e;clearValidity(e);if(!e.hasClass("has-success")){e.addClass("has-success")}};var makeInvalid=function(e){e=typeof e==="string"?$(e):e;clearValidity(e);if(!e.hasClass("has-error")){e.addClass("has-error")}};var doMatch=function(e,t){e=typeof e==="string"?$(e):e;t=typeof t==="string"?$(t):t;var n=e.val();var r=t.val();return n===r};var validateFields=function(e,t,n,r){e=typeof e==="string"?$(e):e;t=typeof t==="string"?$(t):t;n=typeof n==="string"?$(n):n;r=typeof r==="string"?$(r):r;var i=e.val();if(i.length>0){if(doMatch(e,t)){makeValid(n);makeValid(r);if($(".button").hasClass("disabled")){$(".button").removeClass("disabled")}}else{makeInvalid(n);makeInvalid(r);$(".button").addClass("disabled")}}else{clearValidity(n);clearValidity(r)}};$(document).ready(function(){var e=$("#Field1");var t=$("#Field2");e.keyup(function(){validateFields(e,t,"#Field1Group","#Field2Group")});t.keyup(function(){validateFields(e,t,"#Field1Group","#Field2Group")})})
	</script>