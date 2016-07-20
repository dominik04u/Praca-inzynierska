<?php


class Model
{

    function __construct()
    {
        $this->db = new Database();
        /* if (mysqli_connect_errno()>0) {
             $view = 'views/DatabaseConnectionError.php';
             require_once($view);
         }
         else
             echo "1 ";*/
    }

    /* public function Select($select = "*", $from = null, $where = null, $orderBy = null, $limit = null)
     {
         $query = "SELECT " . $select;
         if ($from != null)
             $query .= " FROM " . $from;
         if ($where != null)
             $query .= " WHERE " . $where;
         if ($orderBy != null)
             $query .= " ORDER BY " . $orderBy;
         if ($limit != null)
             $query .= " LIMIT " . $limit;


         $result = $this->db->query($query);
         return $result;
     }*/

}