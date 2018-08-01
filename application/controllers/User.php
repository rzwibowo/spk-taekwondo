<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
	public function index()
	{
		$pageprop['title'] = "User";

		$this->load->view('_layout/v_head', $pageprop);
		$this->load->view('user/index', $pageprop);
		$this->load->view('_layout/v_foot');
	}
}