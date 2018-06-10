<?php
/**
 * Created by PhpStorm.
 * User: jaidis
 * Date: 1/05/18
 * Time: 11:57
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class NewsModel extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
       $this->load->database();
    }

    public function getProvince($map_code){
        return $this->db->get_where('provinces', array('map_code'=> $map_code, 'active'=>1))->result();
    }

    public function getNews($id_news){
        return $this->db->get_where('news', array('id'=>$id_news))->result();
    }

    public function getAllNews()
    {
        return $this->db->get('news')->result();
    }

    public function getAllNewsProvince($id_province)
    {
        return $this->db->get_where('news',array('id_province'=>$id_province))->result();
    }

    public function getNewsPerPage($newsPerPage=10, $page){
        $totalNews = $this->db->get('news')->num_rows();
        $this->db->order_by('date_creation','desc');
        $query = $this->db->get('news',$newsPerPage,$page)->result();
        if($totalNews>0)
            return $query;
    }

    public function getNewsProvincePerPage($id_province, $newsPerPage=10, $page){
        $totalNews = $this->db->get('news')->num_rows();
        $this->db->order_by('date_creation','desc');
        $query = $this->db->get_where('news',array('id_province'=>$id_province),$newsPerPage,$page)->result();
        if($totalNews>0)
            return $query;
    }

    public function getCommentsNews($id_news){
        $this->db->join('aauth_users', 'aauth_users.id = news_comments.id_user', 'inner');
        return $this->db->get_where('news_comments', array('id_news'=>$id_news))->result();
    }

    public function setNewComment($array){
        $this->db->insert('news_comments',$array);
        return $this->db->insert_id();
    }

    public function setNewLog($array){
        return $this->db->insert('logs',$array);
    }
}
