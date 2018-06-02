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
//        $this->load->model('AuthenticationModel', 'portal');
        $this->load->helper('url');
        $this->load->library("Aauth");
    }

    public function login()
    {
        if ($this->input->post()) {
            echo "login";
        }
        else{
            $data = array();
            $this->load->view('header-clean', $data);
            $this->load->view('authentication/login', $data);
            $this->load->view('footer-clean', $data);
        }

    }

    public function register()
    {
        if ($this->input->post()) {
            echo "register";
//            $this->aauth->create_user();
        }
        else{
            $data = array();
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

    public function logout()
    {
        $data = array();
        $this->load->view('header-clean', $data);
        $this->load->view('authentication/logout', $data);
        $this->load->view('footer-clean', $data);
    }


}
