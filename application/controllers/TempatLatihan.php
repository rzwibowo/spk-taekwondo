<?php
defined('BASEPATH') or exit('No direct script access allowed');

class TempatLatihan extends CI_Controller
{
	public function index()
	{
		$pageprop['title'] = "Tempat Latihan";

		$this->load->view('_layout/v_head', $pageprop);
		$this->load->view('tempatlatihan/index', $pageprop);
		$this->load->view('_layout/v_foot');
	}
}
