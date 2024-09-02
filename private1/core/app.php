<?php


class App {
    protected $controller = "home";
    protected $method = "Index"; 
    protected $params = array();

   public  function __construct(){
       // echo "<pre>";
        $URL = $this->getURL();
        if(file_exists("../private1/controllers/".$URL[0].".php")){
            $this->controller=ucfirst($URL[0]);
            unset($URL[0]);
        }else {
            echo "<center><h1>controler not found</h1></center>";
            die;
        }


        require "../private1/controllers/".$this->controller.".php";
        $this->controller = new $this->controller();
        if(isset($URL[1])){
        if(method_exists($this->controller, $URL[1])){
            $this->method  =ucfirst($URL[1]);
            unset($URL[1]);
        }
        }
        //echo "<pre>";
        //print_r($URL);
        $URL = array_values($URL);
        $this->params = $URL;
        call_user_func_array([$this->controller, $this->method], $this->params);

    }
    private function getURL(){
        $url =isset($_GET['url']) ? $_GET['url'] : "home";
       return explode("/", filter_var(trim($url, "/")),FILTER_SANITIZE_URL);  
      }
}


?>