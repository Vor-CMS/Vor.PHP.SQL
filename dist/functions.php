<?php

if (!$all) { require "config.php"; } #Include Functions if they're not already here
if ($apps['encryption'] === "true") { require "encryption/functions.php"; }

#currentURL()
#Gets the current page's full url
function currentURL() {
	return htmlentities(trim(strip_tags(htmlspecialchars("//$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"))));
}

#numberOfRows("users", "username", $enteredUsername)
#Would return the number of users with the entered username
function numberOfRows($table, $thing = false, $answer = false) {
	if (!$thing && !$answer) {
		$query = mysql_query("SELECT * FROM $table");
	} else {
		$query = mysql_query("SELECT * FROM $table WHERE $thing='$answer'");
	}

	$numrows = mysql_num_rows($query);
	return $numrows;
}

#insertUserBlob("bob", "rmt9c84htnqy54h78tcy54hmgtx", "2step")
#Would insert a user blob for "bob" with the code stated above, and set it as a 2step blob
function insertUserBlob($username, $hash, $action="session", $ip=false) {
  if (!$ip) { $ip = $_SERVER['REMOTE_ADDR']; }
	$time  = time();
	$query = mysql_query("INSERT INTO userblobs (user, code, action, date, ip) VALUES ('$username', '$hash', '$action', '$time', '$ip')");
}

#banCheck("127.0.0.1", "bob)
#Would check if "bob" at "127.0.0.1" is banned
function banCheck($ip, $username = false) {
	$query = mysql_query("SELECT * FROM ban WHERE ip='$ip'"); if (!$query) { return "sql"; }
	while($value = mysql_fetch_array($query)) {
		if ($value['appealed'] === "0") {
			$thing = true;
		} else {
			$thing = false;
		}
	}

	if ($username !== false) {
		$query2 = mysql_query("SELECT * FROM ban WHERE username='$username'"); if (!$query2) { return "sql"; }
		while($value = mysql_fetch_array($query2)) {
			if ($value['appealed'] == "0") {
				if ($thing === false) { $thing = true; } else {$thing = false; } 
			} else {
				$thing = false;
			}
		}
	}
	
	return $thing;
}

#verifySession("rkjgncuguqix4bguiq4mbgu")
#Verifies the session with the stated code
function verifySession($session = false) {
	require "config.php";
	if (!$session) { $session = $_COOKIE[str_replace(".", "", $sitename)]; }
	$time    = strtotime('+30 days');
  $ip      = $_SERVER['REMOTE_ADDR'];
	$query   = mysql_query("SELECT * FROM userblobs WHERE code='$session' AND date<='$time' AND action='session' AND ip='$ip'");
	$numrows = mysql_num_rows($query);
	while($value = mysql_fetch_array($query)) { $username = $value['user']; }

	$tamper  = substr($session, -32);

	if ($numrows >= 1) {
		if (md5($username.substr($session, 0, 64)) === $tamper) {
			if (banCheck($_SERVER['REMOTE_ADDR']) == false) {
				return true;
			} else {
				return "ban";
			}
		} else {
			return "tamper";
			mysql_query("DELETE FROM userblobs WHERE code='$session' AND action='session' LIMIT 1");
		}
	} else {
    return "session";
	}
}

function sanitize($data) {
	return @mysql_real_escape_string($data);
}

#redirect301("http://example.com")
#Would redirect the user or bot to "http://example.com" and set the correct HTTP error so the bot will follow the page
function redirect301($url) {
	header("HTTP/1.1 301 Moved Permanently"); 
	header("Location: ".$url);  
}
 
#session("bob")
#Will get the whole user array for the user "bob"
function session($session = false) { #Function to get all information about a user and return it in an array
  require "config.php";
	if (!$session) { #If the function was used without a username stated
		$session = $_COOKIE[str_replace(".", "", $sitename)];
		$time    = strtotime( '+30 days' );
		
    $sql = "SELECT * FROM userblobs WHERE code='$session' AND date<'$time' AND action='session'";
		$query = mysql_query($sql); #Find blobs where the code is equal to the session, is not expired, and is a session blob
		$numrows = mysql_num_rows($query);
		while($value = mysql_fetch_array($query)) { $username = $value['user']; }
		
		if ($numrows === 1) { #If there was a blob that matched perfectly
			$query = mysql_query("SELECT * FROM users WHERE username='$username'"); #Finds the user in the users table with the username attached to the blob
			while($value = mysql_fetch_array($query)) {
				return $value; #Return the whole array of the found user
			}
		} else {
			return false; #If there's no matching user, tell the system it broke
		}
	} else { #If the function was used with a username declared
    $sql = "SELECT * FROM users WHERE username='$session'";
		$query = mysql_query($sql);  #Find the user with the provided username
		$numrows = mysql_num_rows($query);
		if ($numrows === 1) { #If there is a matching user 
			while($value = mysql_fetch_array($query)) {
				return $value; #Return the whole array of the found user
			}
		} else {
			return false; #If there's no matching user, tell the system it broke
		}
	}
}

?>