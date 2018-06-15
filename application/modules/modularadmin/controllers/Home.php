<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MX_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	public function __construct()
    {
        parent::__construct();
        $this->load->model('HomeModel','home');
        $this->load->library("Aauth");
        $this->load->library("Utils");
        $this->load->helper('url');
    }

    public function index()
	{
	    $data = array();
        if ( $this->aauth->is_loggedin() ){

            // Recuperamos los permisos de los grupos
            list($data['ver'], $data['añadir'], $data['editar'], $data['borrar'], $data['admin']) = $this->utils->permisos($this->aauth);

            if (!empty($data['ver']) && $data['ver'] == 1){

                $data['news'] = $this->home->getNewsPortal();


                // Selecciona la vista actual
                $data['active'] = "home";
                $data['user'] = $this->aauth->get_user($this->aauth->get_user_id($email=false));
                $this->load->view('header',$data);
                $this->load->view('content-template',$data);
                $this->load->view('footer',$data);
                //echo "prueba de la vista de bienvenida";

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
