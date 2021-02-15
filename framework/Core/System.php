<?php
namespace Moonwalk\Core;

class System 
{
  private $_env;
  private $_globals = [];
  private $_router;


  public function __construct()
  {
    $this->_env = APP_ENV;
    $this->_globals = ['_SESSION', '_POST', '_GET', '_COOKIE', '_REQUEST', '_SERVER', '_ENV', '_FILES'];

    $this->_router = new Router();
  }

  public function set_environment()
  {
    if ($this->_env == 'devel') {
      error_reporting(E_ALL);
      ini_set('display_errors', 'On');
    } else {
      error_reporting(E_ALL);
      ini_set('display_errors', 'Off');
      ini_set('log_errors', 'On');
      ini_set('error_log', TMP_FOLDER . 'error.log');
    }
  }


  public function unregister_globals()
  {
    if (ini_get('register_globals')) {
      foreach($this->_globals as $value) {
        unset($GLOBALS[$value]);
      }
    }
  }

  public function configure() 
  {
    $request_uri = $this->_router->checkUri( $_SERVER['REQUEST_URI'] );
    // $request_uri: index 0 => $controller
    //                            index 1 => $action (or method)
    //                            index 2 => $queryString (params)
    $this->_router->checkController($request_uri[0], $request_uri[1], $request_uri[2]);

  }

}
