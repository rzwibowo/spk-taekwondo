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
class Kriteria extends REST_Controller
{

    function __construct($config = 'rest')
    {
        // Construct the parent class
        parent::__construct($config);
        $this->load->model('ModelKriteria');
    }

    public function ambilKrt_get()
    {
        $data = $this->ModelKriteria->GetKriteria()->result();
        if ($data) {
            $this->set_response($data, REST_Controller::HTTP_OK);
        } else {
            $this->set_response(array('error' => 'Tidak ditemukan data'),  REST_Controller::HTTP_NOT_FOUND);
        }
    }
    public function ambilKrtDanSub_get()
    {
        $data = $this->ModelKriteria->GetKriteriaAndSub();

        $this->set_response($data, REST_Controller::HTTP_OK);
    }
    public function updateKrt_put()
    {
        $TL = (object) $this->put('body');

        if ($this->ModelKriteria->UpdateKriteria($TL)) {
            $this->set_response(array('status' => 'sukses'), REST_Controller::HTTP_CREATED);
        } else {
            $this->set_response(array('error' => 'Error saat simpan data'),  REST_Controller::HTTP_BAD_REQUEST);
        }
    }
    public function ambilKrtDenganId_get($Id)
    {
        $where = array('id_kriteria' => $Id);
        $TL = $this->ModelKriteria->GetKriteriaById($where);

        if ($TL) {
            $this->set_response($TL, REST_Controller::HTTP_OK);
        } else {
            $this->set_response(array('error' => 'Tidak ditemukan data'),  REST_Controller::HTTP_NOT_FOUND);
        }
    }
}
