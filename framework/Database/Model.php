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
    else {
      foreach($fields as $i => $v) {
        $fields[$i] = "{$this->_table}.{$v}";
      }
      $fields = implode(', ', $fields);
    }

    $wh = "";
    if (!empty($conditions)) {
      if (count($conditions) > 0) {
        foreach ($conditions as $cond => $value) {
          if ($cond == 'and' || $cond == 'or') {
            if (count($value) > 1) {
              foreach ($value as $key => $val) {
                $wh .= "{$this->_table}.{$key} = '{$val}' {$cond} ";
              }
            }
          } else {
            $wh .= "{$this->_table}.{$cond} = '{$value}' ";
          }
        }
        if (array_key_first($conditions) == 'and' || array_key_first($conditions) == 'or') {
          $wh = rtrim(substr($wh, 0, -4));
        }
      }
    }

    $prepareQuery = "SELECT {$fields} FROM {$this->_table} ";
    if ($wh != '') {
      $prepareQuery .= "WHERE {$wh} ";
    }
    if ($order != null) {
      $prepareQuery .= "ORDER BY {$order} ";
    }
    if ($limit != null) {
      $prepareQuery .= "LIMIT {$limit} ";
      if ($offset != null) {
        $prepareQuery .= "OFFSET {$offset} ";
      }
    }

    Util::mostrar($prepareQuery);
    
    return $this->execute($prepareQuery);
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
