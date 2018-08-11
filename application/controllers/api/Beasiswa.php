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
class Beasiswa extends REST_Controller {

    function __construct($config = 'rest')
    {
        // Construct the parent class
        parent::__construct($config);
        $this->load->model('ModelBeasiswa');

    }

    public function beasiswa_post()
    {
        $Beasiswa= (object) $this->post('body');

         if($this->ModelBeasiswa->InsertBeasiswa($Beasiswa)){
                $this->set_response(array('status' => 'sukses'), REST_Controller::HTTP_CREATED);
         }else{
            $this->set_response(array('error' => 'Error saat simpan data'), 404);
        }
    }
    public function GetBeasiswaByTahunAngkatan_get($tahun_angkatan){
        $Beasiswa=$this->ModelBeasiswa->GetBeasiswaByTahunAngkatan($tahun_angkatan)->result();
        $this->set_response($Beasiswa, REST_Controller::HTTP_CREATED);
    }

}
