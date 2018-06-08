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
        $this->load->library('Utils');
    }

    /**
     * Init the main view at the website
     */
    public function index()
    {
        $data = array();

        if ($this->aauth->is_loggedin()) {
            $data['user'] = $this->aauth->get_user($this->aauth->get_user_id($email = false));
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

        if ($this->aauth->is_loggedin()) {
            $data['user'] = $this->aauth->get_user($this->aauth->get_user_id($email = false));
        }

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

            if ($this->aauth->is_loggedin()) {
                $data['user'] = $this->aauth->get_user($this->aauth->get_user_id($email = false));
            }

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
            $complete_url = $base_url . $_SERVER["REQUEST_URI"];
            redirect($base_url . '/provincias');
        }

    }

    /**
     * Call the view for render all news
     */
    public function news($map_code = null)
    {
        $data = array();

        if ($this->aauth->is_loggedin()) {
            $data['user'] = $this->aauth->get_user($this->aauth->get_user_id($email = false));
        }

        $data['province'] = $this->portal->getProvince($map_code);
        if (count($data['province']) > 0) {
            $data['news'] = $this->portal->getNewsPortal();
        }
        else{
            $data['news'] = $this->portal->getNewsPortal();
        }

        $data['activo'] = "noticias";
        $this->load->view('header', $data);
        $this->load->view('portal/news', $data);
        $this->load->view('footer', $data);
    }

    /**
     * Call the view for render a single news
     */
    public function singleNews($id_news = false)
    {
        $data = array();

        if (!empty($id_news)){

            $data['buttonComment'] = 'no';

            if ($this->aauth->is_loggedin()) {
                $data['user'] = $this->aauth->get_user($this->aauth->get_user_id($email = false));
                $data['buttonComment'] = 'yes';
            }

            $data['news'] = $this->portal->getNews($id_news);
            $data['news'] = $data['news'][0];
            $data['comments'] = $this->portal->getCommentsNews($id_news);

            $data['news_user'] = $this->aauth->get_user($data['news']->id_admin);

            //Establecemos el uso horario español
            date_default_timezone_set('Europe/Madrid');
            setlocale(LC_TIME, 'spanish');
            setlocale(LC_TIME, 'es_ES.UTF-8');
            $data['fecha'] = (explode("-",strftime("%B-%d-%m-%Y-%R", strtotime($data['news']->date_creation))));
            $data['fecha'] = $data['fecha'][1].' de '.$data['fecha'][0]. ' del '.$data['fecha'][3].' a las '.$data['fecha'][4];

            $data['activo'] = "noticias";

//            echo "<pre>";
//            print_r($data['news']);
//            echo '<br/><hr/>';
//            print_r($data['news_user']);
//            echo '<br/><hr/>';
//            print_r($data['comments']);
//            echo '<br/><hr/>';
//            echo "</pre>";
//            $data['js_to_load'] = 'portal/provinces.js';
            $this->load->view('header', $data);
            $this->load->view('portal/singleNews', $data);
            $this->load->view('footer', $data);
        }
        else{
            $protocol = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "https" : "http");
            $base_url = $protocol . "://" . $_SERVER['HTTP_HOST'];
            $complete_url = $base_url . $_SERVER["REQUEST_URI"];
            redirect($base_url . '/noticias');
        }

    }

    /**
     * Call the view for render the contact form
     */
    public function contact()
    {
        if ($this->input->post()) {

            $response = array();

            // Aquí se recogen los datos del formulario para añadir un nuevo contacto
            if (!empty($this->input->post('contactName') && !empty($this->input->post('contactMail')) && !empty($this->input->post('contactPhone')) && !empty($this->input->post('contactMessage')))) {

                $respuesta = $this->portal->setNewContact(array(
                    "name" => $this->input->post('contactName'),
                    "email" => $this->input->post('contactMail'),
                    "phone" => $this->input->post('contactPhone'),
                    "message" => $this->input->post('contactMessage'),
                    "client_ip" => $this->utils->get_client_ip()
                ));

                if (!empty($respuesta)) {
                    $response['response'] = 'success';
                    $response['message'] = '¡ Información almacenada con éxito !';
                    $this->portal->setNewLog(array(
                        "event_name" => "Nuevo contacto",
                        "event_description" => "Se ha recibido una nueva petición de contacto con el ID '".$respuesta."''",
                        "event_type" => "info",
                        "event_ip" => $this->utils->get_client_ip()
                    ));
                } else {
                    $response['response'] = 'error';
                    $response['message'] = '¡ Se ha producido un error al guardar la petición !';
                }
            } else{
                $response['response'] = 'error';
                $response['message'] = '¡ El mensaje no puede estar vacío !';
            }

            echo json_encode($response);
        } else {
            $data = array();
            if ($this->aauth->is_loggedin()) {
                $data['user'] = $this->aauth->get_user($this->aauth->get_user_id($email = false));
            }
            $data['activo'] = "contacto";
            $data['js_to_load'] = 'portal/contact.js';
            $this->load->view('header', $data);
            $this->load->view('portal/contact', $data);
            $this->load->view('footer', $data);


        }
    }

}
