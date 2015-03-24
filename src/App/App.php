<?php
/**
 * Created by PhpStorm.
 * User: justinvoelkel
 * Date: 3/15/15
 * Time: 5:00 PM
 */

namespace simplepsr4\App;
require_once __DIR__.'/../Database/database.php';

class App
{
    protected $controller = 'simplepsr4\Controllers\Home';
    protected $method = 'index';
    protected $params = [];

    protected $prefix = array('admin','api');
    protected $controller_base = "/../Controllers/";
    protected $controller_namespace ='simplepsr4\Controllers\\';

     public function __construct()
     {
         $url = $this->parseUrl();

         if(file_exists(__DIR__.$this->controller_base.ucfirst($url[0]).'.php'))
         {
             $this->controller = $this->controller_namespace.ucfirst($url[0]);
             unset($url[0]);
         }

         $this->controller = new $this->controller();

         if(isset($url[1])){
             if(method_exists($this->controller,$url[1])){
                 $this->method = $url[1];
                 unset($url[1]);
             }
         }

         $this->params = $url ? array_values($url) : [];

         try
         {
             call_user_func_array([$this->controller,$this->method],$this->params);
         }
         catch(\Exception $e){
             echo 'App Exception: ', $e->getMessage();
         }

     }

    private function parseUrl()
    {

        if(isset($_GET['url']))
        {
            $url = explode('/',filter_var(rtrim($_GET['url'],'/'),FILTER_SANITIZE_URL));
            if(in_array($url[0],$this->prefix)){
                $this->controller_base = $this->controller_base.ucfirst($url[0])."/";
                $this->controller_namespace = $this->controller_namespace.ucfirst($url[0])."\\";
                array_shift($url);
            }

            return $url;
        }
    }
}