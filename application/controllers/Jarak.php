<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jarak extends CI_Controller {
	public function index()
	{
		$pageprop['title'] = "Jarak";

		$this->load->view('_layout/v_head', $pageprop);
		$this->load->view('jarak/index', $pageprop);
		$this->load->view('_layout/v_foot');
	}
}