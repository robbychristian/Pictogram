<?php
class UserController extends CI_Controller
{
    public function create()
    {
        $this->load->model('UserModel');
        $this->form_validation->set_rules('fname', "First Name", 'required');
        $this->form_validation->set_rules('lname', "Last Name", 'required');
        $this->form_validation->set_rules('email', "Email", 'required|is_unique[user_accounts.user_email]');
        $this->form_validation->set_rules('uname', "Username", 'required|is_unique[user_accounts.user_name]');
        $this->form_validation->set_rules('pass', "Password", 'required|min_length[6]');
        $this->form_validation->set_rules('cpass', "Confirm Password", 'required|matches[pass]');
        if ($this->form_validation->run() == false) {
            $this->load->view('layouts/header');
            $this->load->view('auth/register');
            $this->load->view('layouts/footer');
        } else {
            $newUser = $this->UserModel->registerUser();
            $config['protocol']    = 'smtp';
            $config['smtp_host']    = 'ssl://smtp.gmail.com';
            $config['smtp_port']    = '465';
            $config['smtp_timeout'] = '7';
            $config['smtp_user']    = 'accounydummy001@gmail.com';
            $config['smtp_pass']    = 'slark022';
            $config['charset']    = 'utf-8';
            $config['newline']    = "\r\n";
            $config['mailtype'] = 'html'; // or html
            $config['validation'] = TRUE; // bool whether to validate email or not      
            $this->email->initialize($config);
            $this->email->from('accounydummy001@gmail.com', 'Pixel Team');
            $this->email->to($newUser['user_email']);
            $this->email->subject('Email verification');
            $this->email->message('Your validation code is <a href="http://localhost/pictogram/index.php/UserController/verify/'.$newUser['user_verification'].'">'.$newUser['user_verification'].'</a>');
            $this->email->send();
            $this->load->view('layouts/header');
            $this->load->view('auth/unverified');
            $this->load->view('layouts/footer');
        }
    }

    public function verify($code)
    {
        $this->load->model('UserModel');
        $this->UserModel->validateUser($code);
        $this->load->view('auth/verified');
    }
}
