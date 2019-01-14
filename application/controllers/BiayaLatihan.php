<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BiayaLatihan extends CI_Controller {
	public function index()
	{
		$pageprop['title'] = "Biaya Latihan";

		$this->load->view('_layout/v_head', $pageprop);
		$this->load->view('biayalatihan/index', $pageprop);
		$this->load->view('_layout/v_foot');
	}
}