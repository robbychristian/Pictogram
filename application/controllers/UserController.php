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
                $data['error'] = '  <div class="alert position-sticky alert-danger alert-dismissible fade show" style="width:98vh;" role="alert">
                                        <strong>User credential doesn\'t exist!</strong> Try again.
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>';
                $this->load->view('layouts/header');
                $this->load->view('auth/login', $data);
                $this->load->view('layouts/footer');
            } else {
                $result = $user[0];
                if ($result['user_status'] != '1') {
                    $this->load->view('layouts/header');
                    $this->load->view('auth/unverified');
                    $this->load->view('layouts/footer');
                } else {
                    $userdata = array(
                        'id' => $result['id'],
                        'fname' => $result['first_name'],
                        'lname' => $result['last_name'],
                        'email' => $result['user_email'],
                        'uname' => $result['user_name'],
                        'pass' => $result['user_pass'],
                        'avatar' => $result['user_avatar'],
                        'logged_in' => true
                    );
                    $this->session->set_userdata($userdata);
                    redirect('timeline');
                }
            }
        }
    }

    public function edit($id)
    {
        $this->load->model('UserModel');
        $this->form_validation->set_rules('fname', 'First Name', 'required');
        $this->form_validation->set_rules('lname', 'Last Name', 'required');
        $this->form_validation->set_rules(
            'currPass',
            'Current Password',
            array(
                'required',
                array(
                    'pass_mismatch',
                    function () {
                        if ($this->input->post('currPass') !== $_SESSION['pass']) {
                            return false;
                        } else {
                            return true;
                        }
                    }
                )
            ),
            array(
                'pass_mismatch' => 'Current password field is incorrect.'
            )
        );
        $this->form_validation->set_rules('newPass', 'New Password', 'required|min_length[6]');
        $this->form_validation->set_rules('ConfPass', 'Confirm Password', 'required|matches[newPass]');
        if ($this->form_validation->run() == false) {
            $data['user'] = $this->UserModel->getUser($_SESSION['uname'], $_SESSION['pass']);
            $this->load->view('layouts/header');
            $this->load->view('edit', $data);
            $this->load->view('layouts/footer');
        } else {
            $config['upload_path'] = './assets/avatar/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = '2048';
            $config['max_width'] = '0';
            $config['max_height'] = '0';
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload()) {
                $errors = array('error' => $this->upload->display_errors());
                $postImg = 'noimage.jpg';
                $this->UserModel->editUser($id, $postImg);
                $result = $this->UserModel->getUserProfile($id);
                $res = $result[0];
                unset(
                    $_SESSION['id'],
                    $_SESSION['fname'],
                    $_SESSION['lname'],
                    $_SESSION['email'],
                    $_SESSION['uname'],
                    $_SESSION['pass'],
                    $_SESSION['avatar'],
                    $_SESSION['logged_in']
                );
                $userdata = array(
                    'id' => $res['id'],
                    'fname' => $res['first_name'],
                    'lname' => $res['last_name'],
                    'email' => $res['user_email'],
                    'uname' => $res['user_name'],
                    'pass' => $res['user_pass'],
                    'avatar' => $res['user_avatar'],
                    'logged_in' => true
                );
                $this->session->set_userdata($userdata);
                $this->UserModel->editUser($id, $postImg);
                redirect('profile/' . $id);
            } else {
                if ($_FILES['userfile']['size'] == 0) {
                    $postImg = 'noimage.jpg';
                    $this->UserModel->editUser($id, $postImg);
                    $result = $this->UserModel->getUserProfile($id);
                    $res = $result[0];
                    unset(
                        $_SESSION['id'],
                        $_SESSION['fname'],
                        $_SESSION['lname'],
                        $_SESSION['email'],
                        $_SESSION['uname'],
                        $_SESSION['pass'],
                        $_SESSION['avatar'],
                        $_SESSION['logged_in']
                    );
                    $userdata = array(
                        'id' => $res['id'],
                        'fname' => $res['first_name'],
                        'lname' => $res['last_name'],
                        'email' => $res['user_email'],
                        'uname' => $res['user_name'],
                        'pass' => $res['user_pass'],
                        'avatar' => $res['user_avatar'],
                        'logged_in' => true
                    );
                    $this->session->set_userdata($userdata);
                    $this->UserModel->editUser($id, $postImg);
                    redirect('profile/' . $id);
                } else {
                    $postImg = $_FILES['userfile']['name'];
                    $this->UserModel->editUser($id, $postImg);
                    $result = $this->UserModel->getUserProfile($id);
                    $res = $result[0];
                    unset(
                        $_SESSION['id'],
                        $_SESSION['fname'],
                        $_SESSION['lname'],
                        $_SESSION['email'],
                        $_SESSION['uname'],
                        $_SESSION['pass'],
                        $_SESSION['avatar'],
                        $_SESSION['logged_in']
                    );
                    $userdata = array(
                        'id' => $res['id'],
                        'fname' => $res['first_name'],
                        'lname' => $res['last_name'],
                        'email' => $res['user_email'],
                        'uname' => $res['user_name'],
                        'pass' => $res['user_pass'],
                        'avatar' => $res['user_avatar'],
                        'logged_in' => true
                    );
                    $this->session->set_userdata($userdata);
                    $this->UserModel->editUser($id, $postImg);
                    redirect('profile/' . $id);
                }
            }
        }
    }

    public function logout()
    {
        unset(
            $_SESSION['id'],
            $_SESSION['fname'],
            $_SESSION['lname'],
            $_SESSION['email'],
            $_SESSION['uname'],
            $_SESSION['pass'],
            $_SESSION['avatar'],
            $_SESSION['logged_in']
        );
        redirect('login');
    }
}
