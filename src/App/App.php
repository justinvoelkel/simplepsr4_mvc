<?php
/**
 * Created by PhpStorm.
 * User: justinvoelkel
 * Date: 3/15/15
 * Time: 5:00 PM
 */

namespace simplepsr4\App;
use simplepsr4\Route\Route;
require_once __DIR__.'/../Database/database.php';


class App
{
     public function __construct()
     {
         $route = new Route();

         $route->add('/');
         $route->add('/post');
         $route->add('/admin/post');
         $route->add('/admin/post/create');

         $request = isset($_GET['url'])?$_GET['url']:'/';
         $route->process($request);

     }

}