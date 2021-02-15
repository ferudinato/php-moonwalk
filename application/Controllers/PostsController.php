<?php
namespace App\Controllers;

use App\Controllers\Base\Controller;


class PostsController extends Controller {

  public function __construct()
  {
    parent::__construct();

  }

  public function index($request) 
  {
    return "Blogpost: {$request[0]}";
  }


}
