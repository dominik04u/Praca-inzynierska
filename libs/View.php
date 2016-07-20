<?php


class View
{

    function __construct()
    {

    }

    public function Render()
    {
        require_once 'views/Header.php';
        if ($this->controller == "Test")
            if (isset($this->page)) {
                $file = 'views/Test/' . ucfirst($this->page) . '.html';
                if (file_exists($file))
                    require_once $file;
                else {
                    $this->message = "Nie znaleziono pliku do przetestowania";
                    require_once 'views/Error.php';
                }

            } else {
                $this->message = "Nie znaleziono takiego pliku";
                require_once 'views/Error.php';
            }
        else{
            $file = 'views/' . ucfirst($this->controller) . '/' . ucfirst($this->page) . '.php';
        }
        if (file_exists($file)) {
            require_once $file;
        } else {
            $this->message = "Nie znaleziono pliku";
            require_once 'views/Error.php';
        }
        require_once 'views/Footer.php';
    }

}

