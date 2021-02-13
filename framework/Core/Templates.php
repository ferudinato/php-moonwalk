<?php
namespace Moonwalk\Core;

use Exception;
use League\Plates\Engine;
use Moonwalk\Helpers\Util;

class Templates {

  private $_template = '';
  private $_viewsPath = VIEWS_PATH;

  public function __construct()
  {
    // Init Template Engine;
    $this->_template = new Engine($this->_viewsPath, 'phtml');
  }

  public function render($view, $data = []) {
    try {
      if ( stripos($view, '::') !== FALSE ) {
        list($viewFolder) = explode('::', $view);
        $this->setViewFolder($viewFolder, $this->_viewsPath . $viewFolder . '/');
      }
      
      return $this->_template->render($view, $data);
    } catch (Exception $e) {
      Util::mostrar($e->getMessage());
    }
  }

  private function setViewFolder($name, $path) {
    $this->_template->addFolder($name, $path);
  }

  private function getFolders() {
    return $this->_template->getFolders();
  }

}