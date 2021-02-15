<?php
namespace Moonwalk\Database;

use Exception;
use Moonwalk\Database\Base\Connector;
use Moonwalk\Database\Base\Helper;
use Moonwalk\Helpers\Util;
use PDO;
use Throwable;

class Model extends Connector implements Helper {

  private $connection = '';

  protected $_table = '';


  public function __construct()
  {
    parent::__construct();
    $this->connection = $this->getConnector();
  }

  private function execute($query, $conditions = [])
  {
    try {
      if ( !is_string($query) || empty($query) ) {
        throw new Exception('The specified query is not valid.');
      }

      $statement = $this->connection->prepare($query);
      $statement->execute($conditions);
      return $statement->fetchAll(PDO::FETCH_CLASS);
    } catch (Throwable $e) {
      Util::mostrar($e->getMessage());
    }
    
  }

  public function get($fields = [], $conditions = [], $order = '', $limit = null, $offset = null)
  {
    if ( empty($fields) ) $fields = '*';
    else $fields = implode(', ', $fields);

    $wh = "";
    $wh_params = [];
    if (!empty($conditions)) {
      if (count($conditions) > 0) {
        foreach ($conditions as $key => $value) {
          $wh .= "{$this->_table}.{$key} = '{$value}'";
        }
      } else {
        $wh .= $this->_table . "." . $conditions[0] . " " . $conditions[1] . " ? ";
      }
    }

    $prepareQuery = "SELECT " . $fields . " FROM " . $this->_table . " " .( $wh!='' ? "WHERE " . $wh : "" ) .
      ( $order!=null ? "ORDER by " . $order[0] . " " . $order[1] . " " : '' ) . ( $limit!=null ? "LIMIT " . $limit . 
      ( $offset!=null ? ", " . $offset : '' ) : '' );
    
    Util::mostrar($prepareQuery);
    
    return $this->execute($prepareQuery, $wh_params);
  }

  public function save($data = [])
  {
    
  }

  public function update($data = [], $conditions = [])
  {
    
  }

  public function delete($conditions = [])
  {
    
  }



}
