<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Portal extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('PortalModel','portal');
    }

    /**
     * Init the main view at the website
     */
    public function index()
    {
        $data = array();
        $data['news'] = $this->portal->getNewsPortal();
        $data['carousel'] = $this->portal->getCarousel();
        $data['activo'] = "";
        $this->load->view('header.php', $data);
        $this->load->view('index.php', $data);
        $this->load->view('footer.php', $data);
    }

    /**
     * Call the view for render the map at Spain
     */
    public function provinces(){
        $data = array();
        $data['activo'] = "provincias";
        $this->load->view('header.php', $data);
        $this->load->view('provinces.php', $data);
        $this->load->view('footer.php', $data);
    }

}
