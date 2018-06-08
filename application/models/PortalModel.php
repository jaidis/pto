<?php
/**
 * Created by PhpStorm.
 * User: jaidis
 * Date: 1/05/18
 * Time: 11:57
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class PortalModel extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
       $this->load->database();
    }

    public function getNews($id_news){
        return $this->db->get_where('news', array('id'=>$id_news))->result();
    }

    public function getCommentsNews($id_news){
        $this->db->join('aauth_users', 'aauth_users.id = news_comments.id_user', 'inner');
        return $this->db->get_where('news_comments', array('id_news'=>$id_news))->result();
    }

    public function getNewsPortal(){
        $this->db->order_by('date_creation','desc');
        return $this->db->get('news', 5)->result();
    }

    public function getNewsPortalNews(){
        $this->db->order_by('date_creation','desc');
        return $this->db->get('news', 5)->result();
    }

    public function getNewsPortalProvince($id_province){
        $this->db->order_by('date_creation','desc');
        return $this->db->get_where('news', array('id_province'=>$id_province), 3)->result();
    }

    public function getMonumentsProvince($id_province){
        return $this->db->get_where('monuments', array('id_province'=>$id_province), 6)->result();
    }

    public function getGastronomiesProvince($id_province){
        return $this->db->get_where('gastronomies', array('id_province'=>$id_province), 6)->result();
    }

    public function getProvinceImages($id_province){
        return $this->db->get_where('provinces_images', array('id_province'=> $id_province, 'active'=>1))->result();
    }

    public function getCarousel(){
        $this->db->order_by('position','asc');
        return $this->db->get_where('carousel', array('active'=>1))->result();
    }

    public function getProvince($map_code){
        return $this->db->get_where('provinces', array('map_code'=> $map_code, 'active'=>1))->result();
    }

    public function setNewComment($array){
        $this->db->insert('news_comments',$array);
        return $this->db->insert_id();
    }

    public function setNewContact($array){
        $this->db->insert('contact',$array);
        return $this->db->insert_id();
    }

    public function setNewLog($array){
        return $this->db->insert('logs',$array);
    }
}
