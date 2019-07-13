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

	public function alternatif_input()
	{
		$pageprop['title'] = "Input Nilai Alternatif";

		$this->load->view('_layout/v_head', $pageprop);
		$this->load->view('analisis/alternatif-input', $pageprop);
		$this->load->view('_layout/v_foot');
	}

	public function alternatif_hitung()
	{
		$pageprop['title'] = "Hitung Perbandingan Alternatif";

		$this->load->view('_layout/v_head', $pageprop);
		$this->load->view('analisis/alternatif-hitung', $pageprop);
		$this->load->view('_layout/v_foot');
	}

	public function hasil_peringkat()
	{
		$pageprop['title'] = "Hasil Pemeringkatan";

		$this->load->view('_layout/v_head', $pageprop);
		$this->load->view('analisis/hasil-peringkat', $pageprop);
		$this->load->view('_layout/v_foot');
	}
}