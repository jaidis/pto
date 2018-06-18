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
        $this->load->library('upload');
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

            $data['description'] = explode(';',$data['province']->description);

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

    /*******************************************************************
     * PÁGINA PARA EDITAR UN USUARIO
     * FORMULARIO PARA EDITAR UN USUARIO
     * $route['usuario'] = 'portal/user';
     ******************************************************************/
    public function user(){

        if ($this->input->post()) {

            $response = array();

            if ($this->aauth->is_loggedin()) {
                $user = $this->aauth->get_user($this->aauth->get_user_id($email = false));

                if (intval($this->input->post('idUser')) == $user->id){

                    try{

                        $usuario = array();

                        if (!empty($this->input->post('inputFirstName')))
                            $usuario['first_name'] = $this->input->post('inputFirstName');

                        if (!empty($this->input->post('inputLastName')))
                            $usuario['last_name'] = $this->input->post('inputLastName');

                        if (!empty($this->input->post('valueImage'))){
                            $usuario['image_url'] = $this->input->post('valueImage');

                            //La imagen se mueve de la carpeta temporal a su directorio, despues se borran todas las imagenes temporales
                            @rename ("uploads/".$usuario['image_url'],"assets/img/users/".$usuario['image_url']);
                            @array_map('unlink', glob("uploads/*"));
                        }

                        $this->portal->setUpdateUser($user->id, $usuario);

                        $this->portal->setNewLog(array(
                            "event_name"=>'Usuario Editado',
                            "event_description"=>"Se ha editado el usuario con el ID '".$user->id."'",
                            "event_type"=>"info",
                            "event_ip"=> $this->utils->get_client_ip()
                        ));

                        $response['response'] = 'success';
                        $response['message'] = '¡ Datos actualizados correctamente !';

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

                }
                else{
                    $response['response'] = 'error';
                    $response['message'] = '¡ No es posible actualizar los datos !';
                }

            }
            else{
                $response['response'] = 'error';
                $response['message'] = '¡ Es necesario estar logueado para actualizar los datos !';
            }



            echo json_encode($response);

        } else {

            $data = array();

            if ($this->aauth->is_loggedin()) {

                $data['user'] = $this->aauth->get_user($this->aauth->get_user_id($email = false));

                // Recuperamos los permisos de los grupos
                list($data['ver'], $data['añadir'], $data['editar'], $data['borrar'], $data['admin']) = $this->utils->permisos($this->aauth);

                $data['activo'] = "";
                $data['js_to_load'] = 'portal/user.js';
                $this->load->view('header', $data);
                $this->load->view('portal/user', $data);
                $this->load->view('footer', $data);
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
     * UPLOAD IMAGE
     * $route['usuario/upload_file'] = 'portal/uploadImage';
     ******************************************************************/

    public function uploadImage(){
        $response = array('response'=>'', 'data'=>'');

        //Configura los parametros para la libreria de Upload
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'jpeg|jpg|png';
        $config['max_size'] = 120;
        $config['encrypt_name'] = TRUE;
        $config['max_width']  = '360';
        $config['max_height']  = '360';

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
