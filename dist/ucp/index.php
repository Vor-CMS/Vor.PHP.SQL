<?php

$pageDyn = [
  "title" => "User Control Panel"
];

require "../header.php"; #Include all other files so that any page can do any primary function of the system

if (verifySession() !== true) { redirect301("//{$domain}?url=".currentURL()); }

if (isset($_GET['fail']) && $_GET['fail'] === "match") { $error = '<div class="alert alert-warning">Entered fields did not match.</div>'; } 

?>

<?php echo $error; ?>

<div class="col-md-4">

  <div class="panel panel-default">

    <div class="panel-heading">

      <h3 class="panel-title">

        <strong>Email</strong>

      </h3>

    </div>

    <div class="panel-body">

      <form class="form" method="post" action="backend.php?email&url=<?php echo urlencode(currentURL()); ?>">

        <div class="form-group">

          <label class="control-label" for="email">New Email</label>

          <input type="email" class="form-control" name="ne">

        </div>

        <div class="form-group">

          <label class="control-label" for="email">Confirm New Email</label>

          <input type="email" class="form-control" name="cne">

        </div>

        <input type="submit" class="btn btn-primary btn-block button btn-lg" value="Change email"></input>

      </form>

    </div>

  </div>

</div>

<div class="col-md-4">

  <div class="panel panel-default">

    <div class="panel-heading">

      <h3 class="panel-title">

        <strong>Password</strong>

      </h3>

    </div>

    <div class="panel-body">

      <form class="form" method="post" action="backend.php.php?pass&url=<?php echo urlencode(currentURL()); ?>">

          <div class="form-group" id="Field1Group">

            <label class="control-label" for="Field1">New Password</label>

            <input type="password" id="Field1" class="form-control" name="np">

          </div>

          <div class="form-group" id="Field2Group">

            <label class="control-label" for="Field2">Confirm New Password</label>

            <input type="password" id="Field2" class="form-control" name="cnp">

          </div>

          <input type="submit" class="btn btn-primary btn-block button btn-lg" value="Change Password"></input>

      </form>

    </div>

  </div>

</div>

<div class="col-md-4">

  <div class="panel panel-default">

    <div class="panel-heading">

      <h3 class="panel-title">

        <strong>Logout</strong>

      </h3>

    </div>

    <div class="panel-body">
    
    <table class="table table-striped table-bordered">
      <tr><th>Date</th><th>IP</th><th>Country</th><th>Link<abbr title="This table shows active sessions for  you account. But, in addition to that it also shows codes attached to your account such as recovery codes. When you click logout, it will delete that code from the database. NOTE: This will only show 25 sessions, if you have more than that, it is recommended that you destroy them all." class="pull-right text-info">?</abbr></th></tr>
      <?php
        $query = mysql_query("SELECT * FROM userblobs WHERE user='".$session['username']."' ORDER BY date DESC LIMIT 25");
        while($value = mysql_fetch_array($query)) {
          $ip = $value['ip'];
          if ($apps['encryption'] === true) { $ip = decrypt($ip, $value['user']); }
          if ($ip === $_SERVER['REMOTE_ADDR']) { $eip = '<abbr title="'.$ip.'">This IP</abbr>'; } else { $eip = $ip; }
          
          $highlight = " class='";
          $info = '';
          if ($value['action'] !== "session") { $highlight .= " info'"; $info .= '<abbr title="This is not a session code, it may be a recovery code, a 2-step login code, or something akin to that." class="text-info">?</abbr> '; }
          if ($value['code'] === $_COOKIE[str_replace(".", "", $sitename)]) { $highlight .= " warning'"; $info .= '<abbr title="This is your current session" class="text-info">?</abbr> '; }
          $highlight .= "'";
          
          echo '<tr'.$highlight.'><td><abbr title="'.date("gA", $value['date']).'">'.date("Y-m-d", $value['date']).'</abbr></td><td>'.$eip.'</td><td><script type="application/javascript">function getgeoip(json){document.write("", "<abbr title=\'" + json.country + "\'>" + json.country_code3 + "</abbr>");}</script><script type="application/javascript" src="http://www.telize.com/geoip/'.$ip.'?callback=getgeoip"></script></td><td><a href="//'.$domain.'/login/logout.php?specific='.$value['code'].'&url='.urlencode(currentURL()).'" class="text-danger">Logout</a> '.$info.'</td></tr>';
        }
      ?>
    </table>
    
    <Br>

      <a href="//<?php echo $domain; ?>/login/logout.php?all&url=<?php echo urlencode(currentURL()); ?>" class="btn btn-md btn-block btn-primary">Logout all sessions</a>

    </div>

  </div>

</div>

<?php
require "../footer.php";
?>