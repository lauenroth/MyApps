<?php

class Detect {

  private $config;


  function __construct(Config $config) {
    
    $this->config = $config;
  }

  /**
   * get an array of all apps in a given folder
   * @param  String $path The path of the folder that should be scanned for apps
   * @return [type]       [description]
   */
  public function allApps() {

    $apps = [];
    
    $folders = scandir($this->config->appsPath);

    foreach ($folders as $folder) {

      if (

        is_dir(getcwd() . '/' . $this->config->appsPath . $folder) // make sure it's a folder
        && $app = $this->getAppBasics($folder)
      ) {
        $apps[] = $app;
      }
      
    }


    // sort array by app name
    uasort($apps, function($app1, $app2) {
      return strcasecmp($app1['name'],  $app2['name']);
    });

    return $apps;
  }


  /**
   * check if the given folder contains a supported app
   * @param  String $folder Folder to be scanned
   * @return array  
   */
  private function getAppBasics($folder) {

    // skip all folders starting with a dot or an underscore
    if ($folder[0] != '.' && $folder[0] != '_') {

      $app = ['folder' => $folder];

      // is the app currently selected?
      if (isset($_GET['app']) && $_GET['app'] === $folder) {
        $app['selected'] = true;
      }
      
      $app['name'] = ucfirst($folder);

      return $app;
    }

    return false;
  }


  /**
   * get the name of the platform that the app is built on
   * @param  String $folder Folder where the app is located
   * @return String         Name of the platform
   */
  private function getPlatforms($folder) {

    $isHTML = false;
    $isPHP  = false;

    $platforms = [];

    $path = $this->config->appsPath . '/' . $folder;

    $folders = scandir($path);


    foreach ($folders as $item) {

      if (strpos($item, '.html')) {
        $isHTML = true;
      }
      elseif (strpos($item, '.php')) {
        $isPHP = true;
      }

      // Git
      if ($item === '.git') {
        array_push($platforms, 'git');
      }

      // Meteor
      elseif ($item === '.meteor') {
        array_push($platforms, 'meteor');
      }

      // Composer
      elseif ($item === 'composer.json') {

        // check composer file
        $json = json_decode(file_get_contents($path . '/composer.json'), true);
        
        // Laravel
        if (isset($json['require']['laravel/framework'])) {
          array_push($platforms, 'laravel');
        }

        // Silex
        elseif (isset($json['require']['silex/silex'])) {
          array_push($platforms, 'silex');
        }

        // other composer
        else {
          array_push($platforms, 'composer');
        }
      }

      // Grunt
      elseif ($item === 'Gruntfile.js') {
        array_push($platforms, 'grunt');
      }

      // Drupal
      elseif ($item === 'sites' && is_dir($this->config->appsPath . '/' . $folder . '/sites/default')) {
        array_push($platforms, 'drupal');
      }

      // Wordpress
      elseif ($item === 'wp-content') {
        array_push($platforms, 'wordpress');
      }
    }

    if (empty($platforms)) {
      if ($isPHP) {
        array_push($platforms, 'php');
      }
      elseif ($isHTML) {
        array_push($platforms, 'html');
      }
      else {
        array_push($platforms, 'unknown');
      }
    }

    asort($platforms);
    return $platforms;
    
  }



  public function getAppDetails($folder) {

    $path = $this->config->appsPath . '/' . $folder;

    $app = $this->getAppBasics($folder);
    $app['platforms'] = $this->getPlatforms($folder);

    // Meteor
    if (in_array('meteor', $app['platforms'])) {

      // version number
      $version = explode('@', file_get_contents($path . '/.meteor/release'));
      $app['meteorVersion'] = $version[1];


      // get packages
      $packagesLines = file_get_contents($path . '/.meteor/packages');
      $packagesLines = explode(PHP_EOL, $packagesLines);
      $packages = [];
      for ($line = count($packagesLines) - 1; $line > 0; $line--) { 
        if (
          strlen($packagesLines[$line]) > 0 && 
          $packagesLines[$line][0] !== '#'  && 
          $packagesLines[$line] !== 'meteor-platform'
        ) {
          array_push($packages, $packagesLines[$line]);
        }
      }
      asort($packages);
      $app['packages'] = $packages;
    }

    return $app;
  }


}