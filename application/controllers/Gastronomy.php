<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gastronomy extends CI_Controller
{

    /**
     * Portal constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('GastronomyModel', 'gastronomy');
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
     * Call the view for render all gastronomies
     */
    public function gastronomies($page=0)
    {
        $data = array();

        if ($this->aauth->is_loggedin()) {
            $data['user'] = $this->aauth->get_user($this->aauth->get_user_id($email = false));
        }

        $gastronomiesPerPage = 9;

        if ($page == 0) {
            $data['gastronomies'] = $this->gastronomy->getGastronomiesPerPage($gastronomiesPerPage,0);
        }
        else{
            $data['gastronomies'] = $this->gastronomy->getGastronomiesPerPage($gastronomiesPerPage,$page);
        }

        foreach ($data['gastronomies'] as $gastronomie){
            $gastronomie->fecha = (explode("-",strftime("%B-%d-%m-%Y-%R", strtotime($gastronomie->date_creation))));
            $gastronomie->fecha = $gastronomie->fecha[1].' de '.$gastronomie->fecha[0]. ' del '.$gastronomie->fecha[3].' a las '.$gastronomie->fecha[4];
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
        $config['base_url'] = '/gastronomias/';
        $config['total_rows'] = count($this->gastronomy->getAllGastronomies());
        $config['per_page'] = $gastronomiesPerPage;
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();


        $data['activo'] = "gastronomia";
        $this->load->view('header', $data);
        $this->load->view('portal/gastronomies', $data);
        $this->load->view('footer', $data);
    }

    /**
     * Call the view for render all gastronomies from a Province
     */
    public function gastronomiesProvinces($map_code = null, $page=0)
    {
        $data = array();

        $data['province'] = $this->gastronomy->getProvince($map_code);
        $data['province'] = $data['province'][0];

        if (count($this->gastronomy->getAllGastronomiesProvince($data['province']->id)) > 0){

            if ($this->aauth->is_loggedin()) {
                $data['user'] = $this->aauth->get_user($this->aauth->get_user_id($email = false));
            }

            $newsPerPage = 9;

            if ($page == 0) {
                $data['gastronomies'] = $this->gastronomy->getGastronomiesProvincePerPage($data['province']->id, $newsPerPage, 0);
            }
            else{
                $data['gastronomies'] = $this->gastronomy->getGastronomiesProvincePerPage($data['province']->id, $newsPerPage, $page);
            }

            foreach ($data['gastronomies'] as $gastronomy){
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
            $config['base_url'] = '/gastronomias/'.$map_code.'/';
            $config['total_rows'] = count($this->gastronomy->getAllGastronomiesProvince($data['province']->id));
            $config['per_page'] = $newsPerPage;
            $this->pagination->initialize($config);
            $data['pagination'] = $this->pagination->create_links();


            $data['activo'] = "gastronomia";
            $this->load->view('header', $data);
            $this->load->view('portal/gastronomies', $data);
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
     * Call the view for render a single gastronomy
     */
    public function singleGastronomy($id_gastronomy = false, $title_gastronomy = false)
    {
        if ($this->input->post()) {

            $response = array();
            if (!empty($this->input->post('activeUser') && !empty($this->input->post('activeId')) && !empty($this->input->post('message')))) {
                $data['user'] = $this->aauth->get_user($this->input->post('activeId'));
                if (count($data['user'])>0 && $data['user']->username == $this->input->post('activeUser')){
                    $result = $this->gastronomy->setNewComment(array(
                        "id_user"=>$this->input->post('activeId'),
                        "id_gastronomies"=>$this->input->post('gastronomiesId'),
                        "message"=>$this->input->post('message')
                    ));
                    $this->gastronomy->setNewLog(array(
                        "event_name" => "Nuevo comentario",
                        "event_description" => "Comentario ID '".$result."', Gastronomia ID'".$this->input->post('gastronomiesId')."', Usuario ID'".$this->input->post('activeId')."'",
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

            if (!empty($id_gastronomy)){

                if ($this->aauth->is_loggedin()) {
                    $data['user'] = $this->aauth->get_user($this->aauth->get_user_id($email = false));
                }

                $data['gastronomies'] = $this->gastronomy->getGastronomy($id_gastronomy);
                $data['gastronomies'] = $data['gastronomies'][0];
                $data['comments'] = $this->gastronomy->getCommentsGastronomies($id_gastronomy);

                $data['comments_user'] = $this->aauth->get_user($data['gastronomies']->id_admin);

                $data['fecha'] = (explode("-",strftime("%B-%d-%m-%Y-%R", strtotime($data['gastronomies']->date_creation))));
                $data['fecha'] = $data['fecha'][1].' de '.$data['fecha'][0]. ' del '.$data['fecha'][3].' a las '.$data['fecha'][4];

                $data['activo'] = "gastronomia";
                $data['js_to_load'] = 'portal/singleGastronomy.js';
                $this->load->view('header', $data);
                $this->load->view('portal/singleGastronomy', $data);
                $this->load->view('footer', $data);
            }
            else{
                $protocol = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "https" : "http");
                $base_url = $protocol . "://" . $_SERVER['HTTP_HOST'];
                $complete_url = $base_url . $_SERVER["REQUEST_URI"];
                redirect($base_url . '/gastronomias');
            }
        }
    }

}
