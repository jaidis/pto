<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Portal extends CI_Controller
{

    /**
     * Portal constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('PortalModel', 'portal');
        $this->load->library("Aauth");
    }

    /**
     * Init the main view at the website
     */
    public function index()
    {
        $data = array();
        if ( $this->aauth->is_loggedin() ){
            $data['user'] = $this->aauth->get_user($this->aauth->get_user_id($email=false));
        }

        $data['news'] = $this->portal->getNewsPortal();
        $data['carousel'] = $this->portal->getCarousel();
        $data['activo'] = "";
        $this->load->view('header', $data);
        $this->load->view('portal/index', $data);
        $this->load->view('footer', $data);
    }

    /**
     * Call the view for render the map at Spain
     */
    public function provinces()
    {
        $data = array();
        $data['activo'] = "provincias";
        $data['js_to_load'] = 'portal/provinces.js';
        $this->load->view('header', $data);
        $this->load->view('portal/provinces', $data);
        $this->load->view('footer', $data);
    }

    /**
     * Call the view for render the data from a province
     */
    public function province($map_code = null)
    {
        $data = array();

        //Select province with $map_code
        $data['province'] = $this->portal->getProvince($map_code);
        if (count($data['province']) > 0) {
            $data['province'] = $data['province'][0];
            $data['news'] = $this->portal->getNewsPortalProvince($data['province']->id);
            $data['monuments'] = $this->portal->getMonumentsProvince($data['province']->id);
            $data['gastronomies'] = $this->portal->getGastronomiesProvince($data['province']->id);
            $data['galleries'] = $this->portal->getProvinceImages($data['province']->id);

            //Generate view for the province template
            $data['activo'] = "provincias";
            $data['css_to_load'] = 'portal/province.css';
            $data['js_to_load'] = 'portal/province.js';

            $this->load->view('header', $data);
            $this->load->view('portal/province', $data);
            $this->load->view('footer', $data);
        } else {
            $protocol = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "https" : "http");
            $base_url = $protocol . "://" . $_SERVER['HTTP_HOST'];
            $complete_url =   $base_url . $_SERVER["REQUEST_URI"];
            redirect($base_url.'/provincias');
        }

    }

}
