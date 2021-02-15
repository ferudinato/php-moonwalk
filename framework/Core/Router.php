<?php
namespace Moonwalk\Core;

use Exception;
use Moonwalk\Core\Templates;
use Moonwalk\Helpers\Util;

class Router {
  
  private $default_method = '',
          $default_controller = '';
  
  private $_template = '';

  public function __construct()
  {
    $this->default_controller = DEFAULT_CONTROLLER;
    $this->default_method = DEFAULT_METHOD;

    $this->_template = new Templates();
  }

  public function checkController($ctrl = '', $method = '', $queryString = [])
  {
    $class = "App\\Controllers\\" . $ctrl;
    try {
      if (class_exists($class)) {
        $checkMethod = !empty($queryString);
        $method = $checkMethod ? 'content' : $method;
        $dispatch = new $class($ctrl, $method);
        if ( (int)method_exists($dispatch, $method) ) {
          echo call_user_func([$dispatch, $method], $queryString);
        } else {
          throw new Exception("Method {$method} on {$ctrl} does not exists.", 500);
        }
      } else {
        throw new Exception("{$ctrl} does not exists", 404);
      }
    } catch (Exception $e) {
      http_response_code($e->getCode());
      echo $this->_template->render("errors::{$e->getCode()}", [
        'statusCode' => $e->getCode(),
        'title' => Util::show_error($e->getCode()),
        'message' => $e->getMessage(),
        'file' => $e->getFile(),
        'line' => $e->getLine()
      ]);
    }
    
  }

  public function checkUri($uri = '') 
  {
    $uri = trim($uri);
    if (substr($uri, -1) == '/') {
      $uri = substr($uri, 0, strlen($uri) - 1);
    }

    $urls = explode('/', $uri);
    array_shift($urls);

    if (count($urls) > 1) {
      $controller = $urls[0];
      $action = $urls[1];
      $queryString = [];
      if ($controller === 'posts') {
        array_push($queryString, $action);
      } else {
        for ($i = 2; $i < count($urls); $i++) {
          if ($i % 2 == 0) {
            $queryString['params'][$urls[$i]] = $urls[$i + 1];
          }
        }
      }
    } else {
      $controller = !empty($urls) && $urls[0] ? $urls[0] : $this->default_controller;
      $action = $this->default_method;
      $queryString = [];
    }

    $controller = ucwords($controller);
    $controller .= 'Controller';

    $response = [$controller, $action, $queryString];
    return $response;
  }

}
