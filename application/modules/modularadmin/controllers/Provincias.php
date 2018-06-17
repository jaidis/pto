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
        $this->load->library('upload');
        $this->load->helper('url');
    }

    /*******************************************************************
     * PÁGINA DE INICIO PARA LAS PROVINCIAS
     * FORMULARIO PARA BORRAR UNA PROVINCIA
     * $route['pto-admin/provincias'] = 'modularadmin/provincias/index';
     ******************************************************************/

    public function index()
	{
	    if ($this->input->post()){

            $response = array();

            if (!empty($this->input->post('idProvince'))){

                $response['data'] = $this->provincias->setDeleteProvince($this->input->post('idProvince'));

                $response['response'] = 'success';
                $response['message'] = "¡ Se ha borrado la provincia !";
                $response['province'] = $this->input->post('idProvince');

                $this->provincias->setNewLog(array(
                    "event_name"=>'Provincia Borrada',
                    "event_description"=>"Se ha borrado la provincia con el ID '".$this->input->post('idProvince')."'",
                    "event_type"=>"info",
                    "event_ip"=> $this->utils->get_client_ip()
                ));

            }
            else{

                $response['response'] = 'error';
                $response['message'] = "¡ No se puede borrar la provincia !";
            }


            echo json_encode($response);

        }
        else{

            $data = array();

            if ( $this->aauth->is_loggedin() ){

                // Recuperamos los permisos de los grupos
                list($data['ver'], $data['añadir'], $data['editar'], $data['borrar'], $data['admin']) = $this->utils->permisos($this->aauth);

                if (!empty($data['ver']) && $data['ver'] == 1){

                    $data['provincias'] = $this->provincias->getAllProvinces();

                    // Selecciona la vista actual
                    $data['active'] = "provincias";
                    $data['user'] = $this->aauth->get_user($this->aauth->get_user_id($email=false));
                    $data['js_to_load'] = 'provincias/index.js';
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

    /*******************************************************************
     * PÁGINA PARA UNA NUEVA PROVINCIA
     * FORMULARIO PARA INSERTAR UNA PROVINCIA
     * $route['pto-admin/provincias/new'] = 'modularadmin/provincias/newProvince';
     ******************************************************************/

    public function newProvince()
    {
        if ($this->input->post()){

            $response = array();

            $province = $this->provincias->getProvinceCode($this->input->post('inputProvincia'));

            if (count($province)>0){

                if (count($this->provincias->getProvinceMapCode($province[0]->value))<1){

                    $provincias = array();

                    $provincias['id'] = $province[0]->id;

                    $provincias['name'] = $province[0]->name;

                    $provincias['map_code'] = $province[0]->value;

                    if (!empty($this->input->post('inputDescription')))
                        $provincias['description'] = $this->input->post('inputDescription');

                    if (!empty($this->input->post('valueImage'))){

                        $provincias['image_url'] = $this->input->post('valueImage');

                        //La imagen se mueve de la carpeta temporal a su directorio, despues se borran todas las imagenes temporales
                        @rename ("uploads/".$provincias['image_url'],"assets/img/province/".$provincias['image_url']);
                        @array_map('unlink', glob("uploads/*"));
                    }

                    $provincias['active'] = $this->input->post('active');
                    if ($provincias['active'] == "on")
                        $provincias['active'] = 1;
                    else
                        $provincias['active'] = 0;

                    $result = $this->provincias->setNewProvince($provincias);

                    $this->provincias->setNewLog(array(
                        "event_name"=>'Provincia Añadida',
                        "event_description"=>"Se ha añadido la provincia con el ID '".$result."'",
                        "event_type"=>"info",
                        "event_ip"=> $this->utils->get_client_ip()
                    ));

                    $response['response'] = 'success';
                    $response['data'] = $provincias;
                    $response['message'] = "¡ Se ha añadido la provincia !";

                }
                else{
                    $response['response'] = 'error';
                    $response['message'] = "¡ La provincia ya existe !";
                }
            }
            else{
                $response['response'] = 'error';
                $response['message'] = "¡ El código no es válido !";
                $response['province'] = $province;
            }

            echo json_encode($response);

        }
        else{

            $data = array();

            if ( $this->aauth->is_loggedin() ){

                // Recuperamos los permisos de los grupos
                list($data['ver'], $data['añadir'], $data['editar'], $data['borrar'], $data['admin']) = $this->utils->permisos($this->aauth);

                if (!empty($data['añadir']) && $data['añadir'] == 1){

                    $data['codes'] = $this->provincias->getAllProvincesCodes();

                    // Selecciona la vista actual
                    $data['active'] = "provincias";
                    $data['user'] = $this->aauth->get_user($this->aauth->get_user_id($email=false));
                    $data['js_to_load'] = 'provincias/provinceNew.js';
                    $this->load->view('header',$data);
                    $this->load->view('provincias/provincesView',$data);
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
     * PÁGINA PARA EDITAR UNA PROVINCIA
     * FORMULARIO PARA EDITAR UNA PROVINCIA
     * $route['pto-admin/provincias/edit'] = 'modularadmin/provincias/editProvince';
     * $route['pto-admin/provincias/edit/(:num)'] = 'modularadmin/provincias/editProvince/$1';
     * @param int $id_province Id de la provincia
     ******************************************************************/

    public function editProvince($id_province = null)
    {
        if ($this->input->post()){

            $response = array();

            try{

                $provincias = array();

                if (!empty($this->input->post('inputNombre')))
                    $provincias['name'] = $this->input->post('inputNombre');

                if (!empty($this->input->post('inputMapCode')))
                    $provincias['map_code'] = $this->input->post('inputMapCode');

                if (!empty($this->input->post('inputDescription')))
                    $provincias['description'] = $this->input->post('inputDescription');

                if (!empty($this->input->post('valueImage'))){

                    $provincias['image_url'] = $this->input->post('valueImage');

                    //La imagen se mueve de la carpeta temporal a su directorio, despues se borran todas las imagenes temporales
                    @rename ("uploads/".$provincias['image_url'],"assets/img/province/".$provincias['image_url']);
                    @array_map('unlink', glob("uploads/*"));
                }

                $provincias['active'] = $this->input->post('active');
                if ($provincias['active'] == "on")
                    $provincias['active'] = 1;
                else
                    $provincias['active'] = 0;

                $id_province = $this->input->post('inputIdProvincia');

                $this->provincias->setUpdateProvince($id_province, $provincias);

                $this->provincias->setNewLog(array(
                    "event_name"=>'Provincia Editada',
                    "event_description"=>"Se ha editado la provincia con el ID '".$id_province."'",
                    "event_type"=>"info",
                    "event_ip"=> $this->utils->get_client_ip()
                ));

                $response['response'] = 'success';
                $response['data'] = $provincias;
                $response['message'] = "¡ Se ha editado la provincia !";

            }catch (\Exception $e) {

                $this->provincias->setNewLog(array(
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

                    $data['provincia'] = $this->provincias->getProvinceId($id_province);

                    if (count($data['provincia'])>0){

                        $data['provincia'] = $data['provincia'][0];

                        // Selecciona la vista actual
                        $data['active'] = "provincias";
                        $data['user'] = $this->aauth->get_user($this->aauth->get_user_id($email=false));
                        $data['js_to_load'] = 'provincias/provinceEdit.js';
                        $this->load->view('header',$data);
                        $this->load->view('provincias/provincesView',$data);
                        $this->load->view('footer',$data);

                    }
                    else{
                        $protocol = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "https" : "http");
                        $base_url = $protocol . "://" . $_SERVER['HTTP_HOST'];
                        $complete_url =   $base_url . $_SERVER["REQUEST_URI"];
                        redirect($base_url.'/pto-admin/provincias');
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
    //	$route['pto-admin/provincias/upload_file'] = 'modularadmin/provincias/uploadImage';
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
