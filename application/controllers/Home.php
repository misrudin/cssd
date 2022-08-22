<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{

	public function index()
	{
		$data['title']  = 'Dashboard';
		$data['view']   = 'home/index';

		$this->load->view('lyt/index', $data);
	}
}

/* End of file Home.php */
