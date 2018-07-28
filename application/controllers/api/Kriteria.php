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
class Kriteria extends REST_Controller {

    function __construct($config = 'rest')
    {
        // Construct the parent class
        parent::__construct($config);
        $this->load->model('ModelKriteria');

    }

    public function kriterias_post()
    {
        $Filter = $this->post('body');
        $data=$this->ModelKriteria->GetKriteriaWithFilter($Filter)->result();
        $this->set_response($data, REST_Controller::HTTP_CREATED);
    }
    public function getkriterias_get()
    {
        $data=$this->ModelKriteria->Getkriteria()->result();
        $this->set_response($data, REST_Controller::HTTP_CREATED);
    }
    public function kriteria_post()
    {
        $Kriteria= (object) $this->post('body');
        if(isset($Kriteria->id_kriteria)){
            if($this->ModelKriteria->UpdateKriteria($Kriteria)){
                $this->set_response(array('status' => 'sukses'), REST_Controller::HTTP_CREATED);
            }else{
                $this->set_response(array('error' => 'Error saat simpan data'), 404);
            }
        }else{
            if($this->ModelKriteria->InsertKriteria($Kriteria)){
                $this->set_response(array('status' => 'sukses'), REST_Controller::HTTP_CREATED);
            }else{
                $this->set_response(array('error' => 'Error saat simpan data'), 404);
            }
        }

      //  $this->set_response($message, REST_Controller::HTTP_CREATED);
    }
    function GetDataKriteriaById_get($Id)
    {
        # code...
        $where=array('id_kriteria'=>$Id);
        $MHS=$this->ModelKriteria->GatById($where)->result();
        $this->set_response($MHS[0], REST_Controller::HTTP_CREATED);
    }
    function kriteriadelete_get($Id)
    {
        if($this->ModelKriteria->Delete($Id)){

        }else{

        }
    }

}
