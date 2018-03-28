<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function login()
	{
		redirect('welcome/index');
	}
    public function index()
    {
        $this->load->view('login');
    }
}
