<?php
/**
 * Created by PhpStorm.
 * User: justinvoelkel
 * Date: 3/15/15
 * Time: 5:00 PM
 */

namespace simplepsr4\App;


class App
{
    protected $controller = 'simplepsr4\Controllers\Home';
    protected $method = 'index';
    protected $params = [];

     public function __construct()
     {
         $url = $this->parseUrl();

         if(file_exists(__DIR__.'/../Controllers/'.ucfirst($url[0]).'.php'))
         {
             $this->controller = 'simplepsr4\Controllers\\'.ucfirst($url[0]);
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
            return $url = explode('/',filter_var(rtrim($_GET['url'],'/'),FILTER_SANITIZE_URL));
        }
    }
}