<?php
namespace App\Controllers;

use App\Controllers\Base\Controller;


class WelcomeController extends Controller {

  public function __construct()
  {
    parent::__construct();
    
  }

  public function index() 
  {
    return $this->render('welcome::index', 
      ['name' => 'Moonwalk', 
        'author' => [
          'name' => 'Ferdinania',
          'website' => 'https://www.ferdinania.com'
        ]
      ]
    );
  }

  
}
