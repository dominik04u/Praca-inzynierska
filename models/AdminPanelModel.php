<?php


class AdminPanelModel extends Model
{

    function __construct()
    {
        parent::__construct();
    }

    function sendMessage($data)
    {
        $sth = $this->db->prepare('INSERT INTO message (id_admin,st_index,msg_text) VALUES (?,?,?)');
        $control = $sth->execute(array($data['from'], $data['index'], $data['text']));
        return $control;
    }

    function postNews($data)
    {
        $sth = $this->db->prepare('INSERT INTO news (title,news_text) VALUES (?,?)');
        $control = $sth->execute(array($data['title'], $data['news_text']));
        return $control;
    }

    function deleteNews($data)
    {
        $sth = $this->db->prepare('DELETE FROM news WHERE id_news=?');
        $control = $sth->execute(array($data));
        return $control;
    }

    function getNews($data)
    {
        return $sth = $this->db->query('SELECT title,news_text FROM news WHERE id_news=' . $data);
    }

    function updateNews($data)
    {
        $sth = $this->db->prepare('UPDATE news SET title=?, news_text=? WHERE id_news=?');
        $control = $sth->execute(array($data['title'], $data['news_text'], $data['id_news']));
        return $control;
    }

    function getStudents($query)
    {
        return $this->db->query('SELECT st.name, st.surname, st.st_index, st.date_of_birth AS birth FROM student AS st ' . $query);
    }

    function getStudentProfile($index)
    {
        return $this->db->query('SELECT s.name,s.surname,s.date_of_birth as birth,s.st_index,s.degree,s.semester,s.system, sb.name as subject_name,f.name as faculty_name,
                                a.place, a.street,a.house_number,a.flat_number,a.zip_code,a.post_office
                                FROM student as s INNER JOIN
                                subject as sb on s.id_subject=sb.id_subject INNER JOIN
                                faculty as f ON sb.id_faculty=f.id_faculty INNER JOIN
                                address as a on s.id_student=a.id_student
                                WHERE st_index=' . $index);
    }

    function getApplicationData($index)
    {
        return $this->db->query('SELECT dorm_add_amount,a.*, s.name,s.surname, s.st_index FROM const_data,application AS a INNER JOIN student AS s ON a.id_student=s.id_student WHERE s.id_student=(SELECT id_student FROM student WHERE st_index=' . $index . ')');
    }

    function applicationExists($index)
    {
        $sth = $this->db->query('SELECT * FROM student WHERE st_index=' . $index);
        $control = $sth->rowCount();
        if ($control > 0) {
            $sth = $this->db->query('SELECT dorm_add_amount,a.*, s.name,s.surname, s.st_index FROM const_data,application AS a INNER JOIN student AS s ON a.id_student=s.id_student WHERE s.id_student=(SELECT id_student FROM student WHERE st_index=' . $index . ')');
            $control = $sth->rowCount();
            return $control;
        } else
            return -1;
    }

    function getApplicationList()
    {
        return $this->db->query('SELECT a.*, s.name, s.surname, s.st_index FROM application AS a INNER JOIN student AS s ON a.id_student=s.id_student WHERE ap_status<>"Przyznano" AND ap_status<>"Nie przyznano" ORDER BY app_date DESC');
    }

    function changeAppStatus($data)
    {
        if ($data['status'] != "Przyjêto") {
            $sth = $this->db->prepare('UPDATE application SET ap_status=?, accept_date=? WHERE id_student=(SELECT id_student FROM student WHERE st_index=?)');
            $control = $sth->execute(array($data['status'], date('Y-m-d H:i:s'), $data['index']));
            return $control;
        } else {
            $sth = $this->db->prepare('UPDATE application SET ap_status=? WHERE id_student=(SELECT id_student FROM student WHERE st_index=?)');
            $control = $sth->execute(array($data['status'], $data['index']));
            return $control;
        }
    }


    function setDecision($data)
    {
        $sthInsert = $this->db->prepare('INSERT INTO scholarship (id_student, amount, addition, date_from, date_to) VALUES ((SELECT id_student FROM student WHERE st_index=?),?,((SELECT dorm_add_amount FROM const_data)*?),?,?)');
        $controlInsert = $sthInsert->execute(array($data['index'], $data['scholarship'], $data['dormAdd'], $data['dateFrom'], $data['dateTo']));
        $sthUpdate = $this->db->prepare('UPDATE application SET ap_status=?, consider_date=? WHERE id_student=(SELECT id_student FROM student WHERE st_index=?)');
        $controlUpdate = $sthUpdate->execute(array($data['status'], date('Y-m-d H:i:s'), $data['index']));
        if ($controlInsert == 1 && $controlUpdate == 1)
            return 1;
        else
            return 0;
    }
}

