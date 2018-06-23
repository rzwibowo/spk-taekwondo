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

    public function mahasiswas_get()
    {
        $data=$this->ModelMahasiswa->GetMahasiswa()->result();
        $this->set_response($data, REST_Controller::HTTP_CREATED);
    }
    public function mahasiswa_post()
    {
        $MHS= (object) $this->post('body');
        if($this->ModelMahasiswa->InsertMahasiswa($MHS)){
                $this->set_response(array('status' => 'sukses'), REST_Controller::HTTP_CREATED);
            }else{
                $this->set_response(array('error' => 'Error saat simpan data'), 404);
            }

      //  $this->set_response($message, REST_Controller::HTTP_CREATED);
    }

}
