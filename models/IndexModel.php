<?php


class IndexModel extends Model
{

    function __construct()
    {
        parent::__construct();
    }

    function getNews(){
        $sth=$this->db->query('SELECT id_news,title,news_text,create_date FROM news ORDER BY create_date DESC');
        return $sth;
    }
}

