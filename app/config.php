<?php

/**
* configuration class
*/
class Config {

  // path where all apps are stored
  private $appsPath = '../';


  /**
   * get class instance following the singleton pattern
   * @return Config The one and only instance of the configuration class
   */
  public static function getInstance() {

    static $instance = null;
    if (null === $instance) {
      $instance = new static();
    }

    return $instance;
  }

  /**
   * protected constructor
   */
  protected function __construct() { }


  public function __get($name) {
    

    return $this->$name;
  }
  
}

