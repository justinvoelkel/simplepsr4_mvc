<?php
/**
 * Created by PhpStorm.
 * User: justinvoelkel
 * Date: 3/15/15
 * Time: 3:51 PM
 */
namespace simplepsr4\Controllers;
use simplepsr4\Core\Controller;

class Home extends Controller
{
    public function index($params=''){
        $this->view('Home');
    }
}