<?php

$pageDyn = [
  "title" => "User Control Panel"
];

require "../header.php"; #Include all other files so that any page can do any primary function of the system

if (verifySession() !== true) { redirect301("//{$domain}?url=".currentURL()); }

if (isset($_GET['fail']) && $_GET['fail'] === "match") { $error = '<div class="alert alert-warning">Entered fields did not match.</div>'; } 

?>

<?php echo $error; ?>

<div class="row">
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
            if ($value['code'] === $_COOKIE[str_replace(".", "", $sitename)]) { $highlight .= " warning'"; $info .= '<abbr title="This is your current session">?</abbr> '; }
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

</div>

<div class="row">

  <div class="col-md-4">

    <div class="panel panel-default">

      <div class="panel-heading">

        <h3 class="panel-title">

          <strong>Pick your preferred theme</strong>

        </h3>

      </div>

      <div class="panel-body text-center">
      
        <div class="col-sm-12">
          <div class="alert alert-success" id="changesuccess">
            The theme changed successfully.
          </div>
        </div>
        <div class="col-sm-12">
          <div class="alert alert-success" id="changefailure">
            The theme changed <strong>un</strong>successfully.
          </div>
        </div>
        
        <div class="btn-group col-sm-12">
          <button class="btn btn-primary col-sm-12 dropdown-toggle" data-toggle="dropdown"><span id="themename">
          <?php
          $query = mysql_query("SELECT theme FROM users WHERE username='".$session['username']."'");
          while ($value = mysql_fetch_array($query)) { echo ucfirst($value['theme']); }
          ?>
          </span> <span class="caret"></span></button>
          <ul class="dropdown-menu" role="menu" style="max-height:300px;overflow:auto;margin-left:20px;">
            <li><a href="#" id="default">Default</a></li>
            <li class="divider"></li>
            <li><a href="#" id="amelia">Amelia</a></li>
            <li><a href="#" id="cerulean">Cerulean</a></li>
            <li><a href="#" id="cosmo">Cosmo</a></li>
            <li><a href="#" id="cyborg">Cyborg</a></li>
            <li><a href="#" id="darkly">Darkly</a></li>
            <li><a href="#" id="flatly">Flatly</a></li>
            <li><a href="#" id="journal">Journal</a></li>
            <li><a href="#" id="lumen">Lumen</a></li>
            <li><a href="#" id="readable">Readable</a></li>
            <li><a href="#" id="simplex">Simplex</a></li>
            <li><a href="#" id="slate">Slate</a></li>
            <li><a href="#" id="spacelab">Spacelab</a></li>
            <li><a href="#" id="superhero">Superhero</a></li>
            <li><a href="#" id="united">United</a></li>
            <li><a href="#" id="yeti">Yeti</a></li>
          </ul>
        </div>
        
        <script type="text/javascript">
        $("#changesuccess").hide();
        $("#changefailure").hide();
        
        $("#default").click(function() {
          $.ajax({
            type: "POST",  
            url: 'backend.php',
            data: {theme:'default'},
            dataType: "json",
            context: document.body,
            async: true,
            success: function(res, stato) {
              if (res.success == "1") {
                $("#changesuccess").show();
                $("#themename").html("Default");
                window.location.reload();
              } else {
                $("#changefailure").show();
              }
            }
          });
        });
        $("#amelia").click(function() {
          $.ajax({
            type: "POST",  
            url: 'backend.php',
            data: {theme:'amelia'},
            dataType: "json",
            context: document.body,
            async: true,
            success: function(res, stato) {
              if (res.success == "1") {
                $("#changesuccess").show();
                $("#themename").html("Amelia");
                window.location.reload();
              } else {
                $("#changefailure").show();
              }
            }
          });
        });
        $("#cerulean").click(function() {
          $.ajax({
            type: "POST",  
            url: 'backend.php',
            data: {theme:'cerulean'},
            dataType: "json",
            context: document.body,
            async: true,
            success: function(res, stato) {
              if (res.success == "1") {
                $("#changesuccess").show();
                $("#themename").html("Cerulean");
                window.location.reload();
              } else {
                $("#changefailure").show();
              }
            }
          });
        });
        $("#cosmo").click(function() {
          $.ajax({
            type: "POST",  
            url: 'backend.php',
            data: {theme:'cosmo'},
            dataType: "json",
            context: document.body,
            async: true,
            success: function(res, stato) {
              if (res.success == "1") {
                $("#changesuccess").show();
                $("#themename").html("Cosmo");
                window.location.reload();
              } else {
                $("#changefailure").show();
              }
            }
          });
        });
        $("#cyborg").click(function() {
          $.ajax({
            type: "POST",  
            url: 'backend.php',
            data: {theme:'cyborg'},
            dataType: "json",
            context: document.body,
            async: true,
            success: function(res, stato) {
              if (res.success == "1") {
                $("#changesuccess").show();
                $("#themename").html("Cyborg");
                window.location.reload();
              } else {
                $("#changefailure").show();
              }
            }
          });
        });
        $("#darkly").click(function() {
          $.ajax({
            type: "POST",  
            url: 'backend.php',
            data: {theme:'darkly'},
            dataType: "json",
            context: document.body,
            async: true,
            success: function(res, stato) {
              if (res.success == "1") {
                $("#changesuccess").show();
                $("#themename").html("Darkly");
                window.location.reload();
              } else {
                $("#changefailure").show();
              }
            }
          });
        });
        $("#flatly").click(function() {
          $.ajax({
            type: "POST",  
            url: 'backend.php',
            data: {theme:'flatly'},
            dataType: "json",
            context: document.body,
            async: true,
            success: function(res, stato) {
              if (res.success == "1") {
                $("#changesuccess").show();
                $("#themename").html("Flatly");
                window.location.reload();
              } else {
                $("#changefailure").show();
              }
            }
          });
        });
        $("#journal").click(function() {
          $.ajax({
            type: "POST",  
            url: 'backend.php',
            data: {theme:'journal'},
            dataType: "json",
            context: document.body,
            async: true,
            success: function(res, stato) {
              if (res.success == "1") {
                $("#changesuccess").show();
                $("#themename").html("Journal");
                window.location.reload();
              } else {
                $("#changefailure").show();
              }
            }
          });
        });
        $("#lumen").click(function() {
          $.ajax({
            type: "POST",  
            url: 'backend.php',
            data: {theme:'lumen'},
            dataType: "json",
            context: document.body,
            async: true,
            success: function(res, stato) {
              if (res.success == "1") {
                $("#changesuccess").show();
                $("#themename").html("Lumen");
                window.location.reload();
              } else {
                $("#changefailure").show();
              }
            }
          });
        });
        $("#readable").click(function() {
          $.ajax({
            type: "POST",  
            url: 'backend.php',
            data: {theme:'readable'},
            dataType: "json",
            context: document.body,
            async: true,
            success: function(res, stato) {
              if (res.success == "1") {
                $("#changesuccess").show();
                $("#themename").html("Readable");
                window.location.reload();
              } else {
                $("#changefailure").show();
              }
            }
          });
        });
        $("#simplex").click(function() {
          $.ajax({
            type: "POST",  
            url: 'backend.php',
            data: {theme:'simplex'},
            dataType: "json",
            context: document.body,
            async: true,
            success: function(res, stato) {
              if (res.success == "1") {
                $("#changesuccess").show();
                $("#themename").html("Simplex");
                window.location.reload();
              } else {
                $("#changefailure").show();
              }
            }
          });
        });
        $("#slate").click(function() {
          $.ajax({
            type: "POST",  
            url: 'backend.php',
            data: {theme:'slate'},
            dataType: "json",
            context: document.body,
            async: true,
            success: function(res, stato) {
              if (res.success == "1") {
                $("#changesuccess").show();
                $("#themename").html("Slate");
                window.location.reload();
              } else {
                $("#changefailure").show();
              }
            }
          });
        });
        $("#spacelab").click(function() {
          $.ajax({
            type: "POST",  
            url: 'backend.php',
            data: {theme:'spacelab'},
            dataType: "json",
            context: document.body,
            async: true,
            success: function(res, stato) {
              if (res.success == "1") {
                $("#changesuccess").show();
                $("#themename").html("Spacelab");
                window.location.reload();
              } else {
                $("#changefailure").show();
              }
            }
          });
        });
        $("#superhero").click(function() {
          $.ajax({
            type: "POST",  
            url: 'backend.php',
            data: {theme:'superhero'},
            dataType: "json",
            context: document.body,
            async: true,
            success: function(res, stato) {
              if (res.success == "1") {
                $("#changesuccess").show();
                $("#themename").html("Superhero");
                window.location.reload();
              } else {
                $("#changefailure").show();
              }
            }
          });
        });
        $("#united").click(function() {
          $.ajax({
            type: "POST",  
            url: 'backend.php',
            data: {theme:'united'},
            dataType: "json",
            context: document.body,
            async: true,
            success: function(res, stato) {
              if (res.success == "1") {
                $("#changesuccess").show();
                $("#themename").html("United");
                window.location.reload();
              } else {
                $("#changefailure").show();
              }
            }
          });
        });
        $("#yeti").click(function() {
          $.ajax({
            type: "POST",  
            url: 'backend.php',
            data: {theme:'yeti'},
            dataType: "json",
            context: document.body,
            async: true,
            success: function(res, stato) {
              if (res.success == "1") {
                $("#changesuccess").show();
                $("#themename").html("Yeti");
                window.location.reload();
              } else {
                $("#changefailure").show();
              }
            }
          });
        });
        </script>
        
      </div>

    </div>

  </div>

</div>

<?php
require "../footer.php";
?>