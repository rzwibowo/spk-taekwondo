<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Analisis extends CI_Controller {
	
	public function kriteria()
	{
		$pageprop['title'] = "Perbandingan Kriteria";

		$this->load->view('_layout/v_head', $pageprop);
		$this->load->view('analisis/kriteria', $pageprop);
		$this->load->view('_layout/v_foot');
	}

	public function alternatif()
	{
		$pageprop['title'] = "Perbandingan Alternatif";

		$this->load->view('_layout/v_head', $pageprop);
		$this->load->view('analisis/alternatif', $pageprop);
		$this->load->view('_layout/v_foot');
	}
}