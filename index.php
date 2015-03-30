<?php require_once 'app/app.php'; ?><!DOCTYPE html>
<html>
<head>
  <title>App manager</title>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1">
  <meta name="mobile-web-app-capable" content="yes">
  <link rel="icon" sizes="128x128" href="images/android-logo.png">
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-status-bar-style" content="black">
  <meta name="apple-mobile-web-app-title" content="App manager">
  <meta name="msapplication-TileImage" content="images/win-logo.png">
  <meta name="msapplication-TileColor" content="#3372DF">
  <meta name="msapplication-tap-highlight" content="no" />
  <!--[if lt IE 9]>
    <script language="javascript" type="text/javascript" src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <script src="//oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  <link href="//fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="css/styles.css">
</head>
<body>
<header class="main">
  <section>
    <a class="button" href="?new">New app</a>
    <a href="/" id="logo">MyApps</a>
  </section>
</header>
<main>
  <?php include 'templates/listApps.php'; ?>
  <section class="main app">
  <?php

  if (isset($_GET['app'])) {
    $app = $myApps->getApp($_GET['app']);
    include 'templates/appDetails.php';
  }
  elseif (isset($_GET['new'])) {
    include 'templates/newApp.php';
  }
  else {
    echo '<p>Please select an app or create a new one.</p>';
  }

  ?>
  </section>
</main>
</body>
</html>