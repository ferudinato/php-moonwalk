<?php
namespace App\Controllers\Base;

use Moonwalk\Core\Templates;


class Controller {

  private $_template;

  public function __construct()
  {
    $this->_template = new Templates();
  }

  public function render($view, $data = []) {
    if ( stripos($view, '::') !== FALSE ) {
      list($viewFolder) = explode('::', $view);
      $this->_template->addFolder($viewFolder, ROOT . '/application/views/' . $viewFolder . '/');
    }
    return $this->_template->render($view, $data);
  }
  
}