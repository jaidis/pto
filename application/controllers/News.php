<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class News extends CI_Controller
{

    /**
     * News constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('NewsModel', 'news');
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
            $data['news'] = $this->news->getNewsPerPage($newsPerPage,0);
        }
        else{
            $data['news'] = $this->news->getNewsPerPage($newsPerPage,$page);
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
        $config['total_rows'] = count($this->news->getAllNews());
        $config['per_page'] = $newsPerPage;
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();


        $data['activo'] = "noticias";
        $this->load->view('header', $data);
        $this->load->view('news/news', $data);
        $this->load->view('footer', $data);
    }

    /**
     * Call the view for render all news from a Province
     */
    public function newsProvinces($map_code = null, $page=0)
    {
        $data = array();

        $data['province'] = $this->news->getProvince($map_code);
        $data['province'] = $data['province'][0];

        if (count($this->news->getAllNewsProvince($data['province']->id)) > 0){

            if ($this->aauth->is_loggedin()) {
                $data['user'] = $this->aauth->get_user($this->aauth->get_user_id($email = false));
            }

            $newsPerPage = 10;

            if ($page == 0) {
                $data['news'] = $this->news->getNewsProvincePerPage($data['province']->id, $newsPerPage, 0);
            }
            else{
                $data['news'] = $this->news->getNewsProvincePerPage($data['province']->id, $newsPerPage, $page);
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
            $config['base_url'] = '/noticias/'.$map_code.'/';
            $config['total_rows'] = count($this->news->getAllNewsProvince($data['province']->id));
            $config['per_page'] = $newsPerPage;
            $this->pagination->initialize($config);
            $data['pagination'] = $this->pagination->create_links();


            $data['activo'] = "noticias";
            $this->load->view('header', $data);
            $this->load->view('news/news', $data);
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
     * Call the view for render a single news
     */
    public function singleNews($id_news = false, $title_news = false)
    {
        if ($this->input->post()) {

            $response = array();
            if (!empty($this->input->post('activeUser') && !empty($this->input->post('activeId')) && !empty($this->input->post('message')))) {
                $data['user'] = $this->aauth->get_user($this->input->post('activeId'));
                if (count($data['user'])>0 && $data['user']->username == $this->input->post('activeUser')){
                    $result = $this->news->setNewComment(array(
                        "id_user"=>$this->input->post('activeId'),
                        "id_news"=>$this->input->post('newsId'),
                        "message"=>$this->input->post('message')
                    ));
                    $this->news->setNewLog(array(
                        "event_name" => "Nuevo comentario",
                        "event_description" => "Comentario ID '".$result."', Noticia ID'".$this->input->post('newsId')."', Usuario ID'".$this->input->post('activeId')."'",
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

            if (!empty($id_news)){

                $data['news'] = $this->news->getNews($id_news);

                if(count($data['news']) > 0){

                    if ($this->aauth->is_loggedin()) {
                        $data['user'] = $this->aauth->get_user($this->aauth->get_user_id($email = false));
                    }

                    $data['news'] = $data['news'][0];
                    $data['comments'] = $this->news->getCommentsNews($id_news);

                    $data['news_user'] = $this->aauth->get_user($data['news']->id_admin);

                    $data['fecha'] = (explode("-",strftime("%B-%d-%m-%Y-%R", strtotime($data['news']->date_creation))));
                    $data['fecha'] = $data['fecha'][1].' de '.$data['fecha'][0]. ' del '.$data['fecha'][3].' a las '.$data['fecha'][4];

                    $data['description'] = explode(';',$data['news']->description);

                    $data['activo'] = "noticias";
                    $data['js_to_load'] = 'news/singleNews.js';
                    $this->load->view('header', $data);
                    $this->load->view('news/singleNews', $data);
                    $this->load->view('footer', $data);
                }
                else{
                    $protocol = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "https" : "http");
                    $base_url = $protocol . "://" . $_SERVER['HTTP_HOST'];
                    $complete_url = $base_url . $_SERVER["REQUEST_URI"];
                    redirect($base_url . '/noticias');
                }

            }
            else{
                $protocol = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "https" : "http");
                $base_url = $protocol . "://" . $_SERVER['HTTP_HOST'];
                $complete_url = $base_url . $_SERVER["REQUEST_URI"];
                redirect($base_url . '/noticias');
            }
        }
    }

}
