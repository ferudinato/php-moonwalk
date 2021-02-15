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

  private $databaseHost = '';
  private $databaseDriver = '';
  private $databaseName = '';
  private $databaseUser = '';
  private $databasePassword = '';


  public function __construct()
  {
    $this->databaseDriver = $_ENV['DATABASE_DRIVER'];
    $this->databaseHost = $_ENV['DATABASE_HOST'];
    $this->databaseName = $_ENV['DATABASE_NAME'];
    $this->databaseUser = $_ENV['DATABASE_USER'];
    $this->databasePassword = $_ENV['DATABASE_PASSWD'];
    
    $this->setConnector();
  }

  private function setConnector() 
  {
    try {
      $this->_connector = new PDO(
        "{$this->databaseDriver}:host={$this->databaseHost};dbname={$this->databaseName}", 
        $this->databaseUser, $this->databasePassword
      );
      if ($this->databaseDriver === 'mysql') {
        $this->_connector->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, true);
        $this->_connector->exec('set names utf8');
      } else if ($this->databaseDriver === 'pgsql') {
        $this->_connector->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      }
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