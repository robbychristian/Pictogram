<?php

class PostController extends CI_Controller
{
    public function create()
    {
        $this->load->model('PostModel');
        $this->form_validation->set_rules('postbody', 'Caption', 'max_length[255]');
        if (empty($_FILES['userfile']['name'])) {
            $this->form_validation->set_rules('userfile', 'Image', 'required');
        }
        if ($this->form_validation->run() == false) {
            $this->load->view('layouts/header');
            $this->load->view('post');
            $this->load->view('layouts/footer');
        } else {
            $config['upload_path'] = './assets/post/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = '2048';
            $config['max_width'] = '0';
            $config['max_height'] = '0';
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload()) {
                $errors = array('error' => $this->upload->display_errors());
                $postImg = 'noimage.jpg';
            } else {
                $data = array('upload_data' => $this->upload->data());
                $postImg = $_FILES['userfile']['name'];
                $this->PostModel->addPost($_SESSION['uname'], $postImg, $_SESSION['id']);
                redirect('timeline');
            }
        }
    }

    public function view()
    {
        $this->load->model('PostModel');
        $data['posts'] = $this->PostModel->getPost();
        $this->load->view('layouts/header');
        $this->load->view('timeline', $data);
        $this->load->view('layouts/footer');
    }

    public function delete($post_id, $user_id)
    {
        $this->load->model('PostModel');
        $this->PostModel->deletePost($post_id);
        redirect('profile/'.$user_id);
    }
}
