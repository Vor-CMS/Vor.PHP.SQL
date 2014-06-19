<?php

if (!$all) { require "../allFiles.php"; } #Include Functions if they're not already here
if (!$all) { require "../header.php"; }

if (isset($_POST['ne']) && isset($_POST['cne']) && isset($_GET['email'])) { #If a new email, a confirmed new email, and the email notifier are all set
  #Setting up the user session
  $session = session();
  $u       = $session['username'];
  $email   = $session['email'];
  $oe      = $session['email'];
  
	#Email
	$e       = sanitize($_POST['ne']);
	if ($apps['encryption'] === true) { $e = encrypt($e, $u); }
  
  #Confirm Email
	$c       = sanitize($_POST['cne']);
	if ($apps['encryption'] === true) { $c = encrypt($c, $u); }
	
	#Time
	$t       = time();
	
	#IP
	$i       = $_SERVER['REMOTE_ADDR'];
	if ($apps['encryption'] === true) { $i = encrypt($i, $u); }
	
	if ($e === $c) { #If the entered new email equals the entered confirmed new email (which it should due to the inline validation code stopping the submission of the form if they don't)
			
			$query = mysql_query("UPDATE users SET email='$e', oldemail='$oe', emailchanged='$t', ip='$i' WHERE username='$u'"); #Updates the user's email
      
			if ($apps['encryption'] === true) { $e = decrypt($e, $u); $email = decrypt($e, $u); }
			$to      = $e.", ".$email; #Sends an email to the new and old email
      
			$subject = 'Account on '.$sitename.' edited'; #Sets the subject of that email
			$message = "
Hello ".$u."

You have received this message because you -or someone pretending to be you- recently changed your email on ".$sitename.".

======

If this was not you, we advise that you update your password on at least ".$sitename." immediately.

Thank you"; #Sets the content of that message
			$headers = 'From: noreply@'.$domain_simple."\r\n" .
				'Reply-To: support@'.$domain_simple."\r\n" .
				'X-Mailer: PHP/' . phpversion(); #Sets the headers of that message

			mail($to, $subject, $message, $headers); #Sends the message
			
			redirect301("//".$_GET['url']."?success=email"); #Redirect to the desired url
	} else { #If the emails did not match
		redirect301("//".$domain."/ucp?fail=match"); #Redirect to a url letting them know
	}
}

if (isset($_POST['cp']) && isset($_POST['np']) && isset($_POST['cnp']) && isset($_GET['pass'])) { #If a new password, a confirmation of the new password, and the password notifier are all enabled
  
  #Setting up the user session
  $session = session();
  $u       = $session['username'];
  $email   = $session['email'];
  $salt    = $session['salt'];
  
  #Current Password
  $cp      = hash("sha256", sanitize($_POST['cp'].$session['salt']));
	
	#Password
	$p       = sanitize($_POST['np']);
	
	#Confirmed Password
	$c       = sanitize($_POST['cnp']);
	
	#Salt
	$s       = hash("sha256", substr(str_shuffle(str_repeat("abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@$%^&_+{}[]:<.>?", 27)), 1, 50)); #Make a new salt for the user
	
  #Hashed old password
  $op      = $session['password'];
  
	#Hashed Password
	$h       = hash("sha256", $p.$s); #Hash the password
	
	#Time
	$t       = time();
	
	#IP
	$i       = $_SERVER['REMOTE_ADDR'];
	if ($apps['encryption'] === true) { $i = encrypt($i, $u); } #Encrypt the IP if encryption is turned on
	
  if ($cp === $session['password']) {
    if ($c === $p) {
        
        $query = mysql_query("UPDATE users SET password='$h', oldpassword='$op', passwordchanged='$t', ip='$i', salt='$s', oldsalt='$salt' WHERE username='$u'"); #Updates the user's password
        
        if ($apps['encryption'] === true) { $e = decrypt($e, $u); $email = decrypt($e, $u); }
        $to      = $email; #Send an email to the user notifying them of the change
        
        $subject = 'Account on '.$sitename.' edited'; #Sets the subject of that message
        $message = "
Hello ".$u."

You have received this message because you -or someone pretending to be you- recently changed your password on ".$sitename.".

======

If this was not you, we advise that you update your password on at least ".$sitename." immediately.

Thank you"; #Sets the content of that message
        $headers = 'From: noreply@'.$domain_simple."\r\n" .
          'Reply-To: support@'.$domain_simple."\r\n" .
          'X-Mailer: PHP/' . phpversion(); #Sets the headers of that message

        mail($to, $subject, $message, $headers); #Send the message
        
        redirect301("//".$_GET['url']."?success=password"); #Redirect to the desired URL
    } else { #If the passwords didn't match somehow
      redirect301("//".$domain."/ucp?fail=match"); #Redirect them to a page to let them know
    }
  } else {
      redirect301("//".$domain."/ucp?fail=matchc"); #Redirect them to a page to let them know
  }
}

if (isset($_POST['theme'])) {
  $uname = session()["username"];
  switch ($_POST['theme']) { //Make this be a loop to go through the array in config.php, like above
    case "default":
			$query = mysql_query("UPDATE users SET theme='default' WHERE username='$uname'");
      $response["success"] = "1";
      break;
    case "amelia":
			$query = mysql_query("UPDATE users SET theme='amelia' WHERE username='$uname'");
      $response["success"] = "1";
      break;
    case "cerulean":
			$query = mysql_query("UPDATE users SET theme='cerulean' WHERE username='$uname'");
      $response["success"] = "1";
      break;
    case "cosmo":
			$query = mysql_query("UPDATE users SET theme='cosmo' WHERE username='$uname'");
      $response["success"] = "1";
      break;
    case "cyborg":
			$query = mysql_query("UPDATE users SET theme='cyborg' WHERE username='$uname'");
      $response["success"] = "1";
      break;
    case "darkly":
			$query = mysql_query("UPDATE users SET theme='darkly' WHERE username='$uname'");
      $response["success"] = "1";
      break;
    case "flatly":
			$query = mysql_query("UPDATE users SET theme='flatly' WHERE username='$uname'");
      $response["success"] = "1";
      break;
    case "journal":
			$query = mysql_query("UPDATE users SET theme='journal' WHERE username='$uname'");
      $response["success"] = "1";
      break;
    case "lumen":
			$query = mysql_query("UPDATE users SET theme='lumen' WHERE username='$uname'");
      $response["success"] = "1";
      break;
    case "readable":
			$query = mysql_query("UPDATE users SET theme='readable' WHERE username='$uname'");
      $response["success"] = "1";
      break;
    case "simplex":
			$query = mysql_query("UPDATE users SET theme='simplex' WHERE username='$uname'");
      $response["success"] = "1";
      break;
    case "slate":
			$query = mysql_query("UPDATE users SET theme='slate' WHERE username='$uname'");
      $response["success"] = "1";
      break;
    case "spacelab":
			$query = mysql_query("UPDATE users SET theme='spacelab' WHERE username='$uname'");
      $response["success"] = "1";
      break;
    case "superhero":
			$query = mysql_query("UPDATE users SET theme='superhero' WHERE username='$uname'");
      $response["success"] = "1";
      break;
    case "united":
			$query = mysql_query("UPDATE users SET theme='united' WHERE username='$uname'");
      $response["success"] = "1";
      break;
    case "yeti":
			$query = mysql_query("UPDATE users SET theme='yeti' WHERE username='$uname'");
      $response["success"] = "1";
      break;
  }
  echo json_encode($response);
}

?>