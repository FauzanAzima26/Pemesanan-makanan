<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @property MenuModel $MenuModel
 */

class Welcome extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('MenuModel');
	}

	public function index()
	{
		$data['menus'] = $this->MenuModel->get_all();
		$this->load->view('welcome_message', $data);
	}
}
