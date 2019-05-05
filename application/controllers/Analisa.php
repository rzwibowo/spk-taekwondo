<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Analisa extends CI_Controller {
	
	public function kriteria()
	{
		$pageprop['title'] = "Keritera";

		$this->load->view('_layout/v_head', $pageprop);
		$this->load->view('analisa/kriteria', $pageprop);
		$this->load->view('_layout/v_foot');
	}
}