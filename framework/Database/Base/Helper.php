<?php
namespace Moonwalk\Database\Base;


interface Helper 
{
  
  // function execute($query, $conditions = []);

  function get($fields = [], $conditions = [], $order = '', $limit = null, $offset = null);

  function save($data = []);

  function update($data = [], $conditions = []);

  function delete($conditions = []);

}