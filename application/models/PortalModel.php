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

    public function getNewsPortal(){
        $this->db->order_by('date_creation','desc');
        return $this->db->get('news', 5)->result();
    }

    public function getCarousel(){
        $this->db->order_by('position','asc');
        return $this->db->get_where('carousel', array('active'=>1))->result();
    }
}
