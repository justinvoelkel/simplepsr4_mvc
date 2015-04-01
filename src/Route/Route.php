<?php
/**
 * Created by PhpStorm.
 * User: justinvoelkel
 * Date: 3/24/15
 * Time: 8:20 PM
 */

namespace simplepsr4\Route;

class Route {

    protected $routes = [];

    protected $controller = 'simplepsr4\Controllers\Home';
    protected $method = 'index';
    protected $params = [];
    protected $request = '';

    public function add($url,$method=false)
    {
        $this->routes[] = ['url'=>$url,'method'=>$method?:$this->method];
    }

    public function process($request)
    {
        $this->request = $request;

        $match = $this->matchRoute($request);
        $controller = $this->lookupController($request)?:$this->controller;
        $this->controller = $controller?new $controller:new $this->controller;

        if($this->controller)
        {

            if($method = $this->lookupMethod($this->routes[$match]['method'])){
                $this->method = $method;
            }

            $this->params = $this->request;
        }
        var_dump($this);
        call_user_func_array([$this->controller,$this->method],$this->params);

    }

    private function matchRoute($request)
    {
        $sanitized_url = filter_var(rtrim($request,'/'),FILTER_SANITIZE_URL);

        foreach($this->routes as $key=>$route)
        {
            if('/'.$sanitized_url == $route['url'])
            {
                return $key;
            }
        }

        return false;

    }

    private function lookupController($route)
    {
        $path =  explode('/',filter_var(rtrim($route,'/'),FILTER_SANITIZE_URL));
        $controllers_path = '/../Controllers/';
        $controller_namespace = 'simplepsr4\Controllers\\';
        $keys = array_keys($path);

        foreach($path as $k=>$v){

            if(is_dir(__DIR__.$controllers_path.ucfirst($v)))
            {
                $controllers_path.=ucfirst($v).'/';
                $controller_namespace.=ucfirst($v).'\\';
                unset($path[$k]);
                continue;
            }
            elseif(file_exists(__DIR__.$controllers_path.ucfirst($v).'.php'))
            {
                $controller_namespace.=ucfirst($v);
                unset($path[$k]);
                continue;
            }
            elseif( end($keys)!==$k )
            {
                return false;
            }

        }
        $this->request = $path;
        return $controller_namespace;
    }

    private function lookupMethod($method)
    {
        if(method_exists($this->controller,$method))
        {
            return $method;
        }

        return false;
    }
}