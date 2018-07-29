<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kriteria extends CI_Controller {
	public function index()
	{
		$pageprop['title'] = "Data Kriteria";

		$this->load->view('_layout/v_head', $pageprop);
		$this->load->view('kriteria/index', $pageprop);
		$this->load->view('_layout/v_foot');
	}
}