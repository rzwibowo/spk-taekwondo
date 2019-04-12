<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	public function index()
	{
		$this->load->view('login/index');
	}
	// public function logout()
	// {

	// 	$this->load->view('_layout/v_headLogin');
	// 	$this->load->view('login/logout');
	// 	$this->load->view('_layout/v_footLogin');

	// }
}