<?php


class AdminLogin extends Controller
{

    function __construct($params)
    {
        parent::__construct();
        if(isset($_SESSION['privilege']))
            header('Location: '.URL);
            $this->view->controller = $params[0];
            if (isset($params[1]) && method_exists($this, $this->$params[1]())) {
                $this->$params[1]();
                print_r($params);
            }
            if ($this->view->page == "Logout")
                $this->view->page = "Logout";
            else
                $this->view->page = "AdminLogin";
            $this->view->Render();
    }

    function login(){
        require_once 'libs/functions.php';
        if(isset($_POST['submit'])&& $_POST['submit']=='login'){
            $this->data['login']=sanitizeString($_POST['login']);
            $this->data['password']=sanitizeString($_POST['password']);
        }
        try{
            $this->loadModel("AdminLogin");
            $model=new AdminLoginModel();
            $model->setData($this->data);
            $control=$model->login();
            if($control>0)
                header('Location: '.URL.'adminPanel');
            else
                echo "Błąd";
        }catch (Exception $e){
            $this->view->controller="AdminLogin";
            $this->view->page="AdminLogin";
            $this->view->message=$e->getMessage();
            $this->view->Render();
        }

    }

    function logout(){
        session_destroy();
        $this->view->controller="AdminLogin";
        $this->view->page="Logout";
        $this->view->Render();
    }

}
