<?php
/**
 * Created by PhpStorm.
 * User: jaidis
 * Date: 1/05/18
 * Time: 11:57
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class GastronomyModel extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
       $this->load->database();
    }

    public function getProvince($map_code){
        return $this->db->get_where('provinces', array('map_code'=> $map_code, 'active'=>1))->result();
    }

    public function getGastronomy($id_gastronomy){
        return $this->db->get_where('gastronomies', array('id'=>$id_gastronomy))->result();
    }

    public function getAllGastronomies()
    {
        return $this->db->get('gastronomies')->result();
    }

    public function getAllGastronomiesProvince($id_province)
    {
        return $this->db->get_where('gastronomies',array('id_province'=>$id_province))->result();
    }

    public function getGastronomiesPerPage($newsPerPage=10, $page){
        $totalNews = $this->db->get('gastronomies')->num_rows();
        $this->db->order_by('date_creation','desc');
        $query = $this->db->get('gastronomies',$newsPerPage,$page)->result();
        if($totalNews>0)
            return $query;
    }

    public function getGastronomiesProvincePerPage($id_province, $newsPerPage=10, $page){
        $totalNews = $this->db->get('gastronomies')->num_rows();
        $this->db->order_by('date_creation','desc');
        $query = $this->db->get_where('gastronomies',array('id_province'=>$id_province),$newsPerPage,$page)->result();
        if($totalNews>0)
            return $query;
    }

    public function getCommentsGastronomies($id_gastronomy){
        $this->db->join('aauth_users', 'aauth_users.id = gastronomies_comments.id_user', 'inner');
        return $this->db->get_where('gastronomies_comments', array('id_gastronomies'=>$id_gastronomy))->result();
    }

    public function setNewComment($array){
        $this->db->insert('gastronomies_comments',$array);
        return $this->db->insert_id();
    }

    public function setNewLog($array){
        return $this->db->insert('logs',$array);
    }
}
