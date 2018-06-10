<?php
/**
 * Created by PhpStorm.
 * User: jaidis
 * Date: 1/05/18
 * Time: 11:57
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class MonumentsModel extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
       $this->load->database();
    }

    public function getProvince($map_code){
        return $this->db->get_where('provinces', array('map_code'=> $map_code, 'active'=>1))->result();
    }

    public function getMonument($id_monuments){
        return $this->db->get_where('monuments', array('id'=>$id_monuments))->result();
    }

    public function getAllMonuments()
    {
        return $this->db->get('monuments')->result();
    }

    public function getAllMonumentsProvince($id_province)
    {
        return $this->db->get_where('monuments',array('id_province'=>$id_province))->result();
    }

    public function getMonumentsPerPage($commentsPerPage=10, $page){
        $totalNews = $this->db->get('gastronomies')->num_rows();
        $this->db->order_by('date_creation','desc');
        $query = $this->db->get('monuments',$commentsPerPage,$page)->result();
        if($totalNews>0)
            return $query;
    }

    public function getMonumentsProvincePerPage($id_province, $commentsPerPage=10, $page){
        $totalMonuments = $this->db->get('monuments')->num_rows();
        $this->db->order_by('date_creation','desc');
        $query = $this->db->get_where('monuments',array('id_province'=>$id_province),$commentsPerPage,$page)->result();
        if($totalMonuments>0)
            return $query;
    }

    public function getCommentsMonuments($id_monuments){
        $this->db->join('aauth_users', 'aauth_users.id = monuments_comments.id_user', 'inner');
        return $this->db->get_where('monuments_comments', array('id_monuments'=>$id_monuments))->result();
    }

    public function setNewComment($array){
        $this->db->insert('monuments_comments',$array);
        return $this->db->insert_id();
    }

    public function setNewLog($array){
        return $this->db->insert('logs',$array);
    }
}
