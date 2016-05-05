<?php

class Upload extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper(array('form', 'url'));
    }

    function index()
    {
        $data['username'] = $this->session->userdata['logged_in']['username'];
        $data['error'] = ' ';

        $this->load->view('commons/header', $data);
        $this->load->view('upload_form',$data);
        $this->load->view('commons/footer');
    }

    function do_upload()
    {
        $this->load->library('upload');

        $files = $_FILES;
        $cpt = count($_FILES['userfile']['name']);
        for($i=0; $i<$cpt; $i++)
        {
            $_FILES['userfile']['name']= $files['userfile']['name'][$i];
            $_FILES['userfile']['type']= $files['userfile']['type'][$i];
            $_FILES['userfile']['tmp_name']= $files['userfile']['tmp_name'][$i];
            $_FILES['userfile']['error']= $files['userfile']['error'][$i];
            $_FILES['userfile']['size']= $files['userfile']['size'][$i];

            $this->upload->initialize($this->set_upload_options());
            $this->upload->do_upload();
        }
    }

    private function set_upload_options()
    {
        //upload an image options
        $config = array();
        $config['upload_path'] = '/Applications/XAMPP/xamppfiles/htdocs/CodeIgniter-3.0.2/uploads/';

        /*switch (userfile[$i]) {
            case 1:
            case 2:
            case 3:
                $config['allowed_types'] = 'gif|jpg|png';
                break;
            case 4:
                $config['allowed_types'] = 'mp4';
                break;
            case 5:
                $config['allowed_types'] = 'pdf';
                break;
        }*/

        if($this->userfile[0])
        {
            $config['allowed_types'] = 'gif|jpg|png';
        }
        if($this->userfile[1])
        {
            $config['allowed_types'] = 'gif|jpg|png';
        }
        if($this->userfile[2])
        {
            $config['allowed_types'] = 'gif|jpg|png';
        }
        if($this->userfile[3])
        {
            $config['allowed_types'] = 'mp4';
        }
        if($this->userfile[4])
        {
            $config['allowed_types'] = 'pdf';
        }

        //$config['max_size']      = '0';
        $config['overwrite']     = FALSE;

        return $config;
    }
}
?>