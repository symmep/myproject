<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class welcome extends CI_Controller {

    public function login()
    {
        $this->load->view('login');
    }
    public function index()
    {
        $this->load->view('student/index');
    }
}
