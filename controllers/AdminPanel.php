<?php


class AdminPanel extends Controller
{

    function __construct($params)
    {
        parent::__construct();
        require_once 'libs/functions.php';
        if ($_SESSION['privilege'] != 'admin') {
            $this->setView("PageNotFound", "PermissionDenied");
            $this->view->Render();
        } else {
            if (isset($params[1])) {
                if (isset($params[2])) {
                    $this->$params[1]($params[2]);
                    $this->view->Render();
                } else {
                    $this->$params[1]();
                    $this->view->Render();
                }
            } else {
                $this->view->message = $this->getNews();
                $this->setView("AdminPanel", "AdminPanel");
                $this->view->Render();
            }
        }
    }

    function getNews()
    {
        $this->loadModel("Index");
        $model = new IndexModel();
        $this->view->news = $model->getNews();
    }

    function setView($controller, $page)
    {
        $this->view->controller = $controller;
        $this->view->page = $page;
    }

    function messageWindow()
    {
        $this->setView("AdminPanel", "MessageWindow");
        $this->view->Render();
    }

    function sendMessage()
    {
        $this->data['index'] = sanitizeString($_POST['index']);
        $this->data['text'] = sanitizeString($_POST['message']);
        $this->data['from'] = $_SESSION['id_admin'];
        $this->loadModel("AdminPanel");
        $model = new AdminPanelModel();
        $control = $model->sendMessage($this->data);
        if ($control > 0)
            echo "Wiadomość została wysłana";
        else
            echo "Wiadomość nie została wysłana";
    }

    function newsWindow()
    {
        $this->setView("AdminPanel", "NewsWindow");
        $this->view->Render();
    }

    function postNews()
    {
        $this->data['title'] = sanitizeString($_POST['title']);
        $this->data['news_text'] = sanitizeString($_POST['news_text']);
        $this->loadModel("AdminPanel");
        $model = new AdminPanelModel();
        $control = $model->postNews($this->data);
        if ($control > 0) {
            $this->view->alert = "Sukces";
            $this->newsWindow();
        } else {
            $this->view->alert = "Błąd";
            $this->newsWindow();
        }
    }

    function deleteNews($id)
    {
        $this->loadModel("AdminPanel");
        $model = new AdminPanelModel();
        $control = $model->deleteNews($id);
        if ($control > 0)
            header('Location: ' . URL . 'adminPanel');
        else
            echo "Oh no";
    }

    function editNews($id)
    {
        $this->setView("AdminPanel", "EditNewsWindow");
        $this->loadModel("AdminPanel");
        $model = new AdminPanelModel();
        $this->view->news = $model->getNews($id);
        if (isset($_POST['submit']) && $_POST['submit'] == 'changeNews') {
            $this->data['title'] = sanitizeString($_POST['title']);
            $this->data['news_text'] = sanitizeString($_POST['news_text']);
            $this->data['id_news'] = $id;
            try {
                $control = $model->updateNews($this->data);
                if ($control > 0) {
                    $this->view->alert = "Sukces";
                    $this->view->news = $model->getNews($id);
                } else {
                    $this->view->alert = "Błąd";
                    $this->newsWindow();
                }
            } catch (Exception $e) {
                $this->view->message = "Error";
            }
        }
    }

    function studentWindow()
    {
        $this->setView("AdminPanel", "StudentWindow");
        if (isset($_POST['submit']) && $_POST['submit'] == 'searchStudent') {
            $query = "";
            if ($_POST['search'] == 'index') {
                $data['index'] = sanitizeString($_POST['index']);
                $query = 'WHERE st_index LIKE "' . $data['index'] . '%"';
            } elseif ($_POST['search'] == 'name') {
                $data['name'] = sanitizeString($_POST['name']);
                $data['surname'] = sanitizeString($_POST['surname']);
                $query = 'WHERE name LIKE "' . $data['name'] . '%" AND surname LIKE "' . $data['surname'] . '%"';
            } elseif ($_POST['search'] == 'faculty') {
                $data['faculty'] = $_POST['faculty'];
                $query = 'INNER JOIN subject AS s ON st.id_subject=s.id_subject INNER JOIN faculty AS f ON s.id_faculty=f.id_faculty WHERE f.name="' . $data['faculty'] . '"';
            } elseif ($_POST['search'] == 'subject') {
                $data['subject'] = $_POST['subject'];
                $query = 'INNER JOIN subject AS s ON st.id_subject=s.id_subject WHERE s.name="' . $data['subject'] . '"';
            } elseif ($_POST['search'] == 'system') {
                $data['system'] = $_POST['system'];
                $query = 'WHERE system="' . $data['system'] . '"';
            } elseif ($_POST['search'] == 'degree') {
                $data['degree'] = $_POST['degree'];
                $query = 'WHERE degree="' . $data['degree'] . '"';
            } elseif ($_POST['search'] == 'semester') {
                $data['semester'] = $_POST['semester'];
                $query = 'WHERE semester=' . $data['semester'];
            }
            $this->loadModel("AdminPanel");
            $model = new AdminPanelModel();
            $this->view->data = $model->getStudents($query);
        }
    }

    function showStudentProfile($index)
    {
        $this->loadModel("AdminPanel");
        $model = new AdminPanelModel();
        $this->view->news = $model->getStudentProfile($index);
        $this->setView("UserPanel", "ProfileData");
    }

    function showApplication($index)
    {
        $this->setView("AdminPanel", "ApplicationWindow");
        $this->loadModel("AdminPanel");
        $model = new AdminPanelModel();
        $control = $model->applicationExists($index);
        if ($control > 0) {
            $this->view->data = $model->getApplicationData($index);
        } else {
            $this->view->data = $control;
        }
        if (isset($_POST['submit']) && $_POST['submit'] == "changeStatus") {
            $this->data['status'] = $_POST['status'];
            $this->data['index'] = $index;
            try {
                $control = $model->changeAppStatus($this->data);
                if ($control > 0) {
                    $this->view->message = "Sukces";
                } else {
                    $this->view->message = "Błąd";
                }
            } catch (Exception $e) {
                $this->view->message = "Error";
            }
        }
        $control = $model->applicationExists($index);
        if ($control > 0) {
            $this->view->data = $model->getApplicationData($index);
        } else {
            $this->view->data = $control;
        }
    }

    function applicationsWindow()
    {
        $this->setView("AdminPanel", "ApplicationsListWindow");
        $this->loadModel("AdminPanel");
        $model = new AdminPanelModel();
        $this->view->data = $model->getApplicationList();
    }

    function setDecision($index)
    {
        $this->setView("AdminPanel", "DecisionWindow");
        $this->loadModel("AdminPanel");
        $model = new AdminPanelModel();
        $control = $model->applicationExists($index);
        if ($control > 0) {
            $this->view->data = $model->getApplicationData($index);
        } else {
            $this->view->data = $control;
        }
        if (isset($_POST['submit']) && $_POST['submit'] == "setDecision") {
            if ($_POST['decision'] == "positive") {
                $this->data['status']="Przyznano";
                $this->data['index'] = $index;
                $this->data['scholarship'] = sanitizeString($_POST['amount']);
                $this->data['dateFrom'] = date('Y-m-d', strtotime(sanitizeString($_POST['dateFrom'])));
                $this->data['dateTo'] = date('Y-m-d', strtotime(sanitizeString($_POST['dateTo'])));
                if (isset($_POST['dormAddBox'])) {
                    $this->data['dormAdd'] = 1;
                } else {
                    $this->data['dormAdd'] = 0;
                }
            } else {
                $this->data['status']="Nie przyznano";
                $this->data['index'] = $index;
                $this->data['scholarship'] = 0;
                $this->data['dateFrom'] = NULL;
                $this->data['dateTo'] = NULL;
                $this->data['dormAdd'] = 0;
            }
            try {
                $control = $model->setDecision($this->data);
                if ($control > 0) {
                    $this->view->message = "Sukces";
                } else {
                    $this->view->message = "Błąd";
                }
            } catch (Exception $e) {
                $this->view->message = "Error";
            }
        }

    }

}

