<?php


class Test extends Controller
{

    function __construct($params)
    {
        parent::__construct();
        $this->view->controller = get_class($this);
        $this->view->page = $params[1];
        $this->view->Render();
    }

}

