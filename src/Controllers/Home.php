<?php
/**
 * Created by PhpStorm.
 * User: justinvoelkel
 * Date: 3/15/15
 * Time: 3:51 PM
 */
namespace simplepsr4\Controllers;
use simplepsr4\Core\Controller;
use simplepsr4\Models\Post;

class Home extends Controller
{
    public function index(){
        $posts = Post::all()->toArray();
        $this->view('Home',$posts);
    }
}