<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PrestasiAnggota extends CI_Controller {
	public function index()
	{
		$pageprop['title'] = "Prestasi Anggota";

		$this->load->view('_layout/v_head', $pageprop);
		$this->load->view('prestasianggota/index', $pageprop);
		$this->load->view('_layout/v_foot');
	}
}