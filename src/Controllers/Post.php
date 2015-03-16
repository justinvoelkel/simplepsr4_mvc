<?php
/**
 * Created by PhpStorm.
 * User: justinvoelkel
 * Date: 3/15/15
 * Time: 4:36 PM
 */

namespace simplepsr4\Controllers;
use simplepsr4\Core\Controller;

class Post extends Controller {

    public function index($param=''){
        $post = $this->model('Post');
        $post->title = $param;

        echo $post->title;
    }

}