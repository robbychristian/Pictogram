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

    public function timeline()
    {
        $this->load->model('PostModel');
        $data['posts'] = $this->PostModel->getPost();
        $this->load->view('layouts/header');
        if ($this->session->has_userdata('logged_in')) {
            $this->load->view('timeline', $data);
        } else {
            $this->load->view('errors/404');
        }
        $this->load->view('layouts/footer');
    }

    public function post()
    {
        $this->load->view('layouts/header');
        if ($this->session->has_userdata('logged_in')) {
            $this->load->view('post');
        } else {
            $this->load->view('errors/404');
        }
        $this->load->view('layouts/footer');
    }

    public function profile($id)
    {
        $this->load->model('PostModel');
        $this->load->model('UserModel');
        $this->load->view('layouts/header');
        if ($this->session->has_userdata('logged_in')) {
            $data['user'] = $this->UserModel->getUserProfile($id);
            $data['posts'] = $this->PostModel->getUserPost($id);
            $this->load->view('profile', $data);
        } else {
            $this->load->view('errors/404');
        }
        $this->load->view('layouts/footer');
    }

    public function edit()
    {
        $this->load->model('UserModel');
        $this->load->view('layouts/header');
        if ($this->session->has_userdata('logged_in')) {
            $data['user'] = $this->UserModel->getUser($_SESSION['uname'], $_SESSION['pass']);
            $this->load->view('edit', $data);
        } else {
            $this->load->view('errors/404');
        }
        $this->load->view('layouts/footer');
    }
}