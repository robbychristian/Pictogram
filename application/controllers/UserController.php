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
            $config['mailtype'] = 'html';
            $config['validation'] = TRUE;
            $this->email->initialize($config);
            $this->email->from('accounydummy001@gmail.com', 'Pixel Team');
            $this->email->to($newUser['user_email']);
            $this->email->subject('Email verification');
            $this->email->message('Your validation code is <a href="http://localhost/pictogram/index.php/UserController/verify/' . $newUser['user_verification'] . '">' . $newUser['user_verification'] . '</a>');
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

    public function login()
    {
        $this->load->model('UserModel');
        $this->form_validation->set_rules('uname', 'Username', 'required');
        $this->form_validation->set_rules('pass', 'Password', 'required');
        if ($this->form_validation->run() == false) {
            $this->load->view('layouts/header');
            $this->load->view('auth/login');
            $this->load->view('layouts/footer');
        } else {
            $uname = $this->input->post('uname');
            $pass = $this->input->post('pass');
            $user = $this->UserModel->getUser($uname, $pass);
            if ($user == false) {
                echo "No user";
            } else {
                $result = $user[0];
                if ($result['user_status'] != '1') {
                    $this->load->view('layouts/header');
                    $this->load->view('auth/unverified');
                    $this->load->view('layouts/footer');
                } else {
                    $userdata = array(
                        'fname' => $result['first_name'],
                        'lname' => $result['last_name'],
                        'email' => $result['user_email'],
                        'uname' => $result['user_name'],
                        'pass' => $result['user_pass'],
                        'avatar' => $result['user_avatar'],
                        'logged_in' => true
                    );
                    $this->session->set_userdata($userdata);
                    echo $_SESSION['fname'];
                }
            }
        }
    }

    public function logout()
    {
        unset(
            $_SESSION['fname'],
            $_SESSION['lname'],
            $_SESSION['email'],
            $_SESSION['uname'],
            $_SESSION['pass'],
            $_SESSION['avatar'],
            $_SESSION['logged_in']
        );
        redirect('home');
    }
}
