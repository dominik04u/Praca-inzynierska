<?php


class Login extends Controller
{

    function __construct($params)
    {
        parent::__construct();
        if (isset($_SESSION['privilege']))
            header('Location: ' . URL);

        require_once 'libs/functions.php';
        if (isset($params[1])) {
            if (isset($params[2])) {
                if (isset($params[3])) {
                    $this->$params[1]($params[2], $params[3]);
                    $this->view->Render();
                } else {
                    $this->$params[1]($params[2]);
                    $this->view->Render();
                }
            } else {
                $this->$params[1]();
                $this->view->Render();
            }
        } else {
            $this->view->controller = $params[0];
            $this->view->page="Login";
            $this->view->Render();
        }
    }

    function setView($controller, $page)
    {
        $this->view->controller = $controller;
        $this->view->page = $page;
    }


    function login(){
        if(isset($_POST['submit'])&& $_POST['submit']=='login'){
            $this->data['index']=sanitizeString($_POST['index']);
            $this->data['password']=sanitizeString($_POST['password']);
        }
        try{
            $this->loadModel("Login");
            $model=new LoginModel();
            $model->setData($this->data);
            $control=$model->login();
            if($control>0){
                $this->loadModel("UserPanel");
                $model=new UserPanelModel();
                $control=$model->issetAddress();
                if($control>0)
                    header('Location: '.URL);
                else
                    header('Location: '.URL.'userPanel/setAddress');
            }
            else
                $this->view->message="Błąd";
        }catch (Exception $e){
            $this->view->controller="Login";
            $this->view->page="Login";
            $this->view->message=$e->getMessage();
            $this->view->Render();
        }

    }

    function logout(){
        session_destroy();
        $this->view->controller="Login";
        $this->view->page="Logout";
    }

    function remindPassword(){
        $this->setView("Login","PasswordReminder");
        if(isset($_POST['submit'])&& $_POST['submit']=='remindPassword'){
            $index=sanitizeString($_POST['index']);
            $this->loadModel("Login");
            $model=new LoginModel();
            $control=$model->setResetCode($index);
            if($control>0){
                $key=$model->getResetCode($index);
                $to=$model->getEmail($index);
                $link=URL.'login/resetPass/'.$index.'/'.$key;
                $subject='Resetowanie hasła';
                $message='Witaj! <br>
Otrzymaliśmy prośbę o wygenerowanie nowego hasła dla konta o indeksie '.$index.' <br>

Jeśli jest to błąd, to zignoruj tego e-maila<br><br>

Aby ustawić nowe hasło, przejdź pod poniższy adres:<br><br>
<a href="'.$link.'">Link resetujący</a>

'.$link;
                mail($to, $subject, $message);
                $this->view->message='Sukces';
            }else{
                $this->view->message='Błąd';
            }
        }
    }

    function resetPass($index,$key){
        $this->setView("Login","ResetPassword");
        $this->loadModel("Login");
        $model=new LoginModel();
        $pass=$model->resetPass($index,$key);
        if($pass!==0){
            $to=$model->getEmail($index);
            $subject='Nowe hasło';
            $message='Witaj! <br>

Oto Twoje nowe hasło: '.$pass.' <br><br>

Zaloguj się z jego pomocą';
            $this->view->message='Sukces';
            mail($to, $subject, $message);

        }
        else{
            $this->setView("PageNotFound","PageNotFound");
        }
    }
}

