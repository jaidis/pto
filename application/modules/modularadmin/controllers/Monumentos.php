<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Monumentos extends MX_Controller {


    /*******************************************************************
     * Monumentos constructor
     ******************************************************************/
    public function __construct()
    {
        parent::__construct();
        $this->load->model('MonumentosModel','monumentos');
        $this->load->library("Aauth");
        $this->load->library("Utils");
        $this->load->library('upload');
        $this->load->helper('url');
    }

    /*******************************************************************
     * PÁGINA DE INICIO PARA LOS MONUMENTS
     * FORMULARIO PARA BORRAR UN MONUMENTO
     * $route['pto-admin/monumentos'] = 'modularadmin/monumentos/index';
     ******************************************************************/

    public function index()
	{
	    if ($this->input->post()){

            $response = array();

            if (!empty($this->input->post('idMonument'))){

                $response['data'] = $this->monumentos->setDeleteMonument($this->input->post('idMonument'));

                $response['response'] = 'success';
                $response['message'] = "¡Se ha borrado el monumento!";
                $response['province'] = $this->input->post('idMonument');

                $this->monumentos->setNewLog(array(
                    "event_name"=>'Monumento Borrado',
                    "event_description"=>"Se ha borrado el monumento con el ID '".$this->input->post('idMonument')."'",
                    "event_type"=>"info",
                    "event_ip"=> $this->utils->get_client_ip()
                ));

            }
            else{

                $response['response'] = 'error';
                $response['message'] = "¡ No se puede borrar el momumento !";
            }


            echo json_encode($response);

        }
        else{

            $data = array();

            if ( $this->aauth->is_loggedin() ){

                // Recuperamos los permisos de los grupos
                list($data['ver'], $data['añadir'], $data['editar'], $data['borrar'], $data['admin']) = $this->utils->permisos($this->aauth);

                if (!empty($data['ver']) && $data['ver'] == 1){

                    $data['monumentos'] = $this->monumentos->getAllMonuments();

                    foreach ($data['monumentos'] as $value)
                    {
                        $temp_province = $this->monumentos->getProvinceId($value->id_province);
                        $temp_user = $this->monumentos->getUserId($value->id_admin);
                        $value->province_name = $temp_province[0]->name;
                        $value->user_name = $temp_user[0]->username;
                    }

                    // Selecciona la vista actual
                    $data['active'] = "monumentos";
                    $data['user'] = $this->aauth->get_user($this->aauth->get_user_id($email=false));
                    $data['js_to_load'] = 'monumentos/index.js';
                    $this->load->view('header',$data);
                    $this->load->view('monumentos/index',$data);
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
     * PÁGINA PARA UNA NUEVO MONUMENTO
     * FORMULARIO PARA INSERTAR UN MONUMENTO
     * $route['pto-admin/monumentos/new'] = 'modularadmin/monumentos/newMonument';
     ******************************************************************/

    public function newMonument()
    {
        if ($this->input->post()){

            $response = array();

            $monumentos = array();

            if (!empty($this->input->post('inputNombre')))
                $monumentos['name'] = $this->input->post('inputNombre');

            if (!empty($this->input->post('inputYear')))
                $monumentos['year'] = $this->input->post('inputYear');

            if (!empty($this->input->post('inputProvincia')))
                $monumentos['id_province'] = $this->input->post('inputProvincia');

            if (!empty($this->input->post('inputCoordenadaX')))
                $monumentos['coordenate_x'] = $this->input->post('inputCoordenadaX');

            if (!empty($this->input->post('inputCoordenadaY')))
                $monumentos['coordenate_y'] = $this->input->post('inputCoordenadaY');

            if (!empty($this->input->post('inputWeb')))
                $monumentos['web'] = $this->input->post('inputWeb');

            if (!empty($this->input->post('inputDescription')))
                $monumentos['description'] = $this->input->post('inputDescription');

            if (!empty($this->input->post('idUser')))
                $monumentos['id_admin'] = $this->input->post('idUser');

            if (!empty($this->input->post('valueImage'))){
                $monumentos['image_url'] = $this->input->post('valueImage');

                //La imagen se mueve de la carpeta temporal a su directorio, despues se borran todas las imagenes temporales
                @rename ("uploads/".$monumentos['image_url'],"assets/img/monuments/".$monumentos['image_url']);
                @array_map('unlink', glob("uploads/*"));
            }

            $monumentos['active'] = $this->input->post('active');
            if ($monumentos['active'] == "on")
                $monumentos['active'] = 1;
            else
                $monumentos['active'] = 0;

            $url = $this->utils->eliminar_tildes($monumentos['name']);
            $url = $this->utils->eliminar_caracteres($url);
            $url = str_replace(' ','-',$url);
            $monumentos['url'] = strtolower($url);

            $result = $this->monumentos->setNewMonument($monumentos);

            $this->monumentos->setNewLog(array(
                "event_name"=>'Monumento Añadido',
                "event_description"=>"Se ha añadido el monumento con el ID '".$result."'",
                "event_type"=>"info",
                "event_ip"=> $this->utils->get_client_ip()
            ));

            $response['response'] = 'success';
            $response['data'] = $monumentos;
            $response['message'] = "¡Se ha añadido el monumento!";


            echo json_encode($response);

        }
        else{

            $data = array();

            if ( $this->aauth->is_loggedin() ){

                // Recuperamos los permisos de los grupos
                list($data['ver'], $data['añadir'], $data['editar'], $data['borrar'], $data['admin']) = $this->utils->permisos($this->aauth);

                if (!empty($data['añadir']) && $data['añadir'] == 1){

                    $data['provincias'] = $this->monumentos->getAllProvinces();

                    // Selecciona la vista actual
                    $data['active'] = "monumentos";
                    $data['user'] = $this->aauth->get_user($this->aauth->get_user_id($email=false));
                    $data['js_to_load'] = 'monumentos/monumentNew.js';
                    $this->load->view('header',$data);
                    $this->load->view('monumentos/monumentsView',$data);
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
     * PÁGINA PARA EDITAR UN MONUMENTO
     * FORMULARIO PARA EDITAR UN MONUMENTO
     * $route['pto-admin/monumentos/edit'] = 'modularadmin/monumentos/editMonument';
     * $route['pto-admin/monumentos/edit/(:num)'] = 'modularadmin/monumentos/editMonument/$1';
     * @param int $id_monument Id deL monumento
     ******************************************************************/

    public function editMonument($id_monument = null)
    {
        if ($this->input->post()){

            $response = array();

            try{

                $monumentos = array();

                if (!empty($this->input->post('inputNombre')))
                    $monumentos['name'] = $this->input->post('inputNombre');

                if (!empty($this->input->post('inputYear')))
                    $monumentos['year'] = $this->input->post('inputYear');

                if (!empty($this->input->post('inputProvincia')))
                    $monumentos['id_province'] = $this->input->post('inputProvincia');

                if (!empty($this->input->post('inputCoordenadaX')))
                    $monumentos['coordenate_x'] = $this->input->post('inputCoordenadaX');

                if (!empty($this->input->post('inputCoordenadaY')))
                    $monumentos['coordenate_y'] = $this->input->post('inputCoordenadaY');

                if (!empty($this->input->post('inputWeb')))
                    $monumentos['web'] = $this->input->post('inputWeb');

                if (!empty($this->input->post('inputDescription')))
                    $monumentos['description'] = $this->input->post('inputDescription');

                if (!empty($this->input->post('idUser')))
                    $monumentos['id_admin'] = $this->input->post('idUser');

                if (!empty($this->input->post('valueImage'))){
                    $monumentos['image_url'] = $this->input->post('valueImage');

                    //La imagen se mueve de la carpeta temporal a su directorio, despues se borran todas las imagenes temporales
                    @rename ("uploads/".$monumentos['image_url'],"assets/img/monuments/".$monumentos['image_url']);
                    @array_map('unlink', glob("uploads/*"));
                }

                $monumentos['active'] = $this->input->post('active');
                if ($monumentos['active'] == "on")
                    $monumentos['active'] = 1;
                else
                    $monumentos['active'] = 0;

                $url = $this->utils->eliminar_tildes($monumentos['name']);
                $url = $this->utils->eliminar_caracteres($url);
                $url = str_replace(' ','-',$url);
                $monumentos['url'] = strtolower($url);

                $id_monument = $this->input->post('inputIdMonumento');

                $this->monumentos->setUpdateMonument($id_monument, $monumentos);

                $this->monumentos->setNewLog(array(
                    "event_name"=>'Monumento Editado',
                    "event_description"=>"Se ha editado el monumento con el ID '".$id_monument."'",
                    "event_type"=>"info",
                    "event_ip"=> $this->utils->get_client_ip()
                ));

                $response['response'] = 'success';
                $response['data'] = $monumentos;
                $response['message'] = "¡Se ha editado el monumento!";

            }catch (\Exception $e) {

                $this->monumentos->setNewLog(array(
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

                    $data['monumento'] = $this->monumentos->getMonumentId($id_monument);

                    if (count($data['monumento'])>0){

                        $data['configuracion'] = json_encode(array_values($data['monumento']), JSON_PRETTY_PRINT);

                        $data['monumento'] = $data['monumento'][0];

                        $data['provincias'] = $this->monumentos->getAllProvinces();

                        // Selecciona la vista actual
                        $data['active'] = "monumentos";
                        $data['user'] = $this->aauth->get_user($this->aauth->get_user_id($email=false));
                        $data['js_to_load'] = 'monumentos/monumentEdit.js';
                        $this->load->view('header',$data);
                        $this->load->view('monumentos/monumentsView',$data);
                        $this->load->view('footer',$data);

                    }
                    else{
                        $protocol = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "https" : "http");
                        $base_url = $protocol . "://" . $_SERVER['HTTP_HOST'];
                        $complete_url =   $base_url . $_SERVER["REQUEST_URI"];
                        redirect($base_url.'/pto-admin/monumentos');
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
    //	$route['campaigns/upload_file'] = 'campaigns/uploadImage';
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
