<?php
namespace Moonwalk\Core;

use League\Plates\Engine;


class Templates {

  private $_template;

  public function __construct()
  {
    // Init Template Engine;
    $this->_template = new Engine(ROOT . '/application/views/', 'phtml');
  }

  public function render($view, $data = []) {
    return $this->_template->render($view, $data);
  }

  public function addFolder($name, $path = '') {
    $this->_template->addFolder($name, $path);
  }

  public function getFolders() {
    return $this->_template->getFolders();
  }

}