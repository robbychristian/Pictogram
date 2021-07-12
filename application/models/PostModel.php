<?php

class PostModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function addPost($uname, $postimg)
    {
        $data = array(
            'post_user' => $uname,
            'post_caption' => $this->input->post('postbody'),
            'post_img' => $postimg,
            'created_at' => date("Y-m-d H:i:s")
        );
        $this->db->insert('user_posts', $data);
        return true;
    }

    public function getPost()
    {
        $this->db->select('post_user');
        $this->db->select('post_caption');
        $this->db->select('post_img');
        $this->db->select('created_at');
        $this->db->select('user_avatar');
        $this->db->from('user_posts a');
        $this->db->join('user_accounts b', 'a.post_user=b.user_name', 'right');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
    }
}
