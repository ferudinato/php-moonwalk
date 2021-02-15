<?php
namespace App\Controllers;

use App\Controllers\Base\Controller;


class DocsController extends Controller {

  public function __construct()
  {
    
  }

  public function index() 
  {
    return 'Get Started';
  }

  public function manual()
  {
    return 'Documentation';
  }

  public function changelog()
  {
    return 'Changelog';
  }

  

}
