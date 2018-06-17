<?php
/**
 * Created by PhpStorm.
 * User: jaidis
 * Date: 1/05/18
 * Time: 15:45
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Gastronomiasmodel extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function getAllProvinces(){
        return $this->db->get('provinces')->result();
    }

    public function getProvinceId($id_province){
        return $this->db->get_where('provinces', array('id'=>$id_province))->result();
    }

    public function getUserId($id_user){
        return $this->db->get_where('aauth_users', array('id'=>$id_user))->result();
    }

    public function getAllGastronomies(){
        return $this->db->get('gastronomies')->result();
    }

    public function getGastronomyId($id_gastronomy){
        return $this->db->get_where('gastronomies', array('id'=>$id_gastronomy))->result();
    }

    public function getGastronomiesComments($id_gastronomy){
        $this->db->join('aauth_users', 'aauth_users.id = gastronomies_comments.id_user', 'join');
        return $this->db->get_where('gastronomies_comments', array('id_gastronomies'=>$id_gastronomy))->result();
    }

    public function setNewGastronomy($array)
    {
        $this->db->insert('gastronomies', $array);
        return $this->db->insert_id();
    }

    public function setUpdateGastronomy($id, $array)
    {
        $this->db->where('id', $id);
        $this->db->update('gastronomies', $array);
    }

    public function setDeleteGastronomy($id_gastronomy)
    {
        return $this->db->delete('gastronomies', array(
            'id' => $id_gastronomy
        ));
    }

    public function setDeleteComment($id_comment)
    {
        return $this->db->delete('gastronomies_comments', array(
            'gc_id' => $id_comment
        ));
    }

    public function setNewLog($array){
        return $this->db->insert('logs',$array);
    }
}