<?php

if (!$all) { require "../allFiles.php"; } #Include Functions if they're not already here

if (isset($_POST['ne']) && isset($_POST['cne']) && isset($_GET['email'])) { #If a new email, a confirmed new email, and the email notifier are all set
  #Setting up the user session
  $session = session();
  $u       = $session['username'];
  $email   = $session['email'];
  $oe      = $session['password'];
  
	#Email
	$e       = sanitize($_POST['ne']);
	if ($encrypt === true) { $e = encrypt($e, $u); }
  
  #Confrim Email
	$c       = sanitize($_POST['cne']);
	if ($encrypt === true) { $c = encrypt($c, $u); }
	
	#Time
	$t       = time();
	
	#IP
	$i       = $_SERVER['REMOTE_ADDR'];
	if ($encrypt === true) { $i = encrypt($i, $u); }
	
	if ($e === $c) { #If the entered new email equals the entered confirmed new email (which it should due to the inline validation code stopping the submission of the form if they don't)
			
			$query = mysql_query("UPDATE users SET email='$e', oldemail='$oe', emailchanged='$t', ip='$i' WHERE username='$u'"); #Updates the user's email
      
			if ($encrypt === true) { $e = decrypt($e, $u); $email = decrypt($e, $u); }
			$to      = $e.", ".$email; #Sends an email to the new and old email
      
			$subject = 'Account on '.$sitename.' edited'; #Sets the subject of that email
			$message = "
Hello {$u}

You have received this message because you -or someone pretending to be you- recently changed your email on ".$sitename.".

======

If this was not you, we advise that you update your password on at least {$sitename} immediately.

Thank you"; #Sets the content of that message
			$headers = 'From: noreply@'.$domain_simple."\r\n" .
				'Reply-To: support@'.$domain_simple."\r\n" .
				'X-Mailer: PHP/' . phpversion(); #Sets the headers of that message

			mail($to, $subject, $message, $headers); #Sends the message
			
			redirect301("//".$_GET['url']); #Redirect to the desired url
	} else { #If the emails did not match
		redirect301("//".$domain."/".$editing_page."?fail=match"); #Redirect to a url letting them know
	}
}

if (isset($_POST['np']) && isset($_POST['cnp']) && isset($_GETT['pass'])) { #If a new password, a confirmation of the new password, and the password notifier are all enabled
  #Setting up the user session
  $session = session();
  $u       = $session['username'];
  $email   = $session['email'];
  $salt    = $session['salt'];
	
	#Password
	$p       = sanitize($_POST['np']);
	
	#Confirmed Password
	$c       = sanitize($_POST['cnp']);
	
	#Salt
	$s       = hash("sha256", substr(str_shuffle(str_repeat("abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@$%^&_+{}[]:<.>?", 27)), 1, 50)); #Make a new salt for the user
	
	#Hashed Password
	$h       = hash("sha256", $p.$s); #Hash the password
	
	#Time
	$t       = time();
	
	#IP
	$i       = $_SERVER['REMOTE_ADDR'];
	if ($encrypt === true) { $i = encrypt($i, $u); } #Encrypt the IP if encryption is turned on
	
	if ($c === $p) {
			
			$query = mysql_query("UPDATE users SET password='$p', oldpassword='$op', passwordchanged='$t', ip='$i', oldsalt='$salt' WHERE username='$u'"); #Updates the user's password
      
			if ($encrypt === true) { $e = decrypt($e, $u); $email = decrypt($e, $u); }
			$to      = $email; #Send an email to the user notifying them of the change
      
			$subject = 'Account on '.$sitename.' edited'; #Sets the subject of that message
			$message = "
Hello {$u}

You have received this message because you -or someone pretending to be you- recently changed your password on ".$sitename.".

======

If this was not you, we advise that you update your password on at least {$sitename} immediately.

Thank you"; #Sets the content of that message
			$headers = 'From: noreply@'.$domain_simple."\r\n" .
				'Reply-To: support@'.$domain_simple."\r\n" .
				'X-Mailer: PHP/' . phpversion(); #Sets the headers of that message

			mail($to, $subject, $message, $headers); #Send the message
			
			redirect301("//".$_GET['url']); #Redirect to the desired URL
	} else { #If the passwords didn't match somehow
		redirect301("//".$domain."/".$editing_page."?fail=match"); #Redirect them to a page to let them know
	}
}

?>