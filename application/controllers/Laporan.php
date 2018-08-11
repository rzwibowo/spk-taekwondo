<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller {
	public function index()
	{
		$pageprop['title'] = "Laporan";

		$this->load->view('_layout/v_head', $pageprop);
		$this->load->view('laporan/index', $pageprop);
		$this->load->view('_layout/v_foot');
	}
}