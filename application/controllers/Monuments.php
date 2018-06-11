<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Monuments extends CI_Controller
{

    /**
     * Monuments constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('MonumentsModel', 'monuments');
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
     * Call the view for render all monuments
     */
    public function monuments($page=0)
    {
        $data = array();

        if ($this->aauth->is_loggedin()) {
            $data['user'] = $this->aauth->get_user($this->aauth->get_user_id($email = false));
        }

        $monumentsPerPage = 9;

        if ($page == 0) {
            $data['monuments'] = $this->monuments->getMonumentsPerPage($monumentsPerPage,0);
        }
        else{
            $data['monuments'] = $this->monuments->getMonumentsPerPage($monumentsPerPage,$page);
        }

        foreach ($data['monuments'] as $monument){
            $monument->fecha = (explode("-",strftime("%B-%d-%m-%Y-%R", strtotime($monument->date_creation))));
            $monument->fecha = $monument->fecha[1].' de '.$monument->fecha[0]. ' del '.$monument->fecha[3].' a las '.$monument->fecha[4];
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
        $config['base_url'] = '/monumentos/';
        $config['total_rows'] = count($this->monuments->getAllMonuments());
        $config['per_page'] = $monumentsPerPage;
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();


        $data['activo'] = "monumentos";
        $this->load->view('header', $data);
        $this->load->view('monuments/monuments', $data);
        $this->load->view('footer', $data);
    }

    /**
     * Call the view for render all monuments from a Province
     */
    public function monumentsProvinces($map_code = null, $page=0)
    {
        $data = array();

        $data['province'] = $this->monuments->getProvince($map_code);
        $data['province'] = $data['province'][0];

        if (count($this->monuments->getAllMonumentsProvince($data['province']->id)) > 0){

            if ($this->aauth->is_loggedin()) {
                $data['user'] = $this->aauth->get_user($this->aauth->get_user_id($email = false));
            }

            $newsPerPage = 9;

            if ($page == 0) {
                $data['monuments'] = $this->monuments->getMonumentsProvincePerPage($data['province']->id, $newsPerPage, 0);
            }
            else{
                $data['monuments'] = $this->monuments->getMonumentsProvincePerPage($data['province']->id, $newsPerPage, $page);
            }

            foreach ($data['monuments'] as $gastronomy){
                $gastronomy->fecha = (explode("-",strftime("%B-%d-%m-%Y-%R", strtotime($gastronomy->date_creation))));
                $gastronomy->fecha = $gastronomy->fecha[1].' de '.$gastronomy->fecha[0]. ' del '.$gastronomy->fecha[3].' a las '.$gastronomy->fecha[4];
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
            $config['base_url'] = '/monumentos/'.$map_code.'/';
            $config['total_rows'] = count($this->monuments->getAllMonumentsProvince($data['province']->id));
            $config['per_page'] = $newsPerPage;
            $this->pagination->initialize($config);
            $data['pagination'] = $this->pagination->create_links();


            $data['activo'] = "monumentos";
            $this->load->view('header', $data);
            $this->load->view('monuments/monuments', $data);
            $this->load->view('footer', $data);
        }
        else{
            $protocol = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "https" : "http");
            $base_url = $protocol . "://" . $_SERVER['HTTP_HOST'];
            $complete_url = $base_url . $_SERVER["REQUEST_URI"];
            redirect($base_url . '/gastronomias');
        }


    }

    /**
     * Call the view for render a single monument
     * TODO IMAGENES ASOCIADAS AL MONUMENTO
     */
    public function singleMonument($id_monument = false, $title_monument = false)
    {
        if ($this->input->post()) {

            $response = array();
            if (!empty($this->input->post('activeUser') && !empty($this->input->post('activeId')) && !empty($this->input->post('message')))) {
                $data['user'] = $this->aauth->get_user($this->input->post('activeId'));
                if (count($data['user'])>0 && $data['user']->username == $this->input->post('activeUser')){
                    $result = $this->monuments->setNewComment(array(
                        "id_user"=>$this->input->post('activeId'),
                        "id_monuments"=>$this->input->post('monumentsId'),
                        "message"=>$this->input->post('message')
                    ));
                    $this->monuments->setNewLog(array(
                        "event_name" => "Nuevo comentario",
                        "event_description" => "Comentario ID '".$result."', Monuments ID'".$this->input->post('monumentsId')."', Usuario ID'".$this->input->post('activeId')."'",
                        "event_type" => "info",
                        "event_ip" => $this->utils->get_client_ip()
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

            if (!empty($id_monument)){

                $data['monuments'] = $this->monuments->getMonument($id_monument);

                if (count($data['monuments'])>0){

                    if ($this->aauth->is_loggedin()) {
                        $data['user'] = $this->aauth->get_user($this->aauth->get_user_id($email = false));
                    }

                    $data['monuments'] = $data['monuments'][0];
                    $data['comments'] = $this->monuments->getCommentsMonuments($id_monument);

                    $data['comments_user'] = $this->aauth->get_user($data['monuments']->id_admin);

                    $data['fecha'] = (explode("-",strftime("%B-%d-%m-%Y-%R", strtotime($data['monuments']->date_creation))));
                    $data['fecha'] = $data['fecha'][1].' de '.$data['fecha'][0]. ' del '.$data['fecha'][3].' a las '.$data['fecha'][4];

                    $data['description'] = explode(';',$data['monuments']->description);

                    $data['activo'] = "monumentos";
                    $data['js_to_load'] = 'monuments/singleMonument.js';
                    $this->load->view('header', $data);
                    $this->load->view('monuments/singleMonument', $data);
                    $this->load->view('footer', $data);
                }
                else{
                    $protocol = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "https" : "http");
                    $base_url = $protocol . "://" . $_SERVER['HTTP_HOST'];
                    $complete_url = $base_url . $_SERVER["REQUEST_URI"];
                    redirect($base_url . '/monumentos');
                }

            }
            else{
                $protocol = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "https" : "http");
                $base_url = $protocol . "://" . $_SERVER['HTTP_HOST'];
                $complete_url = $base_url . $_SERVER["REQUEST_URI"];
                redirect($base_url . '/monumentos');
            }
        }
    }

}
