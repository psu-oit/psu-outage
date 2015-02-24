<?php
header("Cache-Control: max-age=0, no-cache, no-store");
header("Pragma: no-cache");
header("x-outage: true");

$h1 = "Site under maintenance";
$msg = "The web site you are trying to reach is currently down for maintenance. Please try again later.";
$pages = array(
  '/dev\.banner\.pdx\.edu/'      => 'devel-banner',
  '/stage.*oam\.pdx\.edu/'       => 'stage-oam',
  '/^(access\.)?oam\.pdx\.edu/'  => 'prod-oam',
  '/banweb\.pdx\.edu/'           => 'prod-ssb',
  '/inb\.banner|wls\.banner/'    => 'prod-inb',
  '/outage\.pdx\.edu/'           => 'outage'
);

foreach ($pages as $expr => $filename) {
  $ret = preg_match($expr, $_SERVER["HTTP_HOST"]);
  if ($ret === 1) {
    $msgpath = "/var/www/html/messages/" . $filename;
    break;
  }
}

if (file_exists($filename)) {
  $contents = file_get_contents($filename);
  if ($contents != FALSE ) {
    $lines = explode("\n", $contents);
    $h1 = $lines[0];
    $msg = '';
    for($i=1;$i<count($lines); $i++) {
      $msg .=  $lines[$i] ."\n" ;
    }
  }
} else {
  error_log("No message found for service " . $_SERVER["HTTP_HOST"] . ".");
}
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en" dir="ltr">

<head>
  <title>Site under maintenance | Office of Information Technology</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <style>
    <?php include "outage.css"; ?>
  </style>
</head>

<body class="maintenance-page in-maintenance no-sidebars">
    <div id="page">
      <div id="header">
        <div id="logo-title">
          <a href="#" title="Home" rel="home" id="logo">
            <img src="data:image/png;base64,<?php require 'logo.png.base64';?>" alt="Home" />
          </a>
          
          <div id="name-and-slogan">
            <h1 id="site-name">
              <a href="#" title="Home" rel="home"><span>Office of Information Technology</span></a>
            </h1>

          </div> <!-- /name-and-slogan -->
        </div> <!-- /logo-title -->
      </div> <!-- /header -->

      <div id="container" class="clearfix">
        <div id="main" class="column"><div id="main-squeeze">
            <div id="content">
              <h1 class="title" id="page-title"><?php echo $h1; ?></h1>

              <div id="content-content" class="clearfix">
                <?php echo $msg; ?> 
              </div> <!-- /content-content -->
            </div> <!-- /content -->
          </div>
        </div> <!-- /main-squeeze /main -->
    </div> <!-- /container -->

      <div id="footer-wrapper">
        <div id="footer">
        </div> <!-- /footer -->
      </div> <!-- /footer-wrapper -->
      
    </div> <!-- /page -->
    
  </body>
</html>

