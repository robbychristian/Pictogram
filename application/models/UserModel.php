<?php

class UserModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    
    public function registerUser()
    {
        $data = array (
            'first_name' => $this->input->post('fname'),
            'last_name' => $this->input->post('lname'),
            'user_email' => $this->input->post('email'),
            'user_name' => $this->input->post('uname'),
            'user_pass' => $this->input->post('pass'),
            'user_avatar' => 'noimage.jpg',
            'user_status' => '0',
            'user_verification' => hash('md5', 'verification code')
        );
        $this->db->insert('user_accounts', $data);
        return ($data);
    }

    public function validateUser($code)
    {
        $data = array(
            'user_status' => '1'
        );
        $this->db->where('user_verification', $code);
        $this->db->update('user_accounts', $data);
    }

}