<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MX_Controller {


    /*******************************************************************
     * Home constructor
     ******************************************************************/
    public function __construct()
    {
        parent::__construct();
        $this->load->model('HomeModel','home');
        $this->load->library("Aauth");
        $this->load->library("Utils");
        $this->load->helper('url');
    }

    /*******************************************************************
     * PÁGINA DE INICIO PARA EL HOME
     * $route['pto-admin'] = 'modularadmin/home/index';
     ******************************************************************/

    public function index()
	{
	    $data = array();
        if ( $this->aauth->is_loggedin() ){

            // Recuperamos los permisos de los grupos
            list($data['ver'], $data['añadir'], $data['editar'], $data['borrar'], $data['admin']) = $this->utils->permisos($this->aauth);

            if (!empty($data['ver']) && $data['ver'] == 1){

                // Selecciona la vista actual
                $data['active'] = "home";
                $data['user'] = $this->aauth->get_user($this->aauth->get_user_id($email=false));
                $this->load->view('header',$data);
                $this->load->view('home/index',$data);
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

    /*******************************************************************
     * PÁGINA PARA MOSTRAR LA VISTA DE LOS PERMISOS
     * CAPTA LOS DATOS DEL FORMULARIO PARA UN NUEVO USUARIO
     * CAPTA LOS DATOS DEL FORMULARIO PARA UN NUEVO GRUPO
     * CAPTA LOS DATOS PARA MODIFICAR LOS PERMISOS DE UN GRUPO
     * $route['pto-admin/permisos'] = 'modularadmin/home/permisos';
     ******************************************************************/

    public function permisos(){
        if ($this->input->post()){
            $response = array();

            // Aquí se recogen los datos del formulario para añadir un usuario nuevo
            if (!empty($this->input->post('inputNewUser') && !empty($this->input->post('inputEmail')) && !empty($this->input->post('inputPassword')) && !empty($this->input->post('inputUsuario')) && !empty($this->input->post('inputFirstName')) && !empty($this->input->post('inputLastName')))) {

                $respuesta = $this->aauth->create_user(
                    $this->input->post('inputEmail'),
                    $this->input->post('inputPassword'),
                    $this->input->post('inputUsuario'),
                    $this->input->post('inputFirstName'),
                    $this->input->post('inputLastName'),
                    'user.png'
                );

                if (!empty($respuesta)){
                    $response['response'] = 'success';
                    $response['message'] = '¡ El usuario se ha guardado correctamente !';
                    if (!empty($this->input->post('inputGroup')) && $this->input->post('inputGroup') != "Default")
                        $this->aauth->add_member($respuesta, $this->input->post('inputGroup'));
                }
                else{
                    $messages = '';
                    foreach ($this->aauth->get_errors_array() as $value) {
                        $messages .= $value;
                    }
                    $response['response'] = 'error';
                    $response['message'] = $messages;
                }
            }

            // Aquí se recogen los datos del formulario para añadir un nuevo grupo
            if (!empty($this->input->post('inputNewGroup') && !empty($this->input->post('inputGroup')) && !empty($this->input->post('inputGroupDescription')))) {
                $respuesta = $this->aauth->create_group($this->input->post('inputGroup'), $this->input->post('inputGroupDescription'));

                // Se supone que $respuesta debería contener la id del nuevo grupo o lanzar un error de que existe un grupo con ese mismo nombre.
                // Revisando dicha función devuelve esos parámetros, pero por algún tipo de bug no se lanza el mensaje de que existe un grupo
                // Por lo tanto si el tipo que devuelve es un entero se muestra como correcto o sino se devolverá el error.
                if (gettype($respuesta) == "integer"){

                    if ($this->input->post('ver') == "on")
                        $this->aauth->allow_group($this->input->post('inputGroup'), 'ver');

                    if ($this->input->post('añadir') == "on")
                        $this->aauth->allow_group($this->input->post('inputGroup'), 'añadir');

                    if ($this->input->post('editar') == "on")
                        $this->aauth->allow_group($this->input->post('inputGroup'), 'editar');

                    if ($this->input->post('borrar') == "on")
                        $this->aauth->allow_group($this->input->post('inputGroup'), 'borrar');

                    $response['response'] = 'success';
                    $response['message'] = '¡ El grupo se ha guardado correctamente !';
                }
                else{
                    $response['response'] = 'error';
                    $response['message'] = '¡ Se ha producido un error al crear el grupo !';
                }
            }

            // Aquí se recoge si un usuario se marca como baneado o sin banear
            if (!empty($this->input->post('casilla_marcada')) && !empty($this->input->post('id_usuario'))){
                if ($this->input->post('casilla_marcada') == "true"){
                    $this->aauth->ban_user($this->input->post('id_usuario'));
                    $response['response'] = 'success';
                    $response['message'] = '¡ Se ha baneado al usuario !';
                }
                else{
                    $this->aauth->unban_user($this->input->post('id_usuario'));
                    $response['response'] = 'success';
                    $response['message'] = '¡ Se ha quitado el baneado !';
                }
            }

            // Petición para eliminar un usuario
            if (!empty($this->input->post('idUser'))){

                $this->aauth->delete_user($this->input->post('idUser'));

                $response['response'] = 'success';
                $response['message'] = '¡ Se ha eliminado al usuario !';
            }

            // Aquí se recogen si los permisos de los grupos para añadir o quitar un permiso
            if (!empty($this->input->post('casilla_marcada')) && !empty($this->input->post('grupo')) && !empty($this->input->post('permiso'))){
                if ($this->input->post('casilla_marcada') == "true"){
                    $this->aauth->allow_group($this->input->post('grupo'), $this->input->post('permiso'));
                    $response['response'] = 'success';
                    $response['message'] = 'Se ha activado el permiso';
                }
                else{
                    $this->aauth->deny_group($this->input->post('grupo'), $this->input->post('permiso'));
                    $response['response'] = 'success';
                    $response['message'] = 'Se ha desactivado el permiso';
                }
            }

            // Petición para eliminar un grupo
            if (!empty($this->input->post('idGroup'))){

                $this->aauth->delete_group($this->input->post('idGroup'));

                $response['response'] = 'success';
                $response['message'] = '¡ Se ha eliminado el grupo !';
            }

            echo json_encode($response);
        }
        else{
            $data = array();
            if ( $this->aauth->is_loggedin() ){

                // Recuperamos los permisos de los grupos
                list($data['ver'], $data['añadir'], $data['editar'], $data['borrar'], $data['admin']) = $this->utils->permisos($this->aauth);

                if (!empty($data['admin']) && $data['admin'] == 1){

                    $data['grupos'] = $this->aauth->list_groups();
                    $data['permisos'] = $this->utils->permisos_grupos($this->aauth);
                    $data['usuarios'] = $this->aauth->list_users(false,false,false,true);
                    $data['usuarios_grupos'] = $this->utils->usuarios_grupos($this->aauth, $data['usuarios']);

                    // Selecciona la vista actual
                    $data['active'] = "configuracion";
                    $data['user'] = $this->aauth->get_user($this->aauth->get_user_id($email=false));

                    // Se añade el archivo javascript asociado a la vista
                    $data['js_to_load']="home/permisos.js";

                    // Carga la vista
                    $this->load->view('header', $data);
                    $this->load->view('home/permisos', $data);
                    $this->load->view('footer', $data);

                }else{
                    $protocol = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "https" : "http");
                    $base_url = $protocol . "://" . $_SERVER['HTTP_HOST'];
                    $complete_url =   $base_url . $_SERVER["REQUEST_URI"];
                    redirect($base_url.'/home');
                }
            } else {
                $protocol = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "https" : "http");
                $base_url = $protocol . "://" . $_SERVER['HTTP_HOST'];
                $complete_url = $base_url . $_SERVER["REQUEST_URI"];
                redirect($base_url.'/login?url='.substr($_SERVER["REQUEST_URI"],1));
            }
        }
    }
}
