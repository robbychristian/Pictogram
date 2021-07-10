<?php

class PagesController extends CI_Controller
{
    public function home()
    {
        $this->load->view('layouts/header');
        $this->load->view('homepage');
        $this->load->view('layouts/footer');
    }

    public function register()
    {
        $this->load->view('layouts/header');
        $this->load->view('register');
        $this->load->view('layouts/footer');
    }

    public function login()
    {
        $this->load->view('layouts/header');
        $this->load->view('login');
        $this->load->view('layouts/footer');
    }
}