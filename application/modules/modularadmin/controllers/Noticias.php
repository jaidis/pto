<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Noticias extends MX_Controller {


    /*******************************************************************
     * Noticias constructor
     ******************************************************************/
    public function __construct()
    {
        parent::__construct();
        $this->load->model('NoticiasModel','noticias');
        $this->load->library("Aauth");
        $this->load->library("Utils");
        $this->load->library('upload');
        $this->load->helper('url');
    }

    /*******************************************************************
     * PÁGINA DE INICIO PARA LAS NOTICIAS
     * FORMULARIO PARA BORRAR UNA NOTICIAS
     * $route['pto-admin/noticias'] = 'modularadmin/noticias/index';
     ******************************************************************/

    public function index()
	{
	    if ($this->input->post()){

            $response = array();

            if (!empty($this->input->post('idNews'))){

                $response['data'] = $this->noticias->setDeleteNews($this->input->post('idNews'));

                $response['response'] = 'success';
                $response['message'] = "¡Se ha borrado la noticia!";
                $response['news'] = $this->input->post('idNews');

                $this->noticias->setNewLog(array(
                    "event_name"=>'Noticia Borrada',
                    "event_description"=>"Se ha borrado la noticia con el ID '".$this->input->post('idNews')."'",
                    "event_type"=>"info",
                    "event_ip"=> $this->utils->get_client_ip()
                ));

            }
            else{

                $response['response'] = 'error';
                $response['message'] = "¡No se puede borrar la noticia!";
            }


            echo json_encode($response);

        }
        else{

            $data = array();

            if ( $this->aauth->is_loggedin() ){

                // Recuperamos los permisos de los grupos
                list($data['ver'], $data['añadir'], $data['editar'], $data['borrar'], $data['admin']) = $this->utils->permisos($this->aauth);

                if (!empty($data['ver']) && $data['ver'] == 1){

                    $data['noticias'] = $this->noticias->getAllNews();

                    foreach ($data['noticias'] as $value)
                    {
                        $temp_news = $this->noticias->getProvinceId($value->id_province);
                        $temp_user = $this->noticias->getUserId($value->id_admin);
                        $value->province_name = (!empty($temp_news)) ? $temp_news[0]->name : 'No disponible';
                        $value->user_name = $temp_user[0]->username;
                    }

                    // Selecciona la vista actual
                    $data['active'] = "noticias";
                    $data['user'] = $this->aauth->get_user($this->aauth->get_user_id($email=false));
                    $data['js_to_load'] = 'noticias/index.js';
                    $this->load->view('header',$data);
                    $this->load->view('noticias/index',$data);
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

    /*******************************************************************
     * PÁGINA PARA UNA NUEVA NOTICIA
     * FORMULARIO PARA INSERTAR UNA NOTICIA
     * $route['pto-admin/noticias/new'] = 'modularadmin/noticias/newNews';
     ******************************************************************/

    public function newNews()
    {
        if ($this->input->post()){

            $response = array();

            $noticias = array();

            if (!empty($this->input->post('inputTitle')))
                $noticias['title'] = $this->input->post('inputTitle');

            if (!empty($this->input->post('inputProvincia')))
                $noticias['id_province'] = $this->input->post('inputProvincia');

            if (!empty($this->input->post('inputSubtitle')))
                $noticias['subtitle'] = $this->input->post('inputSubtitle');

            if (!empty($this->input->post('inputDescription')))
                $noticias['description'] = $this->input->post('inputDescription');

            if (!empty($this->input->post('idUser')))
                $noticias['id_admin'] = $this->input->post('idUser');

            if (!empty($this->input->post('valueImage'))){
                $noticias['image_url'] = $this->input->post('valueImage');

                //La imagen se mueve de la carpeta temporal a su directorio, despues se borran todas las imagenes temporales
                @rename ("uploads/".$noticias['image_url'],"assets/img/news/".$noticias['image_url']);
                @array_map('unlink', glob("uploads/*"));
            }

            $noticias['active'] = $this->input->post('active');
            if ($noticias['active'] == "on")
                $noticias['active'] = 1;
            else
                $noticias['active'] = 0;

            $url = $this->utils->eliminar_tildes($noticias['title']);
            $url = $this->utils->eliminar_caracteres($url);
            $url = str_replace(' ','-',$url);
            $noticias['url'] = strtolower($url);

            $result = $this->noticias->setNewNews($noticias);

            $this->noticias->setNewLog(array(
                "event_name"=>'Noticia Añadida',
                "event_description"=>"Se ha añadido la noticia con el ID '".$result."'",
                "event_type"=>"info",
                "event_ip"=> $this->utils->get_client_ip()
            ));

            $response['response'] = 'success';
            $response['data'] = $noticias;
            $response['message'] = "¡Se ha añadido la noticia!";


            echo json_encode($response);

        }
        else{

            $data = array();

            if ( $this->aauth->is_loggedin() ){

                // Recuperamos los permisos de los grupos
                list($data['ver'], $data['añadir'], $data['editar'], $data['borrar'], $data['admin']) = $this->utils->permisos($this->aauth);

                if (!empty($data['añadir']) && $data['añadir'] == 1){

                    $data['provincias'] = $this->noticias->getAllProvinces();

                    // Selecciona la vista actual
                    $data['active'] = "noticias";
                    $data['user'] = $this->aauth->get_user($this->aauth->get_user_id($email=false));
                    $data['js_to_load'] = 'noticias/newsNew.js';
                    $this->load->view('header',$data);
                    $this->load->view('noticias/newsView',$data);
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

    /*******************************************************************
     * PÁGINA PARA EDITAR UNA NOTICIA
     * FORMULARIO PARA EDITAR UNA NOTICIA
     * $route['pto-admin/noticias/edit'] = 'modularadmin/noticias/editNews';
     * $route['pto-admin/noticias/edit/(:num)'] = 'modularadmin/noticias/editNews/$1';
     * @param int $id_news Id de la noticia
     ******************************************************************/

    public function editNews($id_news = null)
    {
        if ($this->input->post()){

            $response = array();

            try{

                $noticias = array();

                if (!empty($this->input->post('inputTitle')))
                    $noticias['title'] = $this->input->post('inputTitle');

                $noticias['id_province'] = intval($this->input->post('inputProvincia'));

                if (!empty($this->input->post('inputSubtitle')))
                    $noticias['subtitle'] = $this->input->post('inputSubtitle');

                if (!empty($this->input->post('inputDescription')))
                    $noticias['description'] = $this->input->post('inputDescription');

                if (!empty($this->input->post('idUser')))
                    $noticias['id_admin'] = $this->input->post('idUser');

                if (!empty($this->input->post('valueImage'))){
                    $noticias['image_url'] = $this->input->post('valueImage');

                    //La imagen se mueve de la carpeta temporal a su directorio, despues se borran todas las imagenes temporales
                    @rename ("uploads/".$noticias['image_url'],"assets/img/news/".$noticias['image_url']);
                    @array_map('unlink', glob("uploads/*"));
                }

                $noticias['active'] = $this->input->post('active');
                if ($noticias['active'] == "on")
                    $noticias['active'] = 1;
                else
                    $noticias['active'] = 0;

                $url = $this->utils->eliminar_tildes($noticias['title']);
                $url = $this->utils->eliminar_caracteres($url);
                $url = str_replace(' ','-',$url);
                $noticias['url'] = strtolower($url);

                $id_news = $this->input->post('inputIdNoticia');

                $this->noticias->setUpdateNews($id_news, $noticias);

                $this->noticias->setNewLog(array(
                    "event_name"=>'Noticia Editada',
                    "event_description"=>"Se ha editado la noticia con el ID '".$id_news."'",
                    "event_type"=>"info",
                    "event_ip"=> $this->utils->get_client_ip()
                ));

                $response['response'] = 'success';
                $response['data'] = $noticias;
                $response['message'] = "¡Se ha editado la noticia!";

            }catch (\Exception $e) {

                $this->noticias->setNewLog(array(
                    "event_name"=>$e->getMessage(),
                    "event_description"=>" Line: ".$e->getLine()." File: ".$e->getFile(),
                    "event_type"=>"error",
                    "event_ip"=> $this->utils->get_client_ip()
                ));

                $response['response'] = 'error';
                $response['message'] = "¡ $e !";
            }

            echo json_encode($response);

        }
        else{

            $data = array();

            if ( $this->aauth->is_loggedin() ){

                // Recuperamos los permisos de los grupos
                list($data['ver'], $data['añadir'], $data['editar'], $data['borrar'], $data['admin']) = $this->utils->permisos($this->aauth);

                if (!empty($data['ver']) && $data['ver'] == 1){

                    $data['noticia'] = $this->noticias->getNewsId($id_news);

                    if (count($data['noticia'])>0){

                        $data['configuracion'] = json_encode(array_values($data['noticia']), JSON_PRETTY_PRINT);

                        $data['noticia'] = $data['noticia'][0];

                        $data['provincias'] = $this->noticias->getAllProvinces();

                        // Selecciona la vista actual
                        $data['active'] = "noticias";
                        $data['user'] = $this->aauth->get_user($this->aauth->get_user_id($email=false));
                        $data['js_to_load'] = 'noticias/newsEdit.js';
                        $this->load->view('header',$data);
                        $this->load->view('noticias/newsView',$data);
                        $this->load->view('footer',$data);

                    }
                    else{
                        $protocol = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "https" : "http");
                        $base_url = $protocol . "://" . $_SERVER['HTTP_HOST'];
                        $complete_url =   $base_url . $_SERVER["REQUEST_URI"];
                        redirect($base_url.'/pto-admin/noticias');
                    }

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

    //******************************************************************
    //	UPLOAD IMAGE
    //	$route['pto-admin/noticias/upload_file'] = 'modularadmin/noticias/uploadImage';
    //******************************************************************

    public function uploadImage(){
        $response = array('response'=>'', 'data'=>'');

        //Configura los parametros para la libreria de Upload
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'jpeg|jpg|png';
        $config['max_size'] = 1024 * 8;
        $config['encrypt_name'] = TRUE;
        $config['max_width']  = '2500';
        $config['max_height']  = '2500';

        $this->upload->initialize($config);
        $boolUpload = $this->upload->do_upload('inputImage');

        if ($boolUpload)
        {
            $respuesta = $this->upload->data();
            if ($respuesta["file_ext"] == '.jpeg' || $respuesta["file_ext"] == '.jpg' || $respuesta["file_ext"] == '.png')
            {
                $response['response'] = 'success';
                $response['data'] = $this->upload->data();
                $response['message'] = "¡La imagen se ha subido correctamente!";
            }
            else
            {
                $response['response'] = 'error';
                $response['message'] = 'No se puede subir este archivo';
                @unlink('uploads/'.$respuesta["file_name"]);
            }
        }
        else
        {
            $response['response'] = 'error';
            $response['message'] = $this->upload->display_errors();
        }

        echo json_encode($response);
    }
}
