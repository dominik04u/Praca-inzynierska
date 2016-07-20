<?php


class RegisterModel extends Model
{

    private $name, $surname, $email, $password, $index, $phone, $birth, $subject, $semester, $system, $degree;

    function __construct()
    {
        parent::__construct();
    }

    function setData($data)
    {
        require_once('libs/functions.php');
        $this->name = $data['name'];
        $this->surname = $data['surname'];
        $this->email = $data['email'];
        $this->password = hashing($data['password']);
        $this->index = $data['index'];
        $this->phone = $data['phone'];
        $this->birth = date('Y-m-d', strtotime($data['birth']));
        $this->subject = $data['subject'];
        $this->system = $data['system'];
        $this->degree = $data['degree'];
        $this->semester = $data['semester'];
    }


    function register()
    {
        $id_subject=0;
        $sth=$this->db->prepare('SELECT id_subject FROM subject WHERE name=?');
        $sth->execute(array($this->subject));
        foreach($sth as $row){
            $id_subject=$row['id_subject'];
        }
        if($this->phone!='') {
            $sth = $this->db->prepare('INSERT INTO student (name,surname,email,st_index,pass,tel_number,date_of_birth,id_subject,system,degree,semester)
                                    VALUES(?,?,?,?,?,?,?,?,?,?,?)');
            $control = $sth->execute(array($this->name, $this->surname, $this->email, $this->index, $this->password, $this->phone, $this->birth, $id_subject, $this->system, $this->degree, $this->semester));
        }
        else{
            $sth = $this->db->prepare('INSERT INTO student (name,surname,email,st_index,pass,date_of_birth,id_subject,system,degree,semester)
                                    VALUES(?,?,?,?,?,?,?,?,?,?)');
            $control = $sth->execute(array($this->name, $this->surname, $this->email, $this->index, $this->password, $this->birth,$id_subject,$this->system,$this->degree,$this->semester));
        }
        return $control;
    }



}

