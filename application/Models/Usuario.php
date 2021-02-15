<?php
namespace App\Models;

use Moonwalk\Database\Model;

class Usuario extends Model 
{
  protected $_table = 'usuarios';

  
  public function __construct()
  {
    parent::__construct();
    
  }



}
