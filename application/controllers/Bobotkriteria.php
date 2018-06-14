<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mahasiswa extends CI_Controller {
	public function index()
	{
		$pageprop['title'] = "Data Mahasiswa";

		$this->load->view('_layout/v_head', $pageprop);
		$this->load->view('mahasiswa/index');
		$this->load->view('_layout/v_foot');
	}
}