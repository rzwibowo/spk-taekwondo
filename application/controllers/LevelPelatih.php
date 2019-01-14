<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LevelPelatih extends CI_Controller {
	public function index()
	{
		$pageprop['title'] = "Level Pelatih";

		$this->load->view('_layout/v_head', $pageprop);
		$this->load->view('levelpelatih/index', $pageprop);
		$this->load->view('_layout/v_foot');
	}
}