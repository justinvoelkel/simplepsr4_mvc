<?php
/**
 * Created by PhpStorm.
 * User: justinvoelkel
 * Date: 3/15/15
 * Time: 4:36 PM
 */

namespace simplepsr4\Controllers;
use simplepsr4\Core\Controller;
use simplepsr4\Models\Post as Posts;

class Post extends Controller {

    public function index($param=''){

        $posts = Posts::all();
        $this->view('Post',$posts);

    }

    public function create(){

    }

}