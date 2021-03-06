<?php
/**
 * Created by PhpStorm.
 * User: justinvoelkel
 * Date: 3/14/15
 * Time: 11:39 AM
 */

namespace simplepsr4\Core;
use simplepsr4\Models;
use Twig_Environment;
use Twig_Loader_Filesystem;

class Controller
{
    public function model($model)
    {
        $model = 'simplepsr4\Models\\'.ucfirst($model);
        return new $model();
    }

    public function view($view,$data=array())
    {
        $loader = new Twig_Loader_Filesystem(__DIR__.'/../Views');
        $twig = new Twig_Environment($loader,array('debug'=>true));
        $twig->addExtension(new \Twig_Extension_Debug());

        echo $twig->render($view.'.php',array('data'=>$data));
    }

}