<?php
$all = true;
require "allFiles.php";
$session = session();
$userTheme = mysql_query("SELECT * FROM users WHERE username='".$session['username']."'");
while ($value = @mysql_fetch_array($userTheme)) { $userTheme = $value['theme']; }
if ($userTheme !== "default") { $sources['stylesheet'] = $themes[$userTheme]; }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title><?php echo $sitename; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?php echo $sources['stylesheet']; ?>">
    <style>body{padding-top:50px}</style> <!--Bootstrap fixed top bar fix-->
    <!--[if lt IE 9]>
      <script src="<?php echo $sources["htmlshiv"]; ?>"></script>
      <script src="<?php echo $sources["respond"]; ?>"></script>
    <![endif]-->
    <script type="text/javascript" src="<?php echo $sources["jquery"]; ?>"></script>
  </head>
  <body>
    <div class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <a href="//<?php echo $domain; ?>" class="navbar-brand"><?php echo $sitename; ?></a>
          <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-main">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
        </div>
        <div class="navbar-collapse collapse" id="navbar-main">
          <ul class="nav navbar-nav">
            <li class="dropdown">
              <a class="dropdown-toggle" data-toggle="dropdown" href="#" id="themes">Themes <span class="caret"></span></a>
              <ul class="dropdown-menu" aria-labelledby="themes">
                <li><a href="../default/">Default</a></li>
                <li class="divider"></li>
                <li><a href="../amelia/">Amelia</a></li>
                <li><a href="../cerulean/">Cerulean</a></li>
                <li><a href="../cosmo/">Cosmo</a></li>
                <li><a href="../cyborg/">Cyborg</a></li>
                <li><a href="../darkly/">Darkly</a></li>
                <li><a href="../flatly/">Flatly</a></li>
                <li><a href="../journal/">Journal</a></li>
                <li><a href="../lumen/">Lumen</a></li>
                <li><a href="../readable/">Readable</a></li>
                <li><a href="../simplex/">Simplex</a></li>
                <li><a href="../slate/">Slate</a></li>
                <li><a href="../spacelab/">Spacelab</a></li>
                <li><a href="../superhero/">Superhero</a></li>
                <li><a href="../united/">United</a></li>
                <li><a href="../yeti/">Yeti</a></li>
              </ul>
            </li>
            <li>
              <a href="../help/">Help</a>
            </li>
            <li>
              <a href="http://news.bootswatch.com">Blog</a>
            </li>
          </ul>

          <ul class="nav navbar-nav navbar-right">
            <?php
            if (verifySession() !== true) {
              echo '
              <li><a href="//'.$domain.'/login?url='.currentURL().'">Login</a></li>
              <li><a href="//'.$domain.'/login/register">Register</a></li>
              ';
            } else {
              echo '
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">'.$session['username'].' <b class="caret"></b></a>
                <ul class="dropdown-menu">
                  <li><a href="//'.$domain.'/ucp">Settings</a></li>
                  <li><a href="//'.$domain.'/login/logout.php?url='.currentURL().'">Logout</a></li>
                </ul>
              </li>
              ';
            }
            ?>
            <li><a href="forums">Forums</a></li>
            <li><a href="linkShrinker">Link Shrinker</a></li>
          </ul>

        </div>
      </div>
    </div>


    <div class="container" id="top">

      <div class="page-header" id="banner">
        <div class="row">
          <div class="col-lg-6">
            <h1><?php echo $pageDyn["title"]; ?></h1>
            <!--<p>Learn Web Design, Coding, Mobile App Development &amp; More.</p>
            <p>Start Learning for Free!</p>
            <p>Learn Web Design, Coding, Mobile App Development &amp; More.</p>-->
          </div>
          <!--<div class="col-lg-6" style="padding: 15px 15px 0 15px;">
            <div class="well sponsor">
              <a href="http://srv.buysellads.com/direct/click/track/yes/x/G6NDC27ICWAI627UCWALYK7UCKBILKJMCT7I5" onclick="_gaq.push(['_trackEvent', 'banner', 'click', 'treehouse']);" rel="nofollow" target="_blank">
                <span style="float: left; margin-right: 15px;">
                  <img src="http://srv.buysellads.com/direct/image/track/yes/x/G6NDC27ICWAI627UCWALYK7UCKBILKJMCT7I5" onload="_gaq.push(['_trackEvent', 'banner', 'impression', 'treehouse']);" width="175" height="135">
                </span>
              </a>
              <a href="http://srv.buysellads.com/direct/click/track/yes/x/G6NDC27ICWAI627UCWALYK7UCKBILKJMCT7I5" onclick="_gaq.push(['_trackEvent', 'banner', 'click', 'treehouse']);" rel="nofollow" target="_blank">
                <h4 style="margin-bottom: 0.4em;">Treehouse</h4>
                <div class="clearfix">
                  <p>Learn Web Design, Coding, Mobile App Development &amp; More.</p>
                  <p>Start Learning for Free!</p>
                </div>
              </a>
            </div>
          </div>-->
        </div>
      </div>
      
      <div class="row">
        <div class="col-lg-12">