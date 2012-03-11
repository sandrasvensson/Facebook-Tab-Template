<?php
require 'inc/fbsr.php';

$app_secret = 'YOUR_APP_SECRET';
$app_id = 'YOUR_APP_ID';

$sr = parse_signed_request($_REQUEST['signed_request'], $app_secret);
echo '<!--';
var_dump($sr);
echo '-->';
$page_data = (array) json_decode(file_get_contents('http://graph.facebook.com/'.$sr['page']['id']));
$page_name = $page_data['name'];
$tab_url = $page_data['link'].'?sk=app_'.$app_id;
?>

<!DOCTYPE html>
<!--[if lt IE 7]> <html class="lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class=" lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html lang="en"> <!--<![endif]-->
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

  <meta property="og:title" content="">
  <meta property="og:type" content="">
  <meta property="og:url" content=">">
  <meta property="og:image" content="">
  <meta property="og:description" content="">

  <title></title>
  <meta name="description" content="">
  <meta name="author" content="">
  <meta name="viewport" content="width=device-width">

  <link rel="stylesheet" href="css/style.css">
</head>

<body onload="resize();">
  <!--[if lt IE 7]><p class=chromeframe>Your browser is <em>ancient!</em> <a href="http://browsehappy.com/">Upgrade to a different browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">install Google Chrome Frame</a> to experience this site.</p><![endif]-->

  <div id="wrapper">
    Your content here.
  </div>

  <div id="fb-root"></div>
  <script src="https://connect.facebook.net/en_US/all.js"></script>
  <script>
  var appId = '<?php echo $app_id; ?>',
      appURL = '<?php echo $tab_url; ?>';

  FB.init({
    appId : appId, // App ID
    status : true, // check login status
    cookie : true, // enable cookies to allow the server to access the session
    xfbml : true  // parse XFBML
  });

  // redirect to app/tab URL if user views outside Facebook
  // useful for enabling open graph data
  var isInIframe = (window.location != window.parent.location) ? true : false;
  if ( !isInIframe && location.host.indexOf('localhost') == -1 ) {
    // location.href = appURL;
  }

  // setup tab autogrowth
  function resize() {
    FB.Canvas.setAutoGrow();
  }
  </script>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
  <script>window.jQuery || document.write('<script src="js/libs/jquery-1.7.1.min.js"><\/script>')</script>

  <script defer src="js/plugins.js"></script>
  <script defer src="js/script.js"></script>

  <!-- Asynchronous Google Analytics snippet. Change UA-XXXXX-X to be your site's ID. -->
  <script>
    var _gaq=[['_setAccount','UA-XXXXX-X'],['_trackPageview']];
    (function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
    g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
    s.parentNode.insertBefore(g,s)}(document,'script'));
  </script>

</body>
</html>