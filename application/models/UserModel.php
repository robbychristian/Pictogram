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
        $data = array(
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

    public function getUser($uname, $pass)
    {
        $this->db->where('user_name', $uname);
        $this->db->where('user_pass', $pass);
        $query = $this->db->get('user_accounts');
        if ($query->num_rows() > 0) {
            $data = $query->result_array();
            return $data;
        } else {
            return false;
        }
    }

    public function getUserProfile($id)
    {
        $this->db->select("*");
        $this->db->where('id', $id);
        $this->db->from('user_accounts');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $data = $query->result_array();
            return $data;
        } else {
            return false;
        }
    }

    public function editUser($id, $img)
    {
        $data = array (
            'first_name' => $this->input->post('fname'),
            'last_name' => $this->input->post('lname'),
            'user_pass' => $this->input->post('newPass'),
            'user_avatar' => $this->input->post('userfile')
        );
        $this->db->where('id', $id);
        $this->db->update('user_accounts', $data);
    }
}
