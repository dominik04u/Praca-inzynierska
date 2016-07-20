<?php


class UserPanel extends Controller
{

    function __construct($params)
    {
        parent::__construct();
        require_once 'libs/functions.php';
        if ($_SESSION['privilege'] != 'user') {
            $this->setView("PageNotFound", "PermissionDenied");
            $this->view->Render();
        } else {
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
                $this->setView("UserPanel", "UserPanel");
                $this->view->Render();
            }
        }
    }

    function setView($controller, $page)
    {
        $this->view->controller = $controller;
        $this->view->page = $page;
    }

    function messageWindow()
    {
        $this->loadModel("UserPanel");
        $model = new UserPanelModel();
        $this->view->news = $model->getMessage();
        $this->setView("UserPanel", "MessageWindow");
    }

    function profileData()
    {
        $this->loadModel("UserPanel");
        $model = new UserPanelModel();
        $this->view->news = $model->getProfile();
        $this->setView("UserPanel", "ProfileData");
    }

    function setAddress()
    {
        $this->setView("UserPanel", "AddAddress");
        if (isset($_POST['submit']) && $_POST['submit'] == 'addAddress') {
            $this->data['place'] = sanitizeString($_POST['place']);
            $this->data['street'] = $_POST['street'] ? sanitizeString($_POST['street']) : '';
            $this->data['house_number'] = sanitizeString($_POST['houseNumber']);
            $this->data['flat_number'] = $_POST['flatNumber'] ? sanitizeString($_POST['flatNumber']) : '';
            $this->data['zip_code'] = sanitizeString($_POST['zipCode']);
            $this->data['post_office'] = sanitizeString($_POST['postOffice']);
            try {
                $this->loadModel("UserPanel");
                $model = new UserPanelModel();
                $control = $model->setAddress($this->data);
                if ($control > 0)
                    $this->view->message = 'Sukces';
                else
                    $this->view->message = 'Błąd';

            } catch (Exception $e) {
                $this->view->message = $e;
            }
        }
    }

    function changePassword()
    {
        $this->setView("UserPanel", "ChangePassword");
        if (isset($_POST['submit']) && $_POST['submit'] == 'changePassword') {
            $this->loadModel("UserPanel");
            $model = new UserPanelModel();
            $control = $model->getPassword();
            if (hashing($_POST['oldPassword']) == $control) {
                if (isset($_POST['newPassword']) && $_POST['newPassword'] == $_POST['confirmPassword']) {
                    $control = $model->changePassword(hashing($_POST['newPassword']));
                    if ($control > 0)
                        $this->view->message = "Sukces";
                    else
                        $this->view->message = "Błąd";
                } else $this->view->message = "Nowe hasło nie zostało ustawione lub hasła różnią się";
            } else {
                $this->view->message = "Podane nieprawidłowe hasło";
            }
        }
    }

    function changeAddress()
    {
        $this->setView("UserPanel", "ChangeAddress");
        $this->loadModel("UserPanel");
        $model = new UserPanelModel();
        $this->view->news = $model->getAddress();
        if (isset($_POST['submit']) && $_POST['submit'] == 'changeAddress') {
            $this->data['place'] = sanitizeString($_POST['place']);
            $this->data['street'] = $_POST['street'] ? sanitizeString($_POST['street']) : '';
            $this->data['house_number'] = sanitizeString($_POST['houseNumber']);
            $this->data['flat_number'] = $_POST['flatNumber'] ? sanitizeString($_POST['flatNumber']) : '';
            $this->data['zip_code'] = sanitizeString($_POST['zipCode']);
            $this->data['post_office'] = sanitizeString($_POST['postOffice']);
            try {
                $control = $model->updateAddress($this->data);
                if ($control > 0) {
                    $this->view->message = "Sukces";
                    $this->view->news = $model->getAddress();
                } else
                    $this->view->message = "Błąd";

            } catch (Exception $e) {
                $this->view->message = "Error";
            }
        }
    }

    function changeData()
    {
        $this->setView("UserPanel", "ChangeProfileData");
        $this->loadModel("UserPanel");
        $model = new UserPanelModel();
        $this->view->data = $model->getProfileData();
        if (isset($_POST['submit']) && $_POST['submit'] == 'changeData') {
            $this->data['name'] = sanitizeString($_POST['name']);
            $this->data['surname'] = sanitizeString($_POST['surname']);
            $this->data['email'] = sanitizeString($_POST['email']);
            $this->data['phone'] = sanitizeString($_POST['phone']);
            $this->data['birth'] = sanitizeString($_POST['birth']);
            $this->data['subject'] = sanitizeString($_POST['subject']);
            $this->data['system'] = $_POST['system'];
            $this->data['degree'] = $_POST['degree'];
            $this->data['semester'] = $_POST['semester'];
            try {
                $control = $model->updateProfileData($this->data);
                if ($control > 0) {
                    $this->view->data = $model->getProfileData();
                    $this->view->message = "Sukces";

                } else
                    $this->view->message = "Błąd";
            } catch (Exception $e) {
                $this->view->message = "Error";
            }
        }
    }

    function familyWindow()
    {
        $this->setView("UserPanel", "Family");
        $this->loadModel("Application");
        $model = new ApplicationModel();
        $this->view->data = $model->getFamily();
    }

    function addFamilyMember()
    {
        $this->setView("UserPanel", "AddFamilyMember");
        if (isset($_POST['submit']) && $_POST['submit'] == "addFamilyMember") {
            if (in_array($_POST['relationship'], array('Brat', 'Siostra', 'Dziecko', 'Dziecko opiekuna'))) {
                $birth = new DateTime($_POST['birth']);
                $today = new DateTime('today');
                $age = $birth->diff($today)->y;
                if ($age > 25) {
                    $this->view->message = "Uwaga";
                } else {
                    if ($_POST['school'] == 'schoolYes') {
                        $this->_addFamilyMember();
                    } else {
                        $this->view->message = "Uwaga";
                    }
                }
            } else {
                $this->_addFamilyMember();
            }

        }
    }

    function _addFamilyMember()
    {
        $this->data['name'] = sanitizeString($_POST['name']);
        $this->data['surname'] = sanitizeString($_POST['surname']);
        $this->data['relationship'] = sanitizeString($_POST['relationship']);
        $this->data['birth'] = date('Y-m-d', strtotime($_POST['birth']));
        try {
            $this->loadModel("Application");
            $model = new ApplicationModel();
            $control = $model->addFamilyMember($this->data);
            if ($control > 0) {
                $this->view->message = "Sukces";
            } elseif ($control < 0)
                $this->view->message = "W bazie znajduje się już osoba o takim stopniu pokrewieństwia<br>";
            else
                $this->view->message = "Błąd";

        } catch (Exception $e) {
            $this->view->message = "Error";
        }
    }

    function deleteFamilyMember($id)
    {
        $this->loadModel("Application");
        $model = new ApplicationModel();
        $control = $model->deleteFamilyMember($id);
        if ($control > 0)
            header('Location: ' . URL . 'UserPanel/familyWindow');
        else
            echo "Oh no";
    }

    function editFamilyMember($id)
    {
        $this->setView("UserPanel", "EditFamilyMember");
        $this->loadModel("Application");
        $model = new ApplicationModel();
        $this->view->news = $model->getFamilyMember($id);
        if (isset($_POST['submit']) && $_POST['submit'] == "editFamilyMember") {
            if (in_array($_POST['relationship'], array('Brat', 'Siostra', 'Dziecko', 'Dziecko opiekuna'))) {
                $birth = new DateTime($_POST['birth']);
                $today = new DateTime('today');
                $age = $birth->diff($today)->y;
                if ($age > 25) {
                    $this->view->message = "Uwaga";
                } else {
                    if ($_POST['school'] == 'schoolYes') {
                        $this->data['name'] = sanitizeString($_POST['name']);
                        $this->data['surname'] = sanitizeString($_POST['surname']);
                        $this->data['relationship'] = sanitizeString($_POST['relationship']);
                        $this->data['birth'] = sanitizeString($_POST['birth']);
                        $this->data['id_member'] = $id;
                        try {
                            $control = $model->editFamilyMember($this->data);
                            if ($control > 0) {
                                $this->view->message = "Sukces";
                                $this->view->news = $model->getFamilyMember($id);
                            } elseif ($control < 0)
                                $this->view->message = "W bazie znajduje się już osoba o takim stopniu pokrewieństwia<br>";
                            else
                                $this->view->message = "Błąd";

                        } catch (Exception $e) {
                            $this->view->message = "Error";
                        }
                    } else {
                        $this->view->message = "Uwaga";
                    }
                }
            } else {
                $this->data['name'] = sanitizeString($_POST['name']);
                $this->data['surname'] = sanitizeString($_POST['surname']);
                $this->data['relationship'] = sanitizeString($_POST['relationship']);
                $this->data['birth'] = sanitizeString($_POST['birth']);
                $this->data['id_member'] = $id;
                try {
                    $control = $model->editFamilyMember($this->data);
                    if ($control > 0) {
                        $this->view->message = "Sukces";
                        $this->view->news = $model->getFamilyMember($id);
                    } elseif ($control < 0)
                        $this->view->message = "W bazie znajduje się już osoba o takim stopniu pokrewieństwia<br>";
                    else
                        $this->view->message = "Błąd";

                } catch (Exception $e) {
                    $this->view->message = "Error";
                }
            }

        }
    }

    function studentIncomeWindow()
    {
        $this->setView("UserPanel", "StudentIncomeList");
        $this->loadModel("Application");
        $model = new ApplicationModel();
        $this->view->data = $model->getStudentIncomes();
    }

    function deleteStudentIncome($id)
    {
        $this->loadModel("Application");
        $model = new ApplicationModel();
        $control = $model->deleteStudentIncome($id);
        if ($control > 0)
            header('Location: ' . URL . 'UserPanel/studentIncomeWindow');
        else
            echo "Oh no";
    }

    function addStudentIncome()
    {
        $this->setView("UserPanel", "Income");
        if (isset($_POST['submit']) && $_POST['submit'] == 'addIncome') {
            $this->data['incomeName'] = sanitizeString($_POST['incomeName']);
            $this->data['incomeType'] = sanitizeString($_POST['incomeType']);
            if ($_POST['incomeType'] == 'Alimenty płacone') {
                $this->data['incomeAmount'] = sanitizeString($_POST['incomeAmount']);
                $this->data['incomeAmount'] *= -1;
            } else
                $this->data['incomeAmount'] = sanitizeString($_POST['incomeAmount']);
            $this->data['incomeTax'] = sanitizeString($_POST['incomeTax']);
            $this->data['healthInsurance'] = sanitizeString($_POST['healthInsurance']);
            $this->data['socialInsurance'] = sanitizeString($_POST['socialInsurance']);
            $this->data['dateFrom'] = date('Y-m-d', strtotime(sanitizeString($_POST['dateFrom'])));
            $this->data['dateTo'] = date('Y-m-d', strtotime(sanitizeString($_POST['dateTo'])));
            $this->loadModel('Application');
            try {
                $model = new ApplicationModel();
                $control = $model->addStudentIncome($this->data);
                if ($control > 0)
                    header('Location: ' . URL . 'UserPanel/studentIncomeWindow');
                else
                    $this->view->message = "Błąd";
            } catch (Exception $e) {
                $this->view->message = $e;
            }
        }
    }

    function editStudentIncome($id)
    {
        $this->setView("UserPanel", "EditIncome");
        $this->loadModel("Application");
        $model = new ApplicationModel();
        $this->view->data = $model->getStudentIncome($id);
        if (isset($_POST['submit']) && $_POST['submit'] == 'editIncome') {
            $this->data['incomeName'] = sanitizeString($_POST['incomeName']);
            $this->data['incomeType'] = sanitizeString($_POST['incomeType']);
            if ($_POST['incomeType'] == 'Alimenty płacone') {
                $this->data['incomeAmount'] = sanitizeString($_POST['incomeAmount']);
                $this->data['incomeAmount'] *= -1;
            } else
                $this->data['incomeAmount'] = sanitizeString($_POST['incomeAmount']);
            $this->data['incomeTax'] = sanitizeString($_POST['incomeTax']);
            $this->data['healthInsurance'] = sanitizeString($_POST['healthInsurance']);
            $this->data['socialInsurance'] = sanitizeString($_POST['socialInsurance']);
            $this->data['dateFrom'] = date('Y-m-d', strtotime(sanitizeString($_POST['dateFrom'])));
            $this->data['dateTo'] = date('Y-m-d', strtotime(sanitizeString($_POST['dateTo'])));
            $this->data['income_id'] = $id;
            try {
                $control = $model->updateStudentIncome($this->data);
                if ($control > 0) {
                    $this->view->message = "Sukces";
                    $this->view->data = $model->getStudentIncome($id);
                } else
                    $this->view->message = "Błąd";
            } catch (Exception $e) {
                $this->view->message = $e;
            }
        }
    }

    function familyIncomeWindow($id)
    {
        $this->setView("UserPanel", "FamilyIncomeList");
        $this->loadModel("Application");
        $model = new ApplicationModel();
        $this->view->data = $model->getFamilyIncomes($id);
        $this->view->id_member = $id;
    }

    function deleteFamilyIncome($id_member, $id_income)
    {
        $this->loadModel("Application");
        $model = new ApplicationModel();
        $control = $model->deleteFamilyIncome($id_income);
        if ($control > 0) {
            header('Location: ' . URL . 'userPanel/familyIncomeWindow/' . $id_member);
        } elseif ($control < 0)
            $this->view->message = "Nie masz dostępu";
        else
            $this->view->message = "Błąd";
    }

    function addFamilyIncome($id)
    {
        $this->setView("UserPanel", "Income");
        if (isset($_POST['submit']) && $_POST['submit'] == 'addIncome') {
            $this->data['incomeName'] = sanitizeString($_POST['incomeName']);
            $this->data['incomeType'] = sanitizeString($_POST['incomeType']);
            if ($_POST['incomeType'] == 'Alimenty płacone') {
                $this->data['incomeAmount'] = sanitizeString($_POST['incomeAmount']);
                $this->data['incomeAmount'] *= -1;
            } else
                $this->data['incomeAmount'] = sanitizeString($_POST['incomeAmount']);
            $this->data['incomeTax'] = sanitizeString($_POST['incomeTax']);
            $this->data['healthInsurance'] = sanitizeString($_POST['healthInsurance']);
            $this->data['socialInsurance'] = sanitizeString($_POST['socialInsurance']);
            if ($_POST['incomeType'] == "Student") {
                $this->data['dateFrom'] = date('Y-m-d');
                $this->data['dateTo'] = date('Y-m-d');
            } else {
                $this->data['dateFrom'] = date('Y-m-d', strtotime(sanitizeString($_POST['dateFrom'])));
                $this->data['dateTo'] = date('Y-m-d', strtotime(sanitizeString($_POST['dateTo'])));
            }
            $this->data['idMember'] = $id;
            $this->loadModel('Application');
            try {
                $model = new ApplicationModel();
                $control = $model->addFamilyIncome($this->data);
                if ($control > 0)
                    header('Location: ' . URL . 'UserPanel/familyIncomeWindow/' . $id);
                else
                    $this->view->message = "Błąd";
            } catch (Exception $e) {
                $this->view->message = $e;
            }
        }
    }

    function editFamilyIncome($id_member, $id_income)
    {
        $this->setView("UserPanel", "EditIncome");
        $this->loadModel("Application");
        $model = new ApplicationModel();
        $control = $model->getFamilyIncome($id_member, $id_income);
        if ($control < 0) {
            $this->view->message = "Nie masz dostępu";
        } else {
            $this->view->data = $model->getFamilyIncome($id_member, $id_income);
            if (isset($_POST['submit']) && $_POST['submit'] == 'editIncome') {
                $this->data['incomeName'] = sanitizeString($_POST['incomeName']);
                $this->data['incomeType'] = sanitizeString($_POST['incomeType']);
                if ($_POST['incomeType'] == 'Alimenty płacone') {
                    $this->data['incomeAmount'] = sanitizeString($_POST['incomeAmount']);
                    $this->data['incomeAmount'] *= -1;
                } else
                    $this->data['incomeAmount'] = sanitizeString($_POST['incomeAmount']);
                $this->data['incomeTax'] = sanitizeString($_POST['incomeTax']);
                $this->data['healthInsurance'] = sanitizeString($_POST['healthInsurance']);
                $this->data['socialInsurance'] = sanitizeString($_POST['socialInsurance']);
                if ($_POST['incomeType'] == "Student") {
                    $this->data['dateFrom'] = date('Y-m-d');
                    $this->data['dateTo'] = date('Y-m-d');
                } else {
                    $this->data['dateFrom'] = date('Y-m-d', strtotime(sanitizeString($_POST['dateFrom'])));
                    $this->data['dateTo'] = date('Y-m-d', strtotime(sanitizeString($_POST['dateTo'])));
                }
                $this->data['income_id'] = $id_income;
                $this->data['member_id'] = $id_member;
                try {
                    $control = $model->updateFamilyIncome($this->data);
                    if ($control > 0) {
                        $this->view->message = "Sukces";
                        $this->view->member = $id_member;
                        $this->view->data = $model->getFamilyIncome($id_member, $id_income);
                    } else
                        $this->view->message = "Błąd";
                } catch (Exception $e) {
                    $this->view->message = $e;
                }
            }
        }
    }

    function applicationWindow()
    {
        $this->setView("UserPanel", "Application");
        $this->loadModel("Application");
        $model = new ApplicationModel();
        $this->view->data = $model->getApplicationData();
        if (isset($_POST['submit']) && $_POST['submit'] == 'apply') {
            $dormAdd = false;
            if (isset($_POST['dormAddBox'])) {
                $dormAdd = true;
            }
            $control = $model->setApplication($dormAdd);
            if ($control > 1) {
                $this->view->alert = "Uwaga";
            } elseif ($control == 2) {
                $this->view->alert = "Sukces";
            } else {
                $this->view->alert = "Błąd";
            }
        }
    }

    function scholarshipWindow()
    {
        $this->setView("UserPanel", "Scholarship");
        $this->loadModel("Application");
        $model = new ApplicationModel();
        $this->view->scholarship = $model->getScholarshipData();
        $this->view->application = $model->getApplicationStatus();
    }

    function deleteApplication($id_app)
    {
        $this->setView("UserPanel", "Scholarship");
        $this->loadModel("Application");
        $model = new ApplicationModel();
        $control = $model->deleteApplication($id_app);
        if ($control > 0)
            $this->view->alert = "Sukces";
        else
            $this->view->alert = "Błąd";
    }

    function documentsList()
    {
        $this->setView("UserPanel", "DocumentsList");
        $this->loadModel("Application");
        $model = new ApplicationModel();
        $documents[] = '<b>' . 'Wnioskodawca' . '</b>';
        $documents[] = '<a href="' . URL . 'UserPanel/applicationDocument">Wniosek o stypendium</a>';
        $documents[] = "Załącznik C";
        if ($model->getDormAddStatus() == 1) {
            $documents[] = "Wniosek o zwiększenie stypendium o dodatek mieszkaniowy";
        }
        $result = $model->getStudentDocumentListData();
        foreach ($result as $row) {
            $documents[] = $this->documentType($row['income_source']);
        }
        $result = $model->getFamilyDocumentListData();
        foreach ($result as $row) {
            $documents[] = '<b>' . $row['name'] . ' ' . $row['surname'] . '</b>';
            $birth = new DateTime($row['date_of_birth']);
            $today = new DateTime('today');
            $age = $birth->diff($today)->y;
            if ($age >= 18) {
                $documents[] = "Załącznik C";
            }
            $documents[] = $this->documentType($row['income_source']);
        }
        $this->view->data = $documents;
    }

    function documentType($value)
    {
        switch ($value) {
            case "Emeryt": {
                return "Załącznik A<br>Oświadczenie o otrzymywaniu emerytury/renty<br>Zaświadczenie o składkach na ubezpieczenie zdrowotne";
                break;
            }
            case "Umowa o pracę": {
                return "Załącznik A<br>Zaświadczenie o składkach na ubezpieczenie zdrowotne lub PIT-11";
                break;
            }
            case "Umowa zlecenie": {
                return "Załącznik A<br>PIT-11";
                break;
            }
            case "Umowa o dzieło": {
                return "Załącznik A<br>PIT-11";
                break;
            }
            case "Student": {
                return "Zaświadczenie ze szkoły/uczelni";
                break;
            }
            case "Wiek przedszkolny": {
                return "Akt urodzenia";
                break;
            }
            case "Papiery wartościowe": {
                return "Załącznik A";
                break;
            }
            case "Działalność rolnicza": {
                return "Załącznik C<br>Zaświadczenie o ilości posiadanej ziemi<br>Zaświadczenie o składkach na ubezpieczenie zdrowotne";
                break;
            }
            case "Zasiłek": {
                return "Załącznik C";
                break;
            }
            case "Alimenty otrzymywane": {
                return "Załącznik C<br>Odpis wyroku nakazującego płacenie alimentów<br>Przekazy pieniężne";
                break;
            }
            case "Alimenty płacone": {
                return "Załącznik C<br>Odpis wyroku nakazującego płacenie alimentów<br>Przekazy pieniężne";
                break;
            }
            case "Diety": {
                return "Załącznik C";
                break;
            }
            case "Własna działalność": {
                return "Załącznik A<br>Zaświadczenie o składkach na ubezpieczenie zdrowotne";
                break;
            }
            case "Dzierżawa": {
                return "Umowa dzierżawy";
                break;
            }
        }
    }

    function applicationDocument()
    {
        define('FPDF_FONTPATH', 'font/');
        require_once('libs/fpdf.php');
        require_once('libs/fpdi/fpdi.php');
        $pdf = new FPDI();
        $pdf->SetTitle('Wniosek o stypendium', true);
        $pdf->AddFont('arialpl', '', 'arialpl.php');
        $pdf->SetFont('arialpl', '', 10);

        $pageCount = $pdf->setSourceFile('C:\xampp\htdocs\scholarship_system\resources\templates\Podanie.pdf'); //ustalenie pliku źródłowego
        $tplIdx = $pdf->importPage(1, '/MediaBox'); //pobranie 1. strony
        $pdf->addPage();
        $pdf->useTemplate($tplIdx);

        $this->loadModel("UserPanel");
        $model = new UserPanelModel();
        $result = $model->getProfile();
        foreach ($result as $row) {
            $text = $row;
        }

        $input = iconv('utf-8', 'iso-8859-2', 'Łódź, '.date('d-m-Y'));
        $pdf->text(150, 20, $input);

        $input = iconv('utf-8', 'iso-8859-2', $text['name'] . ' ' . $row['surname']);
        $pdf->text(50, 35, $input);

        $input = iconv('utf-8', 'iso-8859-2', (int )($text['semester'] / 2 + 1));
        $pdf->text(36, 40, $input);

        $input = iconv('utf-8', 'iso-8859-2', $text['semester']);
        $pdf->text(60, 40, $input);

        $input = iconv('utf-8', 'iso-8859-2', $text['system']);
        $pdf->text(90, 40, $input);

        $input = iconv('utf-8', 'iso-8859-2', $text['subject_name']);
        $pdf->text(50, 45, $input);

        $input = iconv('utf-8', 'iso-8859-2', $text['faculty_name']);
        $pdf->text(150, 49, $input);

        $input = iconv('utf-8', 'iso-8859-2', $_SESSION['st_index']);
        $pdf->text(50, 49, $input);

        $input = iconv('utf-8', 'iso-8859-2', $text['email'] . ', ' . $text['phone']);
        $pdf->text(38, 54, $input);

        $input = iconv('utf-8', 'iso-8859-2', date(Y)-1);
        $pdf->text(165, 100, $input);

        $input = iconv('utf-8', 'iso-8859-2', $_SESSION['name'] . ' ' . $_SESSION['surname']);
        $pdf->text(21, 105, $input);


        $tplIdx = $pdf->importPage(2, '/MediaBox');//pobranie 2. strony
        $pdf->addPage();
        $pdf->useTemplate($tplIdx);


        $pdf->Output('podanie.pdf', 'I'); //I-wyświetla w przeglądarce, D-wymusza pobranie*/
    }
}