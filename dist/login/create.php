<?php

if (!$all) { require "allFiles.php"; } #Include Functions if they're not already here

if (isset($_POST['u']) && isset($_POST['e']) && isset($_POST['p']) && isset($_POST['cp'])) { #If a username, email, password, and confirm password are all psoted
	#Username
	$u       = sanitize($_POST['u']);
	
	#Email
	$e       = sanitize($_POST['e']);
	if ($apps['encryption'] === true) { $e = encrypt($e, $u); }
	
	#Password
	$p       = sanitize($_POST['p']);
	
	#Confirmed Password
	$c       = sanitize($_POST['cp']);
	
	#Salt
	$s       = hash("sha256", substr(str_shuffle(str_repeat("abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@$%^&_+{}[]:<.>?", 27)), 1, 32)); #Create a salt
	
	#Hashed Password
	$h       = hash("sha256", $p.$s);
	
	#Blob
	$b       = hash("sha256", $u.substr(str_shuffle(str_repeat("1234567890!@#$%^&*()_+-=", 7)), 1, 50)); #Create a blob
	$b       = $b.md5($u.$b); #Make the blob tamper-checkable
	
	#Time
	$t       = time();
	
	#IP
	$i       = $_SERVER['REMOTE_ADDR'];
	if ($apps['encryption'] === true) { $i = encrypt($i, $u); } #Encrypt the IP if encryption is turned on
	
	if ($c === $p) { #If password equals confirm password
			insertUserBlob($u, $b, 'activate'); #Insert blob to activate account
			
			$query = mysql_query("INSERT INTO users (username, permusername, title, email, firstemail, salt, password, date_registered, last_logged_in, old_last_logged_in, passwordchanged, emailchanged, ip, activated, bio, sig, rep, 2step, site) 
			VALUES ('$u', '$u', '', '$e', '$e', '$s', '$h', '$t', '$t', '$t', '$t', '$t', '$i', '0', '', '', '0', '0', '')"); #Insert user in database

			$to      = $e; #Set who the message will go to
			if ($apps['encryption'] === true) { $to = decrypt($e, $u); } #Decrypt the email if required
			$subject = 'Account on '.$sitename.' created! Action Required'; #Set the subject of the email
			$message = "
Hello {$u}

You have received this message because you -or someone pretending to be you- recently registered for an account of ".$sitename.".

If this WAS you, please follow this link in order to activate your account:
//{$domain}{$system_location}/activate.php?blob={$b}

Thank you"; #Set the content of the message
			$headers = 'From: noreply@'.$domain_simple."\r\n" .
				'Reply-To: support@'.$domain_simple."\r\n" .
				'X-Mailer: PHP/' . phpversion(); #Set the headers of the message

			mail($to, $subject, $message, $headers); #Send the message
			
			redirect301("//".$_GET['url']); #Redirect to the desired URL
	} else { #If the password does not equal the confirm password
		redirect301("//".$domain."/register.php?fail=match"); #Redirect to a failure page
	}
} else { #If all those things were not set, lead the user away
  redirect301("//".$domain."/".$registration_page."?fail=set"); #Redirect to a failure page
}

?>