<?php


class AdminLoginModel extends Model
{

    function __construct()
    {
        parent::__construct();
        require_once ('libs/functions.php');
    }

    function setData($data){
        $this->login=$data['login'];
        $this->password=hashing($data['password']);
    }

    function login(){
        $sth=$this->db->prepare('SELECT * FROM administration WHERE login=? AND pass=? LIMIT 1');
        $sth->execute(array($this->login,$this->password));
        foreach($sth as $row){
            $_SESSION['name']=$row['name'];
            $_SESSION['surname']=$row['surname'];
            $_SESSION['privilege']='admin';
            $_SESSION['id_admin']=$row['id_admin'];
        }
        return $sth->rowCount();
    }

}
