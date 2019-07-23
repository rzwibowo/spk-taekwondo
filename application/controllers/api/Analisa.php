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
class Analisa extends REST_Controller
{

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

    public function saveAnalisisKriteria_post()
    {

        $post = json_decode(file_get_contents('php://input'), TRUE)["body"];

        if ($this->ModelAnalisa->saveAnalisisKriteria($post)) {
            $this->set_response(array('status' => 'sukses'), REST_Controller::HTTP_CREATED);
        } else {
            $this->set_response(array('error' => 'Error saat simpan data'),  REST_Controller::HTTP_BAD_REQUEST);
        }
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

    public function ambilAnlsDenganId_get($Id)
    {
        $where = array('analisis_kriteria_id' => $Id);
        $Bbt = $this->ModelAnalisa->getAnalisisById($where)->result();
        if ($Bbt) {
            $this->set_response($Bbt, REST_Controller::HTTP_CREATED);
        } else {
            $this->set_response(array('error' => 'Tidak ditemukan data'),  REST_Controller::HTTP_NOT_FOUND);
        }
    }

    public function saveNilaiPerbandiganAlternatif_post()
    {

        $post = json_decode(file_get_contents('php://input'), TRUE)["body"];
        
        if ($this->ModelAnalisa->saveNilaiPerbandiganAlternatif($post)) {
            $this->set_response(array('status' => 'sukses'), REST_Controller::HTTP_CREATED);
        } else {
            $this->set_response(array('error' => 'Error saat simpan data'),  REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    public function hitung_perbandingan_get($id_perbandingan)
    {
        $result = $this->ModelAnalisa->hitung_perbandingan($id_perbandingan);
        if ($result) {
            $this->set_response($result, REST_Controller::HTTP_OK);
        } else {
            $this->set_response(array('error' => 'Tidak ditemukan data'),  REST_Controller::HTTP_NOT_FOUND);
        }
    }

    public function history_perbandingan_get()
    {
        $result = $this->ModelAnalisa->historyPerbandingan();
        if ($result) {
            $this->set_response($result, REST_Controller::HTTP_OK);
        } else {
            $this->set_response(array('error' => 'Tidak ditemukan data'),  REST_Controller::HTTP_NOT_FOUND);
        }
    }

    public function simpanPeringkat_post()
    {
        $Peringkat = json_decode(file_get_contents('php://input'), TRUE)["body"];
        if ($this->ModelAnalisa->savePeringkat($Peringkat)) {
            $this->set_response(array('status' => 'sukses'), REST_Controller::HTTP_CREATED);
        } else {
            $this->set_response(array('error' => 'Error saat simpan data'),  REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    public function ambilListPeringkat_get()
    {
        $data = $this->ModelAnalisa->getListPeringkat()->result();
        if ($data) {
            $this->set_response($data, REST_Controller::HTTP_OK);
        } else {
            $this->set_response(array('error' => 'Tidak ditemukan data'),  REST_Controller::HTTP_NOT_FOUND);
        }
    }

    public function ambilPeringkatDenganId_get($Id)
    {
        $where = array('id_peringkat_alternatif' => $Id);
        $Prg = $this->ModelAnalisa->getPeringkatById($where)->result();
        if ($Prg) {
            $this->set_response($Prg, REST_Controller::HTTP_CREATED);
        } else {
            $this->set_response(array('error' => 'Tidak ditemukan data'),  REST_Controller::HTTP_NOT_FOUND);
        }
    }

    public function ambilPeringkatHariIni_get()
    {
        $Prg = $this->ModelAnalisa->getLatestPeringkat()->result();
        if ($Prg) {
            $this->set_response($Prg, REST_Controller::HTTP_CREATED);
        } else {
            $this->set_response(array('error' => 'Tidak ditemukan data'),  REST_Controller::HTTP_NOT_FOUND);
        }
    }
}
