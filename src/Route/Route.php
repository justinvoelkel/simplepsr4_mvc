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
        $request = $this->matchRoute($request);
        $request = $request?$this->lookupController($request):false;
        $this->controller = new $this->controller;
        $this->method = $request?$this->lookupMethod($request):false;

        call_user_func_array([$this->controller,$this->method],$this->params);

    }

    private function matchRoute($request)
    {
        $sanitized_url = filter_var(rtrim($request,'/'),FILTER_SANITIZE_URL);

        foreach($this->resources as $key=>$resource)
        {

            if('/'.$sanitized_url == $resource['url'])
            {
                return $request;
            }
            elseif('/'.(rtrim(substr($sanitized_url,0,strrpos($sanitized_url,'/')+1),'/')) == $resource['url'])
            {
                $temp = explode('/',$sanitized_url);
                $this->params[] = array_pop($temp);
                return implode('/',$temp).'/';
            }
        }

        return false;

    }

    private function lookupController($route)
    {var_dump($route);
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
                $this->controller = $controller_namespace.ucfirst($v);
                unset($path[$k]);
                continue;
            }
            elseif( end($keys)!==$k )
            {
                return false;
            }

        }

        return $path;

    }

    private function lookupMethod($method)
    {
        return method_exists($this->controller,$method);
    }
}