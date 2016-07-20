<?php


class Index extends Controller
{

    function __construct($params)
    {
        parent::__construct();

        $this->getNews();
        if (isset($params[1])) {
            $this->$params[1]();
            $this->view->Render();
        } else {
            $this->setView("Index", "Index");
            $this->view->Render();
        }
    }

    function setView($controller, $page)
    {
        $this->view->controller = $controller;
        $this->view->page = $page;
    }

    function getNews()
    {
        $this->loadModel("Index");
        $model = new IndexModel();
        $this->view->news = $model->getNews();
    }

    function help()
    {
        $this->setView("Index", "Help");
    }

    function sendEmail()
    {
        $this->setView("Index", "ContactForm");
        require_once 'libs/functions.php';
        if (isset($_POST['submit']) && $_POST['submit'] == 'sendEmail') {
            $headers = 'From: ' . $_POST['sender'];
            $to = $_POST['receiver'];
            $subject = $_POST['subject'];
            $message = $_POST['message'];
            $control = mail($to, $subject, $message, $headers);
            if ($control > 0) {
                $this->view->alert = "Sukces";
            } else {
                $this->view->alert = "Błąd";
            }
        }
    }

}

