<?php

class PagesController extends CI_Controller
{
    public function home()
    {
        $this->load->view('layouts/header');
        if (!$this->session->has_userdata('logged_in')) {
            $this->load->view('homepage');
        } else {
            $this->load->view('errors/404');
        }
        $this->load->view('layouts/footer');
    }

    public function register()
    {
        $this->load->view('layouts/header');
        if (!$this->session->has_userdata('logged_in')) {
            $this->load->view('auth/register');
        } else {
            $this->load->view('errors/404');
        }
        $this->load->view('layouts/footer');
    }

    public function login()
    {
        $this->load->view('layouts/header');
        if (!$this->session->has_userdata('logged_in')) {
            $this->load->view('auth/login');
        } else {
            $this->load->view('errors/404');
        }
        $this->load->view('layouts/footer');
    }
}