<?php
/**
 * Created by PhpStorm.
 * User: justinvoelkel
 * Date: 3/14/15
 * Time: 11:39 AM
 */

namespace simplepsr4\Core;
use simplepsr4\Models;

class Controller
{
    public function model($model)
    {
        $model = 'simplepsr4\Models\\'.ucfirst($model);
        return new $model();
    }

    public function view($view,$data=[])
    {
        require_once __DIR__.'/../Views/'. $view .'.php';
    }

}