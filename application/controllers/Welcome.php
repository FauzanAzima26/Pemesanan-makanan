<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @property menuModel $menuModel
 */

class Welcome extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('menuModel');
	}

	public function index()
	{
		$data['menus'] = $this->menuModel->get_all(); // ambil data menu
		$this->load->view('welcome_message', $data);
	}
}
