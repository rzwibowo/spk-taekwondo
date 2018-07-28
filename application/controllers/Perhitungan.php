<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Perhitungan extends CI_Controller {
	public function index()
	{
		$pageprop['title'] = "Perhitungan";

		$this->load->view('_layout/v_head', $pageprop);
		$this->load->view('perhitungan/index');
		$this->load->view('_layout/v_foot');
	}
}