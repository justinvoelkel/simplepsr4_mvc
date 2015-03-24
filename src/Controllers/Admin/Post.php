<?php
/**
 * Created by PhpStorm.
 * User: justinvoelkel
 * Date: 3/23/15
 * Time: 10:04 PM
 */

namespace simplepsr4\Controllers\Admin;
use simplepsr4\Core\Controller;
use simplepsr4\Models\Post as Posts;

class Post extends Controller{

    public function index(){
        $posts = Posts::all();
        echo json_encode($posts);
    }

}