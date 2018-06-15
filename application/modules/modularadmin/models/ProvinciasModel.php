<?php
/**
 * Created by PhpStorm.
 * User: jaidis
 * Date: 1/05/18
 * Time: 15:45
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Provinciasmodel extends CI_Model
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

    public function getProvinceMapCode($map_code){
        return $this->db->get_where('provinces', array('map_code'=>$map_code))->result();
    }

    public function setNewProvince($array)
    {
        $this->db->insert('provinces', $array);
        return $this->db->insert_id();
    }

    public function setUpdateProvince($id, $array)
    {
        $this->db->where('id', $id);
        $this->db->update('provinces', $array);
    }

    public function setDeleteProvince($id_province)
    {
        return $this->db->delete('provinces', array(
            'id' => $id_province
        ));
    }

    public function setNewLog($array){
        return $this->db->insert('logs',$array);
    }
}