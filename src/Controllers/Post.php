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

    public function index($id){
        if($post = Posts::find($id)){
            $this->view('Post',$post->toArray());
        }else $this->view('Error');
    }

}