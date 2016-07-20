<?php


class Register extends Controller
{
    private $data;

    function __construct($params)
    {
        parent::__construct();
        $this->view->controller=$params[0];
        if(isset($params[1]) && method_exists($this,$this->$params[1]())){
            $this->$params[1]();
        }
        if($this->view->page=="Successful")
            $this->view->page="Successful";
        else
            $this->view->page="Register";
        $this->view->Render();
    }

    function register(){
        require_once 'libs/functions.php';
        if(isset($_POST['submit']) && $_POST['submit']=='register'){
            $this->data['name']=sanitizeString($_POST['name']);
            $this->data['surname']=sanitizeString($_POST['surname']);
            $this->data['email']=sanitizeString($_POST['email']);
            $this->data['password']=$_POST['password'];
            $this->data['index']=sanitizeString($_POST['index']);
            $this->data['phone']=sanitizeString($_POST['phone']);
            $this->data['birth']=sanitizeString($_POST['birth']);
            $this->data['subject']=sanitizeString($_POST['subject']);
            $this->data['system']=$_POST['system'];
            $this->data['degree']=$_POST['degree'];
            $this->data['semester']=$_POST['semester'];
        }
        try{
            $this->loadModel("Register");
            $model=new RegisterModel();
            $model->setData($this->data);
            $control=$model->register();
            if($control>0){
                $this->view->controller="Register";
                $this->view->page="Successful";
                $this->view->Render();
                header('refresh:5; url='.URL);
            }else{
                $this->view->controller="Register";
                $this->view->page="Register";
                $this->view->message="Błąd";
                $this->view->Render();
            }
        }catch (Exception $e){
            $this->view->controller="Register";
            $this->view->page="Register";
            $this->view->message=$e->getMessage();
            $this->view->Render();
        }

    }
}

