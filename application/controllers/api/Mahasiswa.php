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
class Mahasiswa extends REST_Controller {

    function __construct($config = 'rest')
    {
        // Construct the parent class
        parent::__construct($config);
        $this->load->model('ModelMahasiswa');

    }

    public function mahasiswas_post()
    {
        $Filter = $this->post('body');
        $data=$this->ModelMahasiswa->GetMahasiswaWithFilter($Filter)->result();
        $this->set_response($data, REST_Controller::HTTP_CREATED);
    }
    public function mahasiswa_post()
    {
        $MHS= (object) $this->post('body');
        if(isset($MHS->id_mahasiswa)){
            if($this->ModelMahasiswa->UpdateMahasiswa($MHS)){
                $this->set_response(array('status' => 'sukses'), REST_Controller::HTTP_CREATED);
            }else{
                $this->set_response(array('error' => 'Error saat simpan data'), 404);
            }
        }else{
            if($this->ModelMahasiswa->InsertMahasiswa($MHS)){
                $this->set_response(array('status' => 'sukses'), REST_Controller::HTTP_CREATED);
            }else{
                $this->set_response(array('error' => 'Error saat simpan data'), 404);
            }
        }

      //  $this->set_response($message, REST_Controller::HTTP_CREATED);
    }
    function GetDataMahasiswaById_get($Id)
    {
        # code...
        $where=array('mahasiswa.id_mahasiswa'=>$Id);
        $MHS=$this->ModelMahasiswa->GetById($where)->result();
        $this->set_response($MHS[0], REST_Controller::HTTP_CREATED);
    }
    function GetDataMahasiswaEdit_get($Id)
    {
        # code...
        $where=array('id_mahasiswa'=>$Id);
        $MHS=$this->ModelMahasiswa->GetEdit($where)->result();
        $this->set_response($MHS[0], REST_Controller::HTTP_CREATED);
    }
    function mahasiswadelete_get($Id)
    {
        if($this->ModelMahasiswa->Delete($Id)){

        }else{

        }
    }
    function getmahasiswawithtahunangkatan_get($id_tahun){
        $MHS=$this->ModelMahasiswa->GetMahasiswaWithTahunAngkatan($id_tahun)->result();
        $this->set_response($MHS, REST_Controller::HTTP_CREATED);
    }

}
