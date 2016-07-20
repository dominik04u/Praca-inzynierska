<?php


class ApplicationModel extends Model
{

    function __construct()
    {
        parent::__construct();
    }

    function addFamilyMember($data)
    {
        if ($data['relationship'] == "Matka" || $data['relationship'] == "Ojciec" || $data['relationship'] == "Współmałżonek") {
            $sth = $this->db->prepare('SELECT * FROM family WHERE id_student=? AND relationship=?');
            $sth->execute(array($_SESSION['id_student'], $data['relationship']));
            $control = $sth->rowCount();
            if ($control > 0)
                return -1;
            else {
                $sth = $this->db->prepare('INSERT INTO family (id_student,name, surname, relationship, date_of_birth,income) VALUES (?,?,?,?,?,?)');
                $control = $sth->execute(array($_SESSION['id_student'], $data['name'], $data['surname'], $data['relationship'], $data['birth'], 0));
                return $control;
            }
        }
        $sth = $this->db->prepare('INSERT INTO family (id_student,name, surname, relationship, date_of_birth,income) VALUES (?,?,?,?,?,?)');
        $control = $sth->execute(array($_SESSION['id_student'], $data['name'], $data['surname'], $data['relationship'], $data['birth'], 0));
        return $control;
    }

    function getFamily()
    {
        return $sth = $this->db->query('SELECT * from family WHERE id_student=' . $_SESSION['id_student']);
    }

    function getFamilyMember($id)
    {
        return $sth = $this->db->query('SELECT name,surname,relationship,date_of_birth FROM family WHERE id_member=' . $id . ' AND id_student=' . $_SESSION['id_student']);
    }

    function deleteFamilyMember($data)
    {
        $sth = $this->db->prepare('DELETE FROM family WHERE id_member=? AND id_student=?');
        $control = $sth->execute(array($data, $_SESSION['id_student']));
        return $control;
    }

    function editFamilyMember($data)
    {
        if ($data['relationship'] == "Matka" || $data['relationship'] == "Ojciec" || $data['relationship'] == "Współmałżonek") {
            $sth = $this->db->prepare('SELECT * FROM family WHERE id_student=? AND relationship=?');
            $sth->execute(array($_SESSION['id_student'], $data['relationship']));
            $control = $sth->rowCount();
            if ($control > 0) {
                $sth = $this->db->prepare('SELECT * FROM family WHERE id_student=? AND relationship=? AND id_member=?');
                $sth->execute(array($_SESSION['id_student'], $data['relationship'], $data['id_member']));
                $control = $sth->rowCount();
                if ($control > 0) {
                    $sth = $this->db->prepare('UPDATE family SET name=?, surname=?, relationship=?, date_of_birth=? WHERE id_member=? AND id_student=?');
                    $control = $sth->execute(array($data['name'], $data['surname'], $data['relationship'], $data['birth'], $data['id_member'], $_SESSION['id_student']));
                    return $control;
                } else {
                    return -1;
                }
            } else {
                $sth = $this->db->prepare('UPDATE family SET name=?, surname=?, relationship=?, date_of_birth=? WHERE id_member=? AND id_student=?');
                $control = $sth->execute(array($data['name'], $data['surname'], $data['relationship'], $data['birth'], $data['id_member'], $_SESSION['id_student']));
                return $control;
            }
        }
        $sth = $this->db->prepare('UPDATE family SET name=?, surname=?, relationship=?, date_of_birth=? WHERE id_member=? AND id_student=?');
        $control = $sth->execute(array($data['name'], $data['surname'], $data['relationship'], $data['birth'], $data['id_member'], $_SESSION['id_student']));
        return $control;
    }

    function getStudentIncomes()
    {
        return $sth = $this->db->query('SELECT * FROM student_income WHERE id_student=' . $_SESSION['id_student']);
    }

    function getStudentIncome($id)
    {
        return $sth = $this->db->query('SELECT * FROM student_income WHERE id_income=' . $id . ' AND id_student=' . $_SESSION['id_student']);
    }

    function deleteStudentIncome($id)
    {
        $sth = $this->db->prepare('DELETE FROM student_income WHERE id_income=? AND id_student=?');
        $control = $sth->execute(array($id, $_SESSION['id_student']));
        return $control;
    }

    function addStudentIncome($data)
    {
        $sth = $this->db->prepare('INSERT INTO student_income (id_student,income_source, income_name, income_amount, income_from, income_to) VALUES (?,?,?,?,?,?)');
        $amount = $data['incomeAmount'] - $data['incomeTax'] - $data['healthInsurance'] - $data['socialInsurance'];
        $control = $sth->execute(array($_SESSION['id_student'], $data['incomeType'], $data['incomeName'], $amount, $data['dateFrom'], $data['dateTo']));
        return $control;
    }

    function updateStudentIncome($data)
    {
        $sth = $this->db->prepare('UPDATE student_income SET income_source=?, income_name=?, income_amount=?, income_from=?, income_to=? WHERE id_income=? AND id_student=?');
        $amount = $data['incomeAmount'] - $data['incomeTax'] - $data['healthInsurance'] - $data['socialInsurance'];
        $control = $sth->execute(array($data['incomeType'], $data['incomeName'], $amount, $data['dateFrom'], $data['dateTo'], $data['income_id'], $_SESSION['id_student']));
        return $control;
    }

    function getFamilyIncomes($id)
    {
        return $sth = $this->db->query('SELECT * FROM family_income as fi INNER JOIN family as f on f.id_member=fi.id_member WHERE fi.id_member=' . $id . ' AND f.id_student=' . $_SESSION['id_student']);
    }

    function deleteFamilyIncome($id)
    {
        $sth = $this->db->query('SELECT * FROM student WHERE id_student=(
                                SELECT id_student FROM family WHERE id_member=(
                                SELECT id_member FROM family_income WHERE id_income=' . $id . '))');
        $control = $sth->rowCount();
        if ($control > 0) {
            $sth = $this->db->prepare('DELETE FROM family_income WHERE id_income=?');
            $control = $sth->execute(array($id));
            return $control;
        } else
            return -1;
    }

    function addFamilyIncome($data)
    {
        $sth = $this->db->prepare('INSERT INTO family_income (id_member,income_source, income_name, income_amount, income_from, income_to) VALUES (?,?,?,?,?,?)');
        $amount = $data['incomeAmount'] - $data['incomeTax'] - $data['healthInsurance'] - $data['socialInsurance'];
        $control = $sth->execute(array($data['idMember'], $data['incomeType'], $data['incomeName'], $amount, $data['dateFrom'], $data['dateTo']));
        return $control;
    }

    function getFamilyIncome($id_member, $id_income)
    {
        $sth = $this->db->query('SELECT * FROM student WHERE id_student=(
                                SELECT id_student FROM family WHERE id_member=' . $id_member . ' AND id_member=(
                                SELECT id_member FROM family_income WHERE id_income=' . $id_income . '))');
        $control = $sth->rowCount();
        if ($control > 0) {
            return $sth = $this->db->query('SELECT * FROM family_income WHERE id_income=' . $id_income . ' AND id_member=' . $id_member);
        } else
            return -1;
    }

    function updateFamilyIncome($data)
    {
        $sth = $this->db->prepare('UPDATE family_income SET income_source=?, income_name=?, income_amount=?, income_from=?, income_to=? WHERE id_income=? AND id_member=?');
        $amount = $data['incomeAmount'] - $data['incomeTax'] - $data['healthInsurance'] - $data['socialInsurance'];
        $control = $sth->execute(array($data['incomeType'], $data['incomeName'], $amount, $data['dateFrom'], $data['dateTo'], $data['income_id'], $data['member_id']));
        return $control;
    }

    function getApplicationData()
    {
        return $this->db->query('SELECT income_per_person, family_mem_numbers, scholarship_threshold, dorm_add_amount FROM student, const_data WHERE st_index=' . $_SESSION['st_index']);
    }

    function setApplication($dorm)
    {
        $result = $this->db->query('SELECT income_per_person, scholarship_threshold FROM student, const_data WHERE st_index=' . $_SESSION['st_index']);
        $income_per_person = $scholarship_threshold = $dorm_add_amount = 0;
        foreach ($result as $row) {
            $income_per_person = $row['income_per_person'];
            $scholarship_threshold = $row['scholarship_threshold'];
        }
        $scholarship = floor($scholarship_threshold - $income_per_person);
        if ($scholarship < 50) {
            $scholarship = 50;
        }
        $sth = $this->db->query('SELECT * FROM application WHERE ap_status="Wysłano" AND id_student=' . $_SESSION['id_student']);
        $control = $sth->rowCount();
        if ($control > 0) {
            $id_app = 0;
            foreach ($sth as $row) {
                $id_app = $row['id_application'];
            }
            $sth = $this->db->prepare('UPDATE application SET ap_status=?,scholarship=?,dorm_add=?,app_date=? WHERE id_application=?');
            if ($dorm)
                $control = $sth->execute(array('Wysłano', $scholarship, 1, date('Y-m-d H:i:s'), $id_app));
            else
                $control = $sth->execute(array('Wysłano', $scholarship, 0, date('Y-m-d H:i:s'), $id_app));
            return $control;
        } else {
            $sth = $this->db->query('SELECT * FROM application WHERE ap_status<>"Wysłano" AND id_student=' . $_SESSION['id_student']);
            $control = $sth->rowCount();
            if ($control > 0) {
                $id_app = 0;
                foreach ($sth as $row) {
                    $id_app = $row['id_application'];
                }
                $sth = $this->db->prepare('UPDATE application SET ap_status=?, scholarship=?,dorm_add=?,app_date=? WHERE id_application=?');
                if ($dorm)
                    $control = $sth->execute(array('Do uzupełnienia',$scholarship, 1, date('Y-m-d H:i:s'), $id_app));
                else
                    $control = $sth->execute(array('Do uzupełnienia',$scholarship, 0, date('Y-m-d H:i:s'), $id_app));
                if($control>0){
                    return 2;
                }
                else{
                    return 0;
                }
            }
            $sth = $this->db->prepare('INSERT INTO application (id_student,ap_status,scholarship,dorm_add) VALUES ((SELECT id_student FROM student WHERE st_index=?),?,?,?)');
            if ($dorm)
                $control = $sth->execute(array($_SESSION['st_index'], 'Wysłano', $scholarship, 1));
            else
                $control = $sth->execute(array($_SESSION['st_index'], 'Wysłano', $scholarship, 0));
            return $control;
        }
    }

    function getApplicationStatus()
    {
        return $this->db->query('SELECT * FROM application WHERE id_student=' . $_SESSION['id_student'] . ' AND date(app_date) > (SELECT tax_year FROM const_data) ORDER BY ap_status="Wysłano", app_date DESC LIMIT 1 ');
    }

    function getScholarshipData()
    {
        return $this->db->query('SELECT amount, addition, date_from, date_to FROM scholarship WHERE id_student=' . $_SESSION['id_student']);
    }

    function deleteApplication($id_app)
    {
        $sth = $this->db->prepare('DELETE FROM application WHERE id_application=? AND id_student=?');
        $control = $sth->execute(array($id_app, $_SESSION['id_student']));
        return $control;
    }

    function getFamilyDocumentListData(){
        return $this->db->query('SELECT f.*,fi.* FROM family as f INNER JOIN family_income as fi on f.id_member=fi.id_member WHERE f.id_student='.$_SESSION['id_student']);
    }

    function getStudentDocumentListData(){
        return $this->db->query('SELECT * FROM student_income WHERE id_student='.$_SESSION['id_student']);
    }

    function getDormAddStatus(){
        $sth=$this->db->query('SELECT dorm_add FROM application WHERE id_student='.$_SESSION['id_student']);
        foreach($sth as $row){
            return $row['dorm_add'];
        }
    }
}

