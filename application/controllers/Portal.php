<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Portal extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data = array();
        $this->load->view('header.php', $data);
        $this->load->view('index.php', $data);
        $this->load->view('footer.php', $data);
    }

}
