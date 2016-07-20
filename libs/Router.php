<?php

class Router
{
    function __construct()
    {
        $this->request = isset($_GET['url'])? $_GET['url'] : 'index';
        $this->request = rtrim($this->request, "/");
        $this->params = explode("/", $this->request);
        $this->controller = $this->params[0];
        if ($this->controller == "index.php")
            $this->controller = "Index";
        $this->controller = ucfirst($this->controller);
        $file = 'controllers/' . $this->controller . '.php';

        if (file_exists($file)) {
            require_once $file;
            $this->connection = new $this->controller($this->params);
        } else {
            $file = 'controllers/PageNotFound.php';
            $this->controller = "PageNotFound";
            require_once $file;
            $this->connection = new $this->controller();
        }
    }
}

