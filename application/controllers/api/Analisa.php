<?php

defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
/** @noinspection PhpIncludeInspection */
require APPPATH . '/libraries/REST_Controller.php';

// use namespace
use Restserver\Libraries\REST_Controller;

/**
 * This is an example of a few basic user interaction methods you could use
 * all done with a hardcoded array
 *
 * @package         CodeIgniter
 * @subpackage      Rest Server
 * @category        Controller
 * @author          Phil Sturgeon, Chris Kacerguis
 * @license         MIT
 * @link            https://github.com/chriskacerguis/codeigniter-restserver
 */
class Analisa extends REST_Controller {

    function __construct($config = 'rest')
    {
        // Construct the parent class
        parent::__construct($config);
        $this->load->model('ModelAnalisa');

    }

    public function buatAnalisaKriteria_get()
    {
        $data = $this->ModelAnalisa->GetAnalisaKriteria();
        if ($data) {
            $this->set_response($data, REST_Controller::HTTP_OK);
        } else {
            $this->set_response(array('error' => 'Tidak ditemukan data'),  REST_Controller::HTTP_NOT_FOUND);
        }
    }
    public function hitungMatrixPerbandingan_post()
    {
        $post = json_decode(file_get_contents('php://input'), TRUE)["body"];
        $data = $this->ModelAnalisa->hitungMatrixPerbandinganKeriteria($post);
        if ($data) {
            $this->set_response($data, REST_Controller::HTTP_OK);
        } else {
            $this->set_response(array('error' => 'Terjadi kesalahan'),  REST_Controller::HTTP_NOT_FOUND);
        }
    }
    public function saveAnalisisKriteria_post(){

         $post = json_decode(file_get_contents('php://input'), TRUE)["body"];

        $this->ModelAnalisa->saveAnalisisKriteria($post);
        
    }

    public function ambilListAnalisis_get()
    {
        $data = $this->ModelAnalisa->getListAnalisisKriteria()->result();
        if ($data) {
            $this->set_response($data, REST_Controller::HTTP_OK);
        } else {
            $this->set_response(array('error' => 'Tidak ditemukan data'),  REST_Controller::HTTP_NOT_FOUND);
        }
    }

}
