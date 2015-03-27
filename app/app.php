<?php

require_once 'config.php';
require_once 'detect.php';


class MyApps {

  private $config;
  private $detect;

  private $apps;

  
  function __construct() {

    // set config
    $this->config = Config::getInstance();    

    $this->detect = new Detect($this->config);


    
    
    
  }


  function getContent() {

    // show app details
    if (isset($_GET['app'])) {

      return 'App name';

    }

    // list of apps
    else {
      
      return '<p>Please select an app or create a new one.</p>';
    }
  }


  /**
   * get an array of all apps that have been detected
   * @return Array [description]
   */
  function getApps() {
    if (!isset($this->apps)) {
      $this->apps = $this->detect->allApps();
    }
    return $this->apps;
  }


  function getApp() {
    if (isset($_GET['app'])) {
      return $this->detect->getAppDetails($_GET['app']);
    }
    return false;
  }
}


$myApps = new myApps();


$content = $myApps->getContent();


// $content = '<pre>' . print_r($app->getApps(), true) . '</pre>';