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
class Jarak extends REST_Controller {

    function __construct($config = 'rest')
    {
        // Construct the parent class
        parent::__construct($config);
        $this->load->model('ModelJarak');

    }

    public function ambilJrk_get()
    {
        $data = $this->ModelJarak->GetJarak()->result();
        if ($data) {
            $this->set_response($data, REST_Controller::HTTP_OK);
        } else {
            $this->set_response(array('error' => 'Tidak ditemukan data'),  REST_Controller::HTTP_NOT_FOUND);
        }
    }
    public function simpanJrk_post()
    {
        $Jrk = (object) $this->post('body');
        if ($this->ModelJarak->InsertJarak($Jrk)) {
            $this->set_response(array('status' => 'sukses'), REST_Controller::HTTP_CREATED);
        } else {
            $this->set_response(array('error' => 'Error saat simpan data'),  REST_Controller::HTTP_BAD_REQUEST);
        }
    }
    public function updateJrk_put()
    {
        $Jrk = (object) $this->put('body');
        if ($this->ModelJarak->UpdateJarak($Jrk)){
            $this->set_response(array('status' => 'sukses'), REST_Controller::HTTP_CREATED);
        } else {
            $this->set_response(array('error' => 'Error saat simpan data'),  REST_Controller::HTTP_BAD_REQUEST);
        }
    }
    public function ambilJrkDenganId_get($Id)
    {
        # code...
        $where = array('detail_kriteria.id_detail_kriteria'=>$Id);
        $Jrk = $this->ModelJarak->GetJarakById($where)->result();
        if ($Jrk) {
            $this->set_response($Jrk[0], REST_Controller::HTTP_CREATED);
        } else {
            $this->set_response(array('error' => 'Tidak ditemukan data'),  REST_Controller::HTTP_NOT_FOUND);
        }
    }
    public function hapusJrk_delete($Id)
    {
        $this->ModelJarak->Delete($Id);
        if ($Id <= 0)
        {
            $this->response(NULL, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
        }
        $this->set_response(array('status' => 'sukses'), REST_Controller::HTTP_NO_CONTENT); // NO_CONTENT (204) being the HTTP response code
    }

}
