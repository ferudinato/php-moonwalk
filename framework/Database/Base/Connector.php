<?php
namespace Moonwalk\Database\Base;

use Moonwalk\Helpers\Util;
use PDO;
use Throwable;

class Connector 
{
  /**
   * @var \PDO $_connector
   */
  protected $_connector = null;


  public function __construct()
  {
    $this->setConnector();
  }

  private function setConnector() 
  {
    try {
      $this->_connector = new PDO("pgsql:host=localhost;dbname=moonwalk", 'postgres', '');
      $this->_connector->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      // $this->_connector->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, true);
      // $this->_connector->exec('set names utf8');
    } catch (Throwable $e) {
      Util::mostrar($e->getMessage());
    }
  }

  /**
   * @return \PDO
   */
  protected function getConnector() 
  {
    return $this->_connector;
  }

  protected function destroyConnector()
  {
    if ($this->_connector) {
      $this->_connector = null;
    }
  }


}