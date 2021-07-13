<?php

class PostModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function addPost($uname, $postimg, $id)
    {
        $data = array(
            'user_id' => $id,
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
        $this->db->select('user_id');
        $this->db->select('post_caption');
        $this->db->select('post_img');
        $this->db->select('created_at');
        $this->db->select('user_avatar');
        $this->db->select('first_name');
        $this->db->select('last_name');
        $this->db->from('user_posts a');
        $this->db->join('user_accounts b', 'a.post_user=b.user_name', 'inner');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
    }

    public function getUserPost($id)
    {
        $where = 'user_id = "'.$id.'"';
        $this->db->select('id');
        $this->db->select('post_user');
        $this->db->select('post_caption');
        $this->db->select('post_img');
        $this->db->select('created_at');
        $this->db->where($where);
        $this->db->from('user_posts');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
    }

    public function deletePost($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('user_posts');
    }
}
