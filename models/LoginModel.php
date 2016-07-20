<?php


class LoginModel extends Model
{

    function __construct()
    {
        parent::__construct();
        require_once('libs/functions.php');
    }

    function setData($data)
    {
        $this->index = $data['index'];
        $this->password = hashing($data['password']);
    }

    function login()
    {
        $sth = $this->db->prepare('SELECT * FROM student WHERE st_index=? AND pass=? LIMIT 1');
        $sth->execute(array($this->index, $this->password));
        foreach ($sth as $row) {
            $_SESSION['name'] = $row['name'];
            $_SESSION['surname'] = $row['surname'];
            $_SESSION['privilege'] = 'user';
            $_SESSION['st_index'] = $row['st_index'];
            $_SESSION['id_student'] = $row['id_student'];
        }
        return $sth->rowCount();
    }


    function setResetCode($index)
    {
        $sth = $this->db->prepare('SELECT * FROM student WHERE st_index=?');
        $sth->execute(array($index));
        $control = $sth->rowCount();
        if ($control > 0) {
            $key = '';
            $characters = array_merge(range('A', 'Z'), range('a', 'z'), range('0', '9'));
            $max = count($characters) - 1;
            for ($i = 0; $i < 16; $i++) {
                $rand = mt_rand(0, $max);
                $key .= $characters[$rand];
            }
            $stm = $this->db->prepare('UPDATE student SET reset_key=? WHERE st_index=?');
            $control = $stm->execute(array($key, $index));
            return $control;
        } else
            return -1;
    }

    function getResetCode($index)
    {
        $sth=$this->db->query('SELECT reset_key FROM student WHERE st_index=' . $index);
        foreach ($sth as $row) {
            $key=$row['reset_key'];
        }
        return $key;
    }

    function getEmail($index)
    {
        $sth=$this->db->query('SELECT email FROM student WHERE st_index=' . $index);
        foreach ($sth as $row) {
            $to=$row['reset_key'];
        }
        return $to;
    }

    function resetPass($index, $key){
        $sth=$this->db->prepare('SELECT * FROM student WHERE st_index=? AND reset_key=?');
        $sth->execute(array($index,$key));
        $control = $sth->rowCount();
        if($control>0){
            $pass = '';
            $characters = array_merge(range('A', 'Z'), range('a', 'z'), range('0', '9'));
            $max = count($characters) - 1;
            for ($i = 0; $i < 8; $i++) {
                $rand = mt_rand(0, $max);
                $pass .= $characters[$rand];
            }
            $hpass=hashing($pass);
            $sth=$this->db->prepare('UPDATE student SET pass=?, reset_key=NULL WHERE st_index=?');
            $control=$sth->execute(array($hpass,$index));
            if($control>0){
                return $pass;
            }
            else{
                return 0;
            }
        }else{
            return 0;
        }
    }
}

