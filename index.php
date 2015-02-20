<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
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
<?php


$h1 = "Site under maintenance";
$uri = $_SERVER["HTTPS"] ? "https://" : "http://" .$_SERVER["HTTP_HOST"] . "/" . $_SERVER["REQUEST_URI"];
$msg = "The web site you are trying to reach is currently down for maintenance. Please try again later.";

$filename = "/var/www/html/messages/" . escapeshellcmd( $_SERVER["REQUEST_URI"]);

if (file_exists($filename)) {
  $contents = file_get_contents($filename);
  if ($contents != FALSE ) {
    $lines = explode("\n", $contents);
    $h1 = $lines[0];
    $msg = '';
    for($i=1;$i<count($lines); $i++) {
      $msg .= "<p>" . $lines[$i] . "</p>";
    }
  }
} 
?>

              <h1 class="title" id="page-title"><?php echo $h1; ?></h1>
              <h2><a href="<?php echo $uri;?>"><?php echo $uri;?></a>
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

