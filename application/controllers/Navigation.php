<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Navigation extends CI_Controller {
	public function Mahasiswa()
	{
		$pageprop['title'] = "Data Mahasiswa";

		$this->load->view('_layout/v_head', $pageprop);
		$this->load->view('mahasiswa/index');
		$this->load->view('_layout/v_foot');
	}
}