<?php

if (!$all) { require "../allFiles.php"; } #Include Functions if they're not already here

if (isset($_POST['u']) && isset($_POST['p'])) { #If a username and password were entered
    $username  = sanitize($_POST['u']); #Setting up variables
    $good      = true;
    $banned    = false;
    
    if (isset($_GET['url'])) { $url = urldecode($_GET['url']); } else { $url = "//".$domain; } #If a redirect url isn't set, set one
    
    $numrows1  = numberOfRows("ban", "username", $username); #Searches through the bans table to see if the username was banned
    $numrows2  = numberOfRows("ban", "ip", $_SERVER['REMOTE_ADDR']); #Searches through the bans table to seee if the ip was banned
    
    if ($numrows1 >= 1 || $numrows2 >= 1) { #If either the IP or the username was found in the bans table
        $banCheck = banCheck($_SERVER['REMOTE_ADDR'], $username); #Check if the ban was appealed or not
        if ($banCheck === false) { #If it was excused
            $banned = false;
        } else { #If it wasn't excused
            $banned = true;
            $good = false;
            redirect301("//{$domain}?ban&url=".$url); #Redirect the user to the login page saying they were banned
        }
    }
    
    if (numberOfRows("users", "username", $username) === 1) { #If there is a user with that matching name
      $session   = session($username); #Gets user information based off of the entered username
      $password  = $session['password']; #Their actual current password
      $salt      = $session['salt']; #Their current salt
      $oldsalt   = $session['oldsalt']; #Their old salt
      $pass      = hash("sha256", $_POST['p'].$salt); #Hash their password
      $oldpass   = hash("sha256", $_POST['p'].$oldsalt); #Hash their password with the old salt
      $activated = $session['activated']; #User activation status
      $tstep     = $session['2step']; #User 2step status
        
      if ($pass === $password) { #If the hashed password is the same as their current password
        if ($activated === "1") { #If they're activated
          if ($tstep === '0') { #If 2step is off
            $good = true;
            
            $query = mysql_query("SELECT * FROM users WHERE username='".$username."' AND password='".$pass."'"); #Make sure there's a user with that username and password
            $numrows3 = mysql_num_rows($query);
            if ($numrows3 === 1 && $good = true) { #IF there is
              while($value = mysql_fetch_array($query)) {
                $date   = time();
                $ip     = $_SERVER['REMOTE_ADDR'];
                if ($apps['encryption'] === true) { $ip = encrypt($ip, $username); } #Encrypts the current IP if encryption is turned on
                
                $query3 = mysql_query("UPDATE users SET last_logged_in='$date', old_last_logged_in='".$value['last_logged_in']."', ip='$ip' WHERE id='".$value['id']."'"); #Updates the user a little bit
                
                $hash   = hash("sha256", "Logged in".$username."session".substr(str_shuffle(str_repeat("1234567890", 7)), 1, 20)); #Create a session blob
                $hash   = $hash.md5($username.$hash); #Make tamper checking the blob possible
                
                insertUserBlob($username, $hash, "session", $ip); #Insert the session blob
                setcookie(str_replace(".", "", $sitename), $hash, strtotime('+30 days'), "/", $simpledomain); #Create a session cookie
                
                redirect301($url); #Redirect to the desired url
              }
            } else { #If there was not a user with the entered username and password
              redirect301("//{$domain}/login?badcombo&url=".$url); #Redirect the user to a page where they get told
            }
          }  else { #If 2step is on
            $hash = hash("sha256", "2step".$username.substr(str_shuffle(str_repeat("12345678907", 11)), 1, 25)); #Create a 2step blob
            $hash = $hash.md5($u.$hash); #Make tamper checking possible
            insertUserBlob($username, $hash, "2Step"); #Insert 2step blob
            $to      = session($username)['email']; #Send an email to the user
            if ($apps['encryption'] === true) { $to = encrypt(session($username)['email'], $u); } #Decrypts the user's email if encryption is turned on
            $subject = 'Finish logging into '.$sitename; #Sets the subject of the email
            $message = '
Hello {$username}

You have received this message because you -or someone pretending to be you- recently attempted to log into your account.

To finish logging in, follow this link:
//{$domain}/login/2step.php?blob={$hash}&url={$url}

======

If this was not you, we advise that you update your password on at least {$sitename} immediately.

Thank you'; #Sets the content of the email
            $headers = 'From: noreply@'.$domain_simple."\r\n" .
              'Reply-To: support@'.$domain_simple."\r\n" .
              'X-Mailer: PHP/' . phpversion(); #Sets the headers of the email

            mail($to, $subject, $message, $headers); #Send the email to the user
            redirect301("//{$domain}/login?2Step&url=".$url); #Redirect to the desired url
          }
        } else { #If the user is not activated
          redirect301("//{$domain}/login?activate&url=".$url); #Redirect the user to a page where they get told
        }
      } elseif ($oldpass === session("oldpassword", $_POST['name'])) { #If the hashed password (using the old salt) equals the user's last password
        redirect301("//{$domain}/login?oldpass=".$session['passwordchanged']."&url=".$url); #Redirect the user to a page where they get told
      } else { #If the password does not equal the user's current password
        redirect301("//{$domain}/login?wrongpass&url=".$url); #Redirect the user to a page where they get told
      }
    } elseif (numberOfRows("users", "oldusername", $_POST['name']) === 1) { #If the entered username equals someone's old username
        redirect301("//{$domain}/login?oldusername&url=".$url); #Redirect the user to a page where they get told
    } elseif (numberOfRows("users", "permusername", $_POST['name']) === 1) { #If the entered username equals someone's first username
        redirect301("//{$domain}/login?firstusername&url=".$url); #Redirect the user to a page where they get told
    } else { #If the entered username equals no username in the database
        redirect301("//{$domain}/login?wrongusername&url=".$url); #Redirect the user to a page where they get told
    }
} else { #If password and username are not set
  redirect301("//{$domain}/login?notSet&url={$url}"); #Redirect to an error page
}

?>