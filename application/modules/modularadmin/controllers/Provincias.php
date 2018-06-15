<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Provincias extends MX_Controller {


    /*******************************************************************
     * Home constructor
     ******************************************************************/
    public function __construct()
    {
        parent::__construct();
        $this->load->model('ProvinciasModel','provincias');
        $this->load->library("Aauth");
        $this->load->library("Utils");
        $this->load->helper('url');
    }

    /*******************************************************************
     * PÁGINA DE INICIO PARA EL HOME
     * $route['pto-admin'] = 'modularadmin/home/index';
     ******************************************************************/

    public function index()
	{
	    $data = array();
        if ( $this->aauth->is_loggedin() ){

            // Recuperamos los permisos de los grupos
            list($data['ver'], $data['añadir'], $data['editar'], $data['borrar'], $data['admin']) = $this->utils->permisos($this->aauth);

            if (!empty($data['ver']) && $data['ver'] == 1){

                $data['provincias'] = $this->provincias->getAllProvinces();

                // Selecciona la vista actual
                $data['active'] = "provincias";
                $data['user'] = $this->aauth->get_user($this->aauth->get_user_id($email=false));
                $this->load->view('header',$data);
                $this->load->view('provincias/index',$data);
                $this->load->view('footer',$data);

            }
            else{
                $protocol = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "https" : "http");
                $base_url = $protocol . "://" . $_SERVER['HTTP_HOST'];
                $complete_url =   $base_url . $_SERVER["REQUEST_URI"];
                redirect($base_url.'/');
            }

        }
        else {
            $protocol = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "https" : "http");
            $base_url = $protocol . "://" . $_SERVER['HTTP_HOST'];
            $complete_url = $base_url . $_SERVER["REQUEST_URI"];
            redirect($base_url.'/login?url='.substr($_SERVER["REQUEST_URI"],1));
        }

	}
}
