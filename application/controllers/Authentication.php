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
    }

    public function login()
    {
        $data = array();
        $this->load->view('header-clean', $data);
        $this->load->view('authentication/login', $data);
        $this->load->view('footer-clean', $data);
    }

    public function register()
    {
        $data = array();
        $this->load->view('header-clean', $data);
        $this->load->view('authentication/register', $data);
        $this->load->view('footer-clean', $data);
    }

    public function recover()
    {
        $data = array();
        $this->load->view('header-clean', $data);
        $this->load->view('authentication/recover', $data);
        $this->load->view('footer-clean', $data);
    }

    public function recoverPassword()
    {
        $data = array();
        $this->load->view('header-clean', $data);
        $this->load->view('authentication/recover_password', $data);
        $this->load->view('footer-clean', $data);
    }

    public function logout()
    {
        $data = array();
        $this->load->view('header-clean', $data);
        $this->load->view('authentication/logout', $data);
        $this->load->view('footer-clean', $data);
    }


}
