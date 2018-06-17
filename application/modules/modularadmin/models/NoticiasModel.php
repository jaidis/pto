<?php
/**
 * Created by PhpStorm.
 * User: jaidis
 * Date: 1/05/18
 * Time: 15:45
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Noticiasmodel extends CI_Model
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

    public function getAllNews(){
        return $this->db->get('news')->result();
    }

    public function getNewsId($id_news){
        return $this->db->get_where('news', array('id'=>$id_news))->result();
    }

    public function getNewsComments($id_news){
        $this->db->join('aauth_users', 'aauth_users.id = news_comments.id_user', 'join');
        return $this->db->get_where('news_comments', array('id_news'=>$id_news))->result();
    }

    public function setNewNews($array)
    {
        $this->db->insert('news', $array);
        return $this->db->insert_id();
    }

    public function setUpdateNews($id, $array)
    {
        $this->db->where('id', $id);
        $this->db->update('news', $array);
    }

    public function setDeleteNews($id_news)
    {
        return $this->db->delete('news', array(
            'id' => $id_news
        ));
    }

    public function setDeleteComment($id_comment)
    {
        return $this->db->delete('news_comments', array(
            'nc_id' => $id_comment
        ));
    }

    public function setNewLog($array){
        return $this->db->insert('logs',$array);
    }
}