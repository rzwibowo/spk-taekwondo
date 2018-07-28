<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TahunAngkatan extends CI_Controller {
	public function index()
	{
		$pageprop['title'] = "Tahun Angkatan";

		$this->load->view('_layout/v_head', $pageprop);
		$this->load->view('tahunAngkatan/index', $pageprop);
		$this->load->view('_layout/v_foot');
	}
}