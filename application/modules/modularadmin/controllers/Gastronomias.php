<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gastronomias extends MX_Controller {


    /*******************************************************************
     * Gastronomias constructor
     ******************************************************************/
    public function __construct()
    {
        parent::__construct();
        $this->load->model('GastronomiasModel','gastronomias');
        $this->load->library("Aauth");
        $this->load->library("Utils");
        $this->load->library('upload');
        $this->load->helper('url');
    }

    /*******************************************************************
     * PÁGINA DE INICIO PARA LAS GASTRONOMIAS
     * FORMULARIO PARA BORRAR UNA GASTRONOMIA
     * $route['pto-admin/gastronomias'] = 'modularadmin/gastronomias/index';
     ******************************************************************/

    public function index()
	{
	    if ($this->input->post()){

            $response = array();

            if (!empty($this->input->post('idGastronomy'))){

                $response['data'] = $this->gastronomias->setDeleteGastronomy($this->input->post('idGastronomy'));

                $response['response'] = 'success';
                $response['message'] = "¡Se ha borrado la gastronomía!";
                $response['gastronomy'] = $this->input->post('idGastronomy');

                $this->gastronomias->setNewLog(array(
                    "event_name"=>'Gastronomia Borrada',
                    "event_description"=>"Se ha borrado la gastronomia con el ID '".$this->input->post('idGastronomy')."'",
                    "event_type"=>"info",
                    "event_ip"=> $this->utils->get_client_ip()
                ));

            }
            else{

                $response['response'] = 'error';
                $response['message'] = "¡No se puede borrar la gastronomia!";
            }


            echo json_encode($response);

        }
        else{

            $data = array();

            if ( $this->aauth->is_loggedin() ){

                // Recuperamos los permisos de los grupos
                list($data['ver'], $data['añadir'], $data['editar'], $data['borrar'], $data['admin']) = $this->utils->permisos($this->aauth);

                if (!empty($data['ver']) && $data['ver'] == 1){

                    $data['gastronomias'] = $this->gastronomias->getAllGastronomies();

                    foreach ($data['gastronomias'] as $value)
                    {
                        $temp_gastronomy = $this->gastronomias->getProvinceId($value->id_province);
                        $temp_user = $this->gastronomias->getUserId($value->id_admin);
                        $value->province_name = (!empty($temp_gastronomy)) ? $temp_gastronomy[0]->name : 'No disponible';
                        $value->user_name = $temp_user[0]->username;
                    }

                    // Selecciona la vista actual
                    $data['active'] = "gastronomias";
                    $data['user'] = $this->aauth->get_user($this->aauth->get_user_id($email=false));
                    $data['js_to_load'] = 'gastronomias/index.js';
                    $this->load->view('header',$data);
                    $this->load->view('gastronomias/index',$data);
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
     * PÁGINA PARA UNA NUEVA GASTRONOMIA
     * FORMULARIO PARA INSERTAR UNA GASTRONOMIA
     * $route['pto-admin/gastronomias/new'] = 'modularadmin/gastronomias/newGastronomy';
     ******************************************************************/

    public function newGastronomy()
    {
        if ($this->input->post()){

            $response = array();

            $gastronomias = array();

            if (!empty($this->input->post('inputNombre')))
                $gastronomias['name'] = $this->input->post('inputNombre');

            if (!empty($this->input->post('inputProvincia')))
                $gastronomias['id_province'] = $this->input->post('inputProvincia');

            if (!empty($this->input->post('inputIngredientes')))
                $gastronomias['ingredients'] = $this->input->post('inputIngredientes');

            if (!empty($this->input->post('inputElaboracion')))
                $gastronomias['elaboration'] = $this->input->post('inputElaboracion');

            if (!empty($this->input->post('idUser')))
                $gastronomias['id_admin'] = $this->input->post('idUser');

            if (!empty($this->input->post('valueImage'))){
                $gastronomias['image_url'] = $this->input->post('valueImage');

                //La imagen se mueve de la carpeta temporal a su directorio, despues se borran todas las imagenes temporales
                @rename ("uploads/".$gastronomias['image_url'],"assets/img/gastronomies/".$gastronomias['image_url']);
                @array_map('unlink', glob("uploads/*"));
            }

            $gastronomias['active'] = $this->input->post('active');
            if ($gastronomias['active'] == "on")
                $gastronomias['active'] = 1;
            else
                $gastronomias['active'] = 0;

            $url = $this->utils->eliminar_tildes($gastronomias['name']);
            $url = $this->utils->eliminar_caracteres($url);
            $url = str_replace(' ','-',$url);
            $gastronomias['url'] = strtolower($url);

            $result = $this->gastronomias->setNewGastronomy($gastronomias);

            $this->gastronomias->setNewLog(array(
                "event_name"=>'Gastronomia Añadida',
                "event_description"=>"Se ha añadida la gastronomia con el ID '".$result."'",
                "event_type"=>"info",
                "event_ip"=> $this->utils->get_client_ip()
            ));

            $response['response'] = 'success';
            $response['data'] = $gastronomias;
            $response['message'] = "¡Se ha añadido la gastronomia!";


            echo json_encode($response);

        }
        else{

            $data = array();

            if ( $this->aauth->is_loggedin() ){

                // Recuperamos los permisos de los grupos
                list($data['ver'], $data['añadir'], $data['editar'], $data['borrar'], $data['admin']) = $this->utils->permisos($this->aauth);

                if (!empty($data['añadir']) && $data['añadir'] == 1){

                    $data['provincias'] = $this->gastronomias->getAllProvinces();

                    // Selecciona la vista actual
                    $data['active'] = "gastronomias";
                    $data['user'] = $this->aauth->get_user($this->aauth->get_user_id($email=false));
                    $data['js_to_load'] = 'gastronomias/gastronomyNew.js';
                    $this->load->view('header',$data);
                    $this->load->view('gastronomias/gastronomiesView',$data);
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
     * PÁGINA PARA EDITAR UNA GASTRONOMIA
     * FORMULARIO PARA EDITAR UNA GASTRONOMIA
     * $route['pto-admin/gastronomias/edit'] = 'modularadmin/gastronomias/editGastronomy';
     * $route['pto-admin/gastronomias/edit/(:num)'] = 'modularadmin/gastronomias/editGastronomy/$1';
     * @param int $id_gastronomy Id de la gastronomia
     ******************************************************************/

    public function editGastronomy($id_gastronomy = null)
    {
        if ($this->input->post()){

            $response = array();

            try{

                $gastronomias = array();

                if (!empty($this->input->post('inputNombre')))
                    $gastronomias['name'] = $this->input->post('inputNombre');

                $gastronomias['id_province'] = intval($this->input->post('inputProvincia'));

                if (!empty($this->input->post('inputIngredientes')))
                    $gastronomias['ingredients'] = $this->input->post('inputIngredientes');

                if (!empty($this->input->post('inputElaboracion')))
                    $gastronomias['elaboration'] = $this->input->post('inputElaboracion');

                if (!empty($this->input->post('idUser')))
                    $gastronomias['id_admin'] = $this->input->post('idUser');

                if (!empty($this->input->post('valueImage'))){
                    $gastronomias['image_url'] = $this->input->post('valueImage');

                    //La imagen se mueve de la carpeta temporal a su directorio, despues se borran todas las imagenes temporales
                    @rename ("uploads/".$gastronomias['image_url'],"assets/img/gastronomies/".$gastronomias['image_url']);
                    @array_map('unlink', glob("uploads/*"));
                }

                $gastronomias['active'] = $this->input->post('active');
                if ($gastronomias['active'] == "on")
                    $gastronomias['active'] = 1;
                else
                    $gastronomias['active'] = 0;

                $url = $this->utils->eliminar_tildes($gastronomias['name']);
                $url = $this->utils->eliminar_caracteres($url);
                $url = str_replace(' ','-',$url);
                $gastronomias['url'] = strtolower($url);

                $id_gastronomy = $this->input->post('inputIdGastronomia');

                $this->gastronomias->setUpdateGastronomy($id_gastronomy, $gastronomias);

                $this->gastronomias->setNewLog(array(
                    "event_name"=>'Gastronomia Editada',
                    "event_description"=>"Se ha editado la gastronomia con el ID '".$id_gastronomy."'",
                    "event_type"=>"info",
                    "event_ip"=> $this->utils->get_client_ip()
                ));

                $response['response'] = 'success';
                $response['data'] = $gastronomias;
                $response['message'] = "¡Se ha editado la gastronomía!";

            }catch (\Exception $e) {

                $this->gastronomias->setNewLog(array(
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

                    $data['gastronomia'] = $this->gastronomias->getGastronomyId($id_gastronomy);

                    if (count($data['gastronomia'])>0){

                        $data['configuracion'] = json_encode(array_values($data['gastronomia']), JSON_PRETTY_PRINT);

                        $data['gastronomia'] = $data['gastronomia'][0];

                        $data['provincias'] = $this->gastronomias->getAllProvinces();

                        $data['comentarios'] = $this->gastronomias->getGastronomiesComments($id_gastronomy);

                        // Selecciona la vista actual
                        $data['active'] = "gastronomias";
                        $data['user'] = $this->aauth->get_user($this->aauth->get_user_id($email=false));
                        $data['js_to_load'] = 'gastronomias/gastronomyEdit.js';
                        $this->load->view('header',$data);
                        $this->load->view('gastronomias/gastronomiesView',$data);
                        $this->load->view('footer',$data);

                    }
                    else{
                        $protocol = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "https" : "http");
                        $base_url = $protocol . "://" . $_SERVER['HTTP_HOST'];
                        $complete_url =   $base_url . $_SERVER["REQUEST_URI"];
                        redirect($base_url.'/pto-admin/gastronomias');
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
    //	$route['pto-admin/gastronomias/upload_file'] = 'modularadmin/gastronomias/uploadImage';
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

    //******************************************************************
    //	DELETE COMMENT
    //	$route['pto-admin/gastronomias/delete_comment'] = 'modularadmin/gastronomias/deleteComment';
    //******************************************************************
    public function deleteComment(){

        $response = array();

        if (!empty($this->input->post('idComment'))){

            $response['data'] = $this->gastronomias->setDeleteComment($this->input->post('idComment'));

            $response['response'] = 'success';
            $response['message'] = "¡Se ha borrado el comentario!";
            $response['news'] = $this->input->post('idComment');

            $this->gastronomias->setNewLog(array(
                "event_name"=>'Comentario Borrado',
                "event_description"=>"Se ha borrado el comentario de la gastronomía con el ID '".$this->input->post('idComment')."'",
                "event_type"=>"info",
                "event_ip"=> $this->utils->get_client_ip()
            ));

        }
        else{

            $response['response'] = 'error';
            $response['message'] = "¡No se puede borrar el comentario!";
        }


        echo json_encode($response);
    }

}
