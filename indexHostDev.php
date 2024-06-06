<?php
$url =  $_SERVER['REQUEST_URI'];
list($vide,$lang, $nameURL) = explode('/', $url);
$list_lang = array("fr", "en", "it", "de");
if (in_array($lang, $list_lang)) {
} else {
  $nameURL = $lang;
  $lang = 'it';
}

$nameURL = explode('?', $nameURL)[0];
//echo $response;
if($nameURL==null || $nameURL=='search'){
 // $dataAllGuestbooks = file_get_contents('https://nodejs-mongo-persistent-valueguest.e4ff.pro-eu-west-1.openshiftapps.com/getAllGuestbook?url='.$url);
} else if(strpos($nameURL, '.') == false){ // In case it is a website.
  $res = file_get_contents('https://vg-server-dev-rma3y.ondigitalocean.app/getWebsiteDataByName?nameURL='.$nameURL);
  //echo $response;
  $response = json_decode($res, true);
  $data = $response['data']['myPage']['propertyDetails'];
  //In case it is a wrong name we redirect to main page
  /*if($data == null){
    header('Location: https://staydev.valueguest.com/search?wrongName='.$nameURL);
    exit();
  }*/
}
?>
<!DOCTYPE html>
<html prefix="og: http://ogp.me/ns#" lang="<?php echo $lang;?>">

<head>
  <meta charset="utf-8"/>
  <link rel="canonical" hreflang="x-default" href="https://stay.valueguest.com/<?php echo $response['data']['myPageUrlName']?>"/>
  <link rel="alternate" hreflang="it-it" href="https://stay.valueguest.com/it/<?php echo $response['data']['myPageUrlName']?>"/>
  <link rel="alternate" hreflang="it" href="https://stay.valueguest.com/it/<?php echo $response['data']['myPageUrlName']?>"/>
  <link rel="alternate" hreflang="en-us" href="https://stay.valueguest.com/en/<?php echo $response['data']['myPageUrlName']?>"/>
  <link rel="alternate" hreflang="en" href="https://stay.valueguest.com/en/<?php echo $response['data']['myPageUrlName']?>"/>
  <link rel="alternate" hreflang="en-gb" href="https://stay.valueguest.com/en/<?php echo $response['data']['myPageUrlName']?>"/>
  <link rel="alternate" hreflang="fr-fr" href="https://stay.valueguest.com/fr/<?php echo $response['data']['myPageUrlName']?>"/>
  <link rel="alternate" hreflang="fr" href="https://stay.valueguest.com/fr/<?php echo $response['data']['myPageUrlName']?>"/>
  <?php if($dataAllGuestbooks!=null) {
  ?>

    <title>Stay with ValueGuest</title>

  <?php } else {
  ?>
  <title><?php echo $data['givenName'] ?></title>
  <meta property="og:url"           content="https://stay.valueguest.com/<?php echo $response['data']['myPageUrlName']?>" />
  <meta property="og:type"          content="website" />
  <meta property="og:title"         content="<?php echo $data['givenName'] ?>" />
  <meta property="og:description"   content="<?php echo $data['summary'][$lang] ?>" />
  <meta property="og:image"         content="<?php echo $data['photos']['main_photo_m'] ?>" />
  <meta name="description" content="<?php echo $data['summary'][$lang] ?>">
  
  <?php }
  ?>
  
  <base href="/">
  <meta name="viewport" content="viewport-fit=cover, width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
  <meta name="format-detection" content="telephone=no"/>
  <meta name="msapplication-tap-highlight" content="no"/>




  <link rel="icon" type="image/jpeg" href="./assets/icon/logoVG.gif">
  <!-- add to homescreen for ios -->
  <meta name="apple-mobile-web-app-capable" content="yes"/>
  <meta name="apple-mobile-web-app-status-bar-style" content="black"/>
<script>
  if(navigator && navigator.serviceWorker) {
  navigator.serviceWorker.getRegistrations().then( function(registrations) { for(let registration of registrations) { registration.unregister(); } }); 
  }
  var gaId = 'UA-121444164-3';
  if (window.location.host.search('stay.') > -1) {
    //gaId = 'UA-121444164-5';
  } else if (window.location.pathname.search('/app') > -1) {
    gaId = 'UA-121444164-1';
  }
</script>
  <script async="" src="https://www.googletagmanager.com/gtag/js?id="+gaId></script>
  <script>
  nameURL = '<?php echo $nameURL;?>';
  <?php if($dataAllGuestbooks!=null) {
  ?>

dataAllGuestbooks = <?php echo $dataAllGuestbooks; ?>;

  <?php } else if($res!=null){
  ?>
  dataGuestbook = <?php echo $res; ?>;
  
  <?php }
  ?>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());
  
    //gtag('config', 'UA-121444164-3');
    window.global = window; //AIzaSyDGCjsuOBlH5ryzpyuHhmWoM9LdjObHDt0
  </script>
<script async="" src="./assets/cookieconsent.min.js"></script>
<link rel="stylesheet" href="./assets/cookieconsent.min.css"/>
  <link rel="manifest" href="/manifest.webmanifest">
 <meta name="theme-color" content="#9f3658">

 <!-- <script src="https://js.stripe.com/v3/"></script> -->
  
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<link rel="stylesheet" href="/styles.6c85e0edbe90b4d36842.css">
</head>
<body>

  <app-root></app-root>
  <noscript>Please enable JavaScript to continue using this application.</noscript>
<script src="runtime.7e3cd6bcc0e4f0fd.js" type="module"></script><script src="polyfills.593235f0c5796786.js" type="module"></script><script src="main.4435e5d45d4ab6e6.js" type="module"></script>


</body></html>