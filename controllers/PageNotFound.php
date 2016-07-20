<?php


class PageNotFound extends Controller
{

    function __construct()
    {
        parent::__construct();
        $this->view->controller = get_class($this);
        $this->view->page = get_class($this);
        $this->view->Render();
    }

}

