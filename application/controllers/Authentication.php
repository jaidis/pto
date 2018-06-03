<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Authentication extends CI_Controller
{

    /**
     * Authentication constructor.
     */
    public function __construct()
    {
        parent::__construct();
        // $this->load->model('AuthenticationModel', 'portal');
        $this->load->library("Aauth");
        $this->load->helper('url');
    }

    public function login()
    {
        if ($this->input->post()) {
            $response = array();
            if (!empty($this->input->post('inputEmail')) && !empty($this->input->post('inputPassword'))){
                $email = $this->input->post('inputEmail');
                $password = $this->input->post('inputPassword');
                ($this->input->post('remember') == "on") ? $remember = true : $remember = false;

                if ($this->aauth->user_exist_by_email($email))
                {
                    if ($this->aauth->login($email, $password, $remember)){
                        $response['response'] = 'success';
                        $response['message'] = "¡ Login correcto !";
                        $response['user'] = $this->aauth->get_user($this->aauth->get_user_id($email));
                    }
                    else{
                        $response['response'] = 'error';
                        $error = $this->aauth->get_errors_array();
                        $response['message'] = '¡ '.$error[0].' !';
                    }
                }
                else{
                    $response['response'] = 'error';
                    $response['message'] = '¡ El correo introducido no es válido !';
                }
            }
            else
            {
                $this->input->post('inputPassword');
                $response['response'] = 'error';
                $response['message'] = "¡ Se ha producido un error !";
            }
            echo json_encode($response);
        }
        else{
            $data = array();
            $data['js_to_load'] = "authentication/login.js";
            $this->load->view('header-clean', $data);
            $this->load->view('authentication/login', $data);
            $this->load->view('footer-clean', $data);
        }

    }

    public function register()
    {
        if ($this->input->post()) {

            $response = array();

            // Aquí se recogen los datos del formulario para añadir un usuario nuevo
            if (!empty($this->input->post('inputNombre') && !empty($this->input->post('inputApellidos')) && !empty($this->input->post('inputEmailRegistro')) && !empty($this->input->post('inputUser')) && !empty($this->input->post('inputPasswordRegistro')))) {
                $respuesta = $this->aauth->create_user(
                    $this->input->post('inputEmailRegistro'),
                    $this->input->post('inputPasswordRegistro'),
                    $this->input->post('inputUser'),
                    $this->input->post('inputNombre'),
                    $this->input->post('inputApellidos')
                    );

                if (!empty($respuesta)){
                    $response['response'] = 'success';
                    $response['message'] = '¡ Registro completado !';
                    $this->aauth->login_fast($respuesta);
                }
                else{
                    $messages = '';
                    foreach ($this->aauth->get_errors_array() as $value) {
                        $messages .= $value.'<br/>';
                    }
                    $response['response'] = 'error';
                    $response['message'] = $messages;
                }
            }

            echo json_encode($response);
        }
        else{
            $data = array();
            $data['js_to_load'] = "authentication/register.js";
            $this->load->view('header-clean', $data);
            $this->load->view('authentication/register', $data);
            $this->load->view('footer-clean', $data);
        }
    }

    public function recover()
    {
        if ($this->input->post()) {
            echo "recover";
        }
        else{
            $data = array();
            $this->load->view('header-clean', $data);
            $this->load->view('authentication/recover', $data);
            $this->load->view('footer-clean', $data);
        }
    }

    public function recoverPassword($token = null)
    {
        if ($this->input->post()) {
            echo $token;
        }
        else{
            $data = array();
            $this->load->view('header-clean', $data);
            $this->load->view('authentication/recover_password', $data);
            $this->load->view('footer-clean', $data);
        }

    }

    public function logout(){
        $this->aauth->logout();
        $protocol = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "https" : "http");
        $base_url = $protocol . "://" . $_SERVER['HTTP_HOST'];
        $complete_url =   $base_url . $_SERVER["REQUEST_URI"];
        redirect($base_url.'/');
    }


}
