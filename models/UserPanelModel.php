<?php


class UserPanelModel extends Model
{

    function __construct()
    {
        parent::__construct();
    }

    function getMessage()
    {
        $sth = $this->db->query('SELECT * FROM message WHERE st_index=' . $_SESSION['st_index'] . ' ORDER BY send_date DESC');
        return $sth;
    }

    function getProfile()
    {
        $sth = $this->db->query('SELECT s.name,s.surname,s.email,s.tel_number as phone, s.date_of_birth as birth,s.degree,s.semester,s.system, sb.name as subject_name,f.name as faculty_name,
                                a.place, a.street,a.house_number,a.flat_number,a.zip_code,a.post_office
                                FROM student as s INNER JOIN
                                subject as sb on s.id_subject=sb.id_subject INNER JOIN
                                faculty as f ON sb.id_faculty=f.id_faculty INNER JOIN
                                address as a on s.id_student=a.id_student
                                WHERE st_index=' . $_SESSION['st_index']);
        return $sth;
    }

    function getProfileData()
    {
        $sth = $this->db->query('SELECT s.name,s.surname,s.email,s.tel_number as phone,s.date_of_birth as birth,s.degree,s.semester,s.system, sb.name as subject_name,f.name as faculty_name
                                FROM student as s INNER JOIN
                                subject as sb on s.id_subject=sb.id_subject INNER JOIN
                                faculty as f ON sb.id_faculty=f.id_faculty
                                WHERE st_index=' . $_SESSION['st_index']);
        return $sth;
    }

    function updateProfileData($data)
    {
        $id_subject = 0;
        $sth = $this->db->prepare('SELECT id_subject FROM subject WHERE name=?');
        $sth->execute(array($data['subject']));
        foreach ($sth as $row) {
            $id_subject = $row['id_subject'];
        }
        if (isset($data['phone'])) {
            $sth = $this->db->prepare('UPDATE student SET name=?, surname=?, email=?, tel_number=?, date_of_birth=?, id_subject=?, system=?, degree=?, semester=? WHERE id_student=?');
            $control = $sth->execute(array($data['name'], $data['surname'], $data['email'], $data['phone'], $data['birth'], $id_subject, $data['system'], $data['degree'], $data['semester'], $_SESSION['id_student']));
            return $control;
        } else {
            $sth = $this->db->prepare('UPDATE student SET name=?, surname=?, email=?, date_of_birth=?, id_subject=?, system=?, degree=?, semester=? WHERE id_student=?');
            $control = $sth->execute(array($data['name'], $data['surname'], $data['email'], $data['birth'], $id_subject, $data['system'], $data['degree'], $data['semester'], $_SESSION['id_student']));
            return $control;
        }
    }

    function issetAddress()
    {
        $sth = $this->db->query('SELECT * FROM address WHERE id_student=(SELECT id_student FROM student WHERE st_index=' . $_SESSION['st_index'] . ')');
        return $sth->rowCount();
    }

    function setAddress($data)
    {
        $sth = $this->db->prepare('INSERT INTO address (id_student,place,street,house_number,flat_number,zip_code,post_office)
                                  VALUES (?,?,?,?,?,?,?)');
        $control = $sth->execute(array($_SESSION['id_student'], $data['place'], $data['street'], $data['house_number'], $data['flat_number'], $data['zip_code'], $data['post_office']));
        return $control;
    }

    function getAddress()
    {
        return $sth = $this->db->query('SELECT * FROM address WHERE id_student=(SELECT id_student FROM student WHERE st_index=' . $_SESSION['st_index'] . ')');
    }

    function updateAddress($data)
    {
        $sth = $this->db->prepare('UPDATE address SET place=?, street=?, house_number=?, flat_number=?, zip_code=?, post_office=? WHERE id_student=?');
        $control = $sth->execute(array($data['place'], $data['street'], $data['house_number'], $data['flat_number'], $data['zip_code'], $data['post_office'], $_SESSION['id_student']));
        return $control;
    }

    function getPassword()
    {
        $sth = $this->db->query('SELECT pass FROM student WHERE st_index=' . $_SESSION['st_index']);
        foreach ($sth as $row) {
            $pass = $row['pass'];
        }
        return $pass;
    }

    function changePassword($data)
    {
        $sth = $this->db->prepare('UPDATE student SET pass=? WHERE st_index=?');
        $control = $sth->execute(array($data, $_SESSION['st_index']));
        return $control;
    }


}

