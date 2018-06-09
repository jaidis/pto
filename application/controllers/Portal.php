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
        $this->load->library('pagination');
        $this->load->helper('url');

        // Set Spanish date timezone
        date_default_timezone_set('Europe/Madrid');
        setlocale(LC_TIME, 'spanish');
        setlocale(LC_TIME, 'es_ES.UTF-8');
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

        $data['carousel'] = $this->portal->getCarousel();
        $data['news'] = $this->portal->getNewsPortal();

        foreach ($data['news'] as $news){
            $news->fecha = (explode("-",strftime("%B-%d-%m-%Y-%R", strtotime($news->date_creation))));
            $news->fecha = $news->fecha[1].' de '.$news->fecha[0]. ' del '.$news->fecha[3].' a las '.$news->fecha[4];
        }

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

            foreach ($data['news'] as $news){
                $news->fecha = (explode("-",strftime("%B-%d-%m-%Y-%R", strtotime($news->date_creation))));
                $news->fecha = $news->fecha[1].' de '.$news->fecha[0]. ' del '.$news->fecha[3].' a las '.$news->fecha[4];
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
    public function news($page=0)
    {
        $data = array();

        if ($this->aauth->is_loggedin()) {
            $data['user'] = $this->aauth->get_user($this->aauth->get_user_id($email = false));
        }

        $newsPerPage = 10;

        if ($page == 0) {
            $data['news'] = $this->portal->getNewsPortalNews($newsPerPage,0);
        }
        else{
            $data['news'] = $this->portal->getNewsPortalNews($newsPerPage,$page);
        }

        foreach ($data['news'] as $news){
            $news->fecha = (explode("-",strftime("%B-%d-%m-%Y-%R", strtotime($news->date_creation))));
            $news->fecha = $news->fecha[1].' de '.$news->fecha[0]. ' del '.$news->fecha[3].' a las '.$news->fecha[4];
        }

        //Cargar paginación
        $config['full_tag_open'] = '<div class="btn-group" role="group">';
        $config['full_tag_close'] = '</div>';
        $config['cur_tag_open'] = '<button type="button" class="btn btn-primary btn-lg">';
        $config['cur_tag_close'] = '</button>';
        $config['first_link'] = '«';
        $config['prev_link'] = '‹';
        $config['last_link'] = '»';
        $config['next_link'] = '›';
        $config['base_url'] = '/noticias/';
        $config['total_rows'] = count($this->portal->getAllNews());
        $config['per_page'] = $newsPerPage;
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();


        $data['activo'] = "noticias";
        $this->load->view('header', $data);
        $this->load->view('portal/news', $data);
        $this->load->view('footer', $data);
    }

    /**
     * Call the view for render all news
     */
    public function newsProvinces($map_code = null, $page=0)
    {
        echo "Noticias de las provincias <br/>";
        echo "Mapa: $map_code <br/>";
        echo "Pagina: $page <br/>";
/*        $data = array();

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

        foreach ($data['news'] as $news){
            $news->fecha = (explode("-",strftime("%B-%d-%m-%Y-%R", strtotime($news->date_creation))));
            $news->fecha = $news->fecha[1].' de '.$news->fecha[0]. ' del '.$news->fecha[3].' a las '.$news->fecha[4];
        }

        $data['activo'] = "noticias";
        $this->load->view('header', $data);
        $this->load->view('portal/news', $data);
        $this->load->view('footer', $data);*/
    }

    /**
     * Call the view for render a single news
     */
    public function singleNews($id_news = false, $title_news = false)
    {
        if ($this->input->post()) {

            $response = array();
            if (!empty($this->input->post('activeUser') && !empty($this->input->post('activeId')) && !empty($this->input->post('message')))) {
                $data['user'] = $this->aauth->get_user($this->input->post('activeId'));
                if (count($data['user'])>0 && $data['user']->username == $this->input->post('activeUser')){
                    $this->portal->setNewComment(array(
                        "id_user"=>$this->input->post('activeId'),
                        "id_news"=>$this->input->post('newsId'),
                        "message"=>$this->input->post('message')
                    ));
                    $response['response'] = 'success';
                    $response['message'] = '¡ Información almacenada con éxito !';
                }
                else{
                    $response['response'] = 'error';
                    $response['message'] = '¡ La información del usuario no es válida !';
                }
            }
            else{
                $response['response'] = 'error';
                $response['message'] = '¡ Se ha producido un error con el comentario !';
            }
            echo json_encode($response);
        }
        else{

            $data = array();

            if (!empty($id_news)){

                if ($this->aauth->is_loggedin()) {
                    $data['user'] = $this->aauth->get_user($this->aauth->get_user_id($email = false));
                }

                $data['news'] = $this->portal->getNews($id_news);
                $data['news'] = $data['news'][0];
                $data['comments'] = $this->portal->getCommentsNews($id_news);

                $data['news_user'] = $this->aauth->get_user($data['news']->id_admin);

                $data['fecha'] = (explode("-",strftime("%B-%d-%m-%Y-%R", strtotime($data['news']->date_creation))));
                $data['fecha'] = $data['fecha'][1].' de '.$data['fecha'][0]. ' del '.$data['fecha'][3].' a las '.$data['fecha'][4];

                $data['activo'] = "noticias";
                $data['js_to_load'] = 'portal/singleNews.js';
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
    }

    /**
     * Call the view for render the contact form
     */
    public function contact()
    {
        if ($this->input->post()) {

            $response = array();

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
