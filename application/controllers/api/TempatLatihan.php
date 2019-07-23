<?php

defined('BASEPATH') or exit('No direct script access allowed');

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
class TempatLatihan extends REST_Controller
{

    function __construct($config = 'rest')
    {
        // Construct the parent class
        parent::__construct($config);
        $this->load->model('ModelTempatLatihan');
    }

    public function ambilTl_get()
    {
        $data = $this->ModelTempatLatihan->GetTempatLatihan();
        if ($data) {
            $this->set_response($data, REST_Controller::HTTP_OK);
        } else {
            $this->set_response(array('error' => 'Tidak ditemukan data'),  REST_Controller::HTTP_NOT_FOUND);
        }
    }
    public function simpanTl_post()
    {
        $TL = (object) $this->post('body');
        if ($this->ModelTempatLatihan->InsertTempatLatihan($TL)) {
            $this->set_response(array('status' => 'sukses'), REST_Controller::HTTP_CREATED);
        } else {
            $this->set_response(array('error' => 'Error saat simpan data'),  REST_Controller::HTTP_BAD_REQUEST);
        }
    }
    public function updateTl_put()
    {
        $TL = (object) $this->put('body');
        if ($this->ModelTempatLatihan->UpdateTempatLatihan($TL)) {
            $this->set_response(array('status' => 'sukses'), REST_Controller::HTTP_CREATED);
        } else {
            $this->set_response(array('error' => 'Error saat simpan data'),  REST_Controller::HTTP_BAD_REQUEST);
        }
    }
    public function ambilTlDenganId_get($Id)
    {
        $where = array('tempat_latihan.id_tempat_latihan' => $Id);
        $TL = $this->ModelTempatLatihan->GetTempatLatihanById($where)->result();
        if ($TL) {
            $this->set_response($TL[0], REST_Controller::HTTP_CREATED);
        } else {
            $this->set_response(array('error' => 'Tidak ditemukan data'),  REST_Controller::HTTP_NOT_FOUND);
        }
    }
    public function hapusTl_delete($Id)
    {
        $this->ModelTempatLatihan->Delete($Id);
        if ($Id <= 0) {
            $this->response(NULL, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
        }
        $this->set_response(array('status' => 'sukses'), REST_Controller::HTTP_NO_CONTENT); // NO_CONTENT (204) being the HTTP response code
    }
}
