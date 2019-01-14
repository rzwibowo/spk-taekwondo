<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fasilitas extends CI_Controller {
	public function index()
	{
		$pageprop['title'] = "Fasilitas";

		$this->load->view('_layout/v_head', $pageprop);
		$this->load->view('fasilitas/index', $pageprop);
		$this->load->view('_layout/v_foot');
	}
}