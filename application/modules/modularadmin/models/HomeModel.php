<?php
/**
 * Created by PhpStorm.
 * User: jaidis
 * Date: 1/05/18
 * Time: 15:45
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Homemodel extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

}