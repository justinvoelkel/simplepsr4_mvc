<?php
/**
 * Created by PhpStorm.
 * User: justinvoelkel
 * Date: 3/24/15
 * Time: 8:20 PM
 */

namespace simplepsr4\Route;


class Route {

    protected $url = [];
    protected $resources = [];

    protected $controller = 'simplepsr4\Controllers\Home';
    protected $method = 'index';
    protected $params = [];



    public function add($url,$method = 'index')
    {
        $this->resources[] = ['url'=>$url,'method'=>$method];
    }

    public function process($request)
    {

        $this->controller = $this->lookup($request)?:$this->controller;
        $this->method = $this->match($request)?:$this->method;

        $this->controller = new $this->controller;

        call_user_func_array([$this->controller,$this->method],$this->params);

    }

    private function match($request)
    {
        $sanitized_url = filter_var(rtrim($request,'/'),FILTER_SANITIZE_URL);

        foreach($this->resources as $key=>$resource)
        {
            if('/'.$sanitized_url == $resource['url'])
            {
                $this->method = $resource['method'];
            }
        }

        return $this->method;

    }

    private function lookup($url)
    {

        $sanitized_url = filter_var(rtrim($url,'/'),FILTER_SANITIZE_URL);
        $ar1 = explode('/',$sanitized_url);
        $controllers_path = '/../Controllers/';
        $controller_namespace = 'simplepsr4\Controllers\\';
        $keys = array_keys($ar1);

        foreach($ar1 as $k=>$v){

            if(is_dir(__DIR__.$controllers_path.ucfirst($v)))
            {
                $controllers_path.=ucfirst($v).'/';
                $controller_namespace.=ucfirst($v).'\\';
                continue;
            }
            elseif(file_exists(__DIR__.$controllers_path.ucfirst($v).'.php'))
            {
                $controller_namespace.=ucfirst($v);
                continue;
            }
            elseif( end($keys)!==$k )
            {
                return null;
            }
            else
            {
                $this->params[] = $v;
            }

            return $controller_namespace;
        }
    }

}