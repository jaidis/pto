<?php
/**
 * Created by PhpStorm.
 * User: jaidis
 * Date: 1/05/18
 * Time: 15:45
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Monumentosmodel extends CI_Model
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

    public function getAllMonuments(){
        return $this->db->get('monuments')->result();
    }

    public function getMonumentId($id_monument){
        return $this->db->get_where('monuments', array('id'=>$id_monument))->result();
    }

    public function setNewMonument($array)
    {
        $this->db->insert('monuments', $array);
        return $this->db->insert_id();
    }

    public function setUpdateMonument($id, $array)
    {
        $this->db->where('id', $id);
        $this->db->update('monuments', $array);
    }

    public function setDeleteMonument($id_monument)
    {
        return $this->db->delete('monuments', array(
            'id' => $id_monument
        ));
    }

    public function setNewLog($array){
        return $this->db->insert('logs',$array);
    }
}