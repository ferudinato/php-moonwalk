<?php
namespace Moonwalk\Helpers;

class Util {

  public static function mostrar($array) {
    echo "<pre>"; 
    print_r($array);
    echo "</pre>";
  }

  public static function show_error($code) {
    switch ($code) {
      case 404:
        return 'Not Found';
      case 500:
        return 'Internal Server Error';
      default:
        return '';
    }
  }

}
