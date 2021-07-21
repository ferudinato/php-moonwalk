<?php
namespace App\Controllers;

use App\Controllers\Base\Controller;
use App\Models\Post;
use App\Models\Usuario;
use Moonwalk\Helpers\Util;

class PostsController extends Controller {

  public function __construct()
  {
    parent::__construct();

  }

  public function index() 
  {
    $postModel = new Post();
    $posts = $postModel->get();

    // Util::mostrar($posts);

    // $user = new Usuario();
    
    // Util::mostrar( $user->get(['username'], ['id' => '1'], 'id desc', 3, 1) );
    // Util::mostrar( $user->get() );
    
    // $getUsers = $user->get(['id', 'username'], ['and' => ['id' => '1', 'username' => 'andres'], 'or' => ['username' => 'ferdroid']], 'id desc', 3, 0);
    // Util::mostrar($getUsers);
    // $getUsers = $user->get();
    // foreach ($getUsers as $u) {
    //   echo "{$u->id}  =>  {$u->username}<br />";
    // }

    // Util::mostrar($getUsers);

    // return "Blogpost: {$request[0]}";
    return $this->render('posts::index', ['posts' => json_encode($posts)]);
  }

  public function content($request) 
  {
    $slug = $request[0];

    $postModel = new Post();
    $post = $postModel->get([], ['slug' => $slug]);

    Util::mostrar($post);

    return $slug;
  }


}
