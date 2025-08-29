<?php
$url =  $_SERVER['REQUEST_URI'];
list($vide,$lang, $nameURL) = explode('/', $url);
$list_lang = array("fr", "en", "it", "de");
if (in_array($lang, $list_lang)) {
} else {
  $nameURL = $lang;
  $lang = 'it';
}

if (strpos(strtolower($url), 'homebook') !== false){
  $product = 'homebook';
} else {
  $product = 'wsb';
}
$nameURL = explode('?', $nameURL)[0];
//echo $response;
if($nameURL == '.well-known'){
  echo "404";
  
} else {

  if($nameURL==null || $nameURL=='search'){
  // $dataAllGuestbooks = file_get_contents('https://nodejs-mongo-persistent-valueguest.e4ff.pro-eu-west-1.openshiftapps.com/getAllGuestbook?url='.$url);
  } else if(strpos($nameURL, '.') == false){ // In case it is a website.
    $res = file_get_contents('https://vg-server-prod-p9wct.ondigitalocean.app/getWebsiteDataByName?useCache=true&nameURL='.$nameURL.'&product='.$product);
    //echo $response;
    $response = json_decode($res, true);
    $websiteAdditionalData = $response['data']['myPage']['websiteAdditionalData'];
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
    <link rel="canonical" hreflang="x-default" href="https://stay.valueguest.com/<?php echo $response['data']['guestbook']['myPageUrlName']?>"/>
    <link rel="alternate" hreflang="it-it" href="https://stay.valueguest.com/it/<?php echo $response['data']['guestbook']['myPageUrlName']?>"/>
    <link rel="alternate" hreflang="it" href="https://stay.valueguest.com/it/<?php echo $response['data']['guestbook']['myPageUrlName']?>"/>
    <link rel="alternate" hreflang="en-us" href="https://stay.valueguest.com/en/<?php echo $response['data']['guestbook']['myPageUrlName']?>"/>
    <link rel="alternate" hreflang="en" href="https://stay.valueguest.com/en/<?php echo $response['data']['guestbook']['myPageUrlName']?>"/>
    <link rel="alternate" hreflang="en-gb" href="https://stay.valueguest.com/en/<?php echo $response['data']['guestbook']['myPageUrlName']?>"/>
    <link rel="alternate" hreflang="fr-fr" href="https://stay.valueguest.com/fr/<?php echo $response['data']['guestbook']['myPageUrlName']?>"/>
    <link rel="alternate" hreflang="fr" href="https://stay.valueguest.com/fr/<?php echo $response['data']['guestbook']['myPageUrlName']?>"/>
    <?php if($dataAllGuestbooks!=null) {
    ?>

      <title>Stay with ValueGuest</title>

      <?php } else if($response['data']['myPage']) {
      $websiteAdditionalData = $response['data']['myPage']['websiteAdditionalData'];
    ?>
  <title><?php echo $websiteAdditionalData['seoParams']['title']['it'] ?></title>
    <meta property="og:url"           content="https://stay.valueguest.com/<?php echo $response['data']['myPageName']?>" />
    <meta property="og:type"          content="website" />
    <meta property="og:title"         content="<?php echo $websiteAdditionalData['seoParams']['title']['it'] ?>" />
    <meta property="og:description"   content="<?php echo $websiteAdditionalData['seoParams']['description']['it'] ?>" />
    <meta property="og:image"         content="<?php echo $websiteAdditionalData['seoParams']['mainPhoto'] ?>" />
    <meta name="description" content="<?php echo $websiteAdditionalData['seoParams']['description']['it'] ?>">
  
    <?php } else {
    ?>
    <title><?php echo $response['data']['guestbook']['myPageName']  ?></title>
    <meta property="og:url"           content="https://stay.valueguest.com/<?php echo $response['data']['guestbook']['myPageName']?>" />
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
  /* if(navigator && navigator.serviceWorker) {
    navigator.serviceWorker.getRegistrations().then( function(registrations) { for(let registration of registrations) { registration.unregister(); } }); 
    }*/
  </script>
   
   <!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo $websiteAdditionalData['seoParams']['gtmId'] ?>"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', '<?php echo $websiteAdditionalData['seoParams']['gtmId'] ?>');
</script>

    <script>
    nameURL = '<?php echo $nameURL;?>';
    <?php if($dataAllGuestbooks!=null) {
    ?>

  dataAllGuestbooks = <?php echo $dataAllGuestbooks; ?>;

    <?php } else if($res!=null){
    ?>
    websiteData = <?php echo $res; ?>;
    
    <?php }
    ?>
    
      //gtag('config', 'UA-121444164-3');
      window.global = window;
    </script>
  <script async="" src="./assets/cookieconsent.min.js"></script>
  <link rel="stylesheet" href="./assets/cookieconsent.min.css"/>
    <link rel="manifest" href="/manifest.webmanifest">
  <meta name="theme-color" content="#9f3658">

  <!-- <script src="https://js.stripe.com/v3/"></script> -->
    
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <style type="text/css">@font-face{font-family:'Material Icons';font-style:normal;font-weight:400;src:url(https://fonts.gstatic.com/s/materialicons/v143/flUhRq6tzZclQEJ-Vdg-IuiaDsNcIhQ8tQ.woff2) format('woff2');}.material-icons{font-family:'Material Icons';font-weight:normal;font-style:normal;font-size:24px;line-height:1;letter-spacing:normal;text-transform:none;display:inline-block;white-space:nowrap;word-wrap:normal;direction:ltr;-webkit-font-feature-settings:'liga';-webkit-font-smoothing:antialiased;}</style>
  <style>
    /* custom scrollbar */
    ::-webkit-scrollbar {
      width: 20px;
    }
    
    ::-webkit-scrollbar-track {
      background-color: transparent;
    }
    
    ::-webkit-scrollbar-thumb {
      background-color: #d6dee1;
      border-radius: 20px;
      border: 6px solid transparent;
      background-clip: content-box;
    }
    
    ::-webkit-scrollbar-thumb:hover {
      background-color: #a8bbbf;
    }</style>
  <script src="https://maps.googleapis.com/maps/api/js?key="></script>
<style>:root{--text-color-primary:#273951;--ion-breakpoint-sm:576px;--vg-background-grey:#e9ebed;--ion-color-primary:#AC2551;--ion-color-primary-rgb:159, 54, 88;--ion-color-primary-contrast:#ffffff;--ion-color-primary-contrast-rgb:255, 255, 255;--ion-color-primary-shade:#88304c;--ion-color-primary-tint:#b84368;--ion-color-primary-gradient:#582536;--ion-color-secondary:#273951;--ion-color-secondary-rgb:12, 209, 232;--ion-color-secondary-contrast:#ffffff;--ion-color-secondary-contrast-rgb:255, 255, 255;--ion-color-secondary-shade:#0bb8cc;--ion-color-secondary-tint:#24d6ea;--ion-color-tertiary:#03aa4c;--ion-color-tertiary-rgb:3, 170, 76;--ion-color-tertiary-contrast:#ffffff;--ion-color-tertiary-contrast-rgb:255, 255, 255;--ion-color-tertiary-shade:#633ce0;--ion-color-tertiary-tint:#7e57ff;--ion-color-success:#31c79f;--ion-color-success-rgb:16, 220, 96;--ion-color-success-contrast:#ffffff;--ion-color-success-contrast-rgb:255, 255, 255;--ion-color-success-shade:#0ec254;--ion-color-success-tint:#28e070;--ion-color-success-light:#e6f5f1;--ion-color-warning:#ffce00;--ion-color-warning-rgb:255, 206, 0;--ion-color-warning-contrast:#ffffff;--ion-color-warning-contrast-rgb:255, 255, 255;--ion-color-warning-shade:#e0b500;--ion-color-warning-tint:#ffd31a;--ion-color-danger:#d62828;--ion-color-danger-strong:#ff0000;--ion-color-danger-rgb:245, 61, 61;--ion-color-danger-contrast:#fff5f5;--ion-color-danger-contrast-rgb:255, 255, 255;--ion-color-danger-shade:#d33939;--ion-color-danger-tint:#f25454;--ion-color-dark:#273951;--ion-color-dark-rgb:34, 34, 34;--ion-color-dark-contrast:#ffffff;--ion-color-dark-contrast-rgb:255, 255, 255;--ion-color-dark-shade:#1e2023;--ion-color-dark-tint:#383a3e;--ion-color-medium:#a59d9d;--ion-color-medium-rgb:152, 154, 162;--ion-color-medium-contrast:#ffffff;--ion-color-medium-contrast-rgb:255, 255, 255;--ion-color-medium-shade:#86888f;--ion-color-medium-tint:#a2a4ab;--ion-color-light:#f4f5f8;--ion-color-light-rgb:244, 244, 244;--ion-color-light-contrast:#000000;--ion-color-light-contrast-rgb:0, 0, 0;--ion-color-light-shade:#d7d8da;--ion-color-light-tint:#f5f6f9;--ion-color-border:#bdbdbd;--ion-font-family:"Montserrat", sans-serif;--ion-bold:500;--ion-color-dark:500}html{--ion-font-family:var(--ion-default-font)}body{background:var(--ion-background-color)}@supports (padding-top: 20px){html{--ion-safe-area-top:var(--ion-statusbar-padding)}}@supports (padding-top: constant(safe-area-inset-top)){html{--ion-safe-area-top:constant(safe-area-inset-top);--ion-safe-area-bottom:constant(safe-area-inset-bottom);--ion-safe-area-left:constant(safe-area-inset-left);--ion-safe-area-right:constant(safe-area-inset-right)}}@supports (padding-top: env(safe-area-inset-top)){html{--ion-safe-area-top:env(safe-area-inset-top);--ion-safe-area-bottom:env(safe-area-inset-bottom);--ion-safe-area-left:env(safe-area-inset-left);--ion-safe-area-right:env(safe-area-inset-right)}}*{box-sizing:border-box;-webkit-tap-highlight-color:rgba(0,0,0,0);-webkit-tap-highlight-color:transparent;-webkit-touch-callout:none}html{width:100%;height:100%;-webkit-text-size-adjust:100%;-moz-text-size-adjust:100%;text-size-adjust:100%}html:not(.hydrated) body{display:none}body{-moz-osx-font-smoothing:grayscale;-webkit-font-smoothing:antialiased;margin:0;padding:0;position:fixed;width:100%;max-width:100%;height:100%;max-height:100%;transform:translateZ(0);text-rendering:optimizeLegibility;overflow:hidden;touch-action:manipulation;-webkit-user-drag:none;-ms-content-zooming:none;word-wrap:break-word;overscroll-behavior-y:none;-webkit-text-size-adjust:none;-moz-text-size-adjust:none;text-size-adjust:none}html{font-family:var(--ion-font-family)}@charset "UTF-8";@font-face{font-family:Montserrat;font-style:normal;font-weight:400;font-display:swap;src:url(montserrat-v14-latin-regular.2a176a1c6698749e.eot);src:local("Montserrat Regular"),local("Montserrat-Regular"),url(montserrat-v14-latin-regular.2a176a1c6698749e.eot?#iefix) format("embedded-opentype"),url(montserrat-v14-latin-regular.016fddc825bb37e6.woff2) format("woff2"),url(montserrat-v14-latin-regular.b9de6aa2f4bccfc5.woff) format("woff"),url(montserrat-v14-latin-regular.0e27f1ee187b0c2c.ttf) format("truetype"),url(montserrat-v14-latin-regular.8e4e187154ffbec3.svg#Montserrat) format("svg")}@font-face{font-family:Montserrat;font-style:normal;font-weight:500;font-display:swap;src:url(montserrat-v14-latin-500.e59a7bafdeef81e9.eot);src:local("Montserrat Medium"),local("Montserrat-Medium"),url(montserrat-v14-latin-500.e59a7bafdeef81e9.eot?#iefix) format("embedded-opentype"),url(montserrat-v14-latin-500.f4f8a034a65bf0eb.woff2) format("woff2"),url(montserrat-v14-latin-500.c03d339883f66523.woff) format("woff"),url(montserrat-v14-latin-500.bff6786035d3bb82.ttf) format("truetype"),url(montserrat-v14-latin-500.dd6fe4c6b17239f9.svg#Montserrat) format("svg")}@font-face{font-family:Montserrat;font-style:normal;font-weight:600;font-display:swap;src:url(montserrat-v14-latin-600.d7b2d7057f8bad99.eot);src:local("Montserrat SemiBold"),local("Montserrat-SemiBold"),url(montserrat-v14-latin-600.d7b2d7057f8bad99.eot?#iefix) format("embedded-opentype"),url(montserrat-v14-latin-600.8f722b0683c9c276.woff2) format("woff2"),url(montserrat-v14-latin-600.be907d76f198fcee.woff) format("woff"),url(montserrat-v14-latin-600.30b0479ed510b468.ttf) format("truetype"),url(montserrat-v14-latin-600.3eb59b4b3feca218.svg#Montserrat) format("svg")}@font-face{font-family:Montserrat;font-style:normal;font-weight:700;font-display:swap;src:url(montserrat-v14-latin-700.093d7ef96820774a.eot);src:local("Montserrat Bold"),local("Montserrat-Bold"),url(montserrat-v14-latin-700.093d7ef96820774a.eot?#iefix) format("embedded-opentype"),url(montserrat-v14-latin-700.0de51ce0d2052dcf.woff2) format("woff2"),url(montserrat-v14-latin-700.aa0683f511f99524.woff) format("woff"),url(montserrat-v14-latin-700.79bce7557fcece02.ttf) format("truetype"),url(montserrat-v14-latin-700.7baaacc945136b10.svg#Montserrat) format("svg")}body{text-rendering:optimizeLegibility;-webkit-font-smoothing:antialiased}</style><link rel="stylesheet" href="styles.4f589bd9662ef85f.css" media="print" onload="this.media='all'"><noscript><link rel="stylesheet" href="styles.4f589bd9662ef85f.css"></noscript></head>

<body>
  <app-root></app-root>
  <noscript>Please enable JavaScript to continue using this application.</noscript>
<script src="runtime.4cf2c70ef593957b.js" type="module"></script><script src="polyfills.593235f0c5796786.js" type="module"></script><script src="main.0d3f0a08762a195a.js" type="module"></script>


</body></html><?php } ?>