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
class TempatLatihan extends REST_Controller {

    function __construct($config = 'rest')
    {
        // Construct the parent class
        parent::__construct($config);
        $this->load->model('ModelTempatLatihan');

    }

    public function ambilTl_get()
    {
        $data=$this->ModelTempatLatihan->GetTempatLatihan()->result();
        $this->set_response($data, REST_Controller::HTTP_OK);
    }
    public function simpanTl_post()
    {
        $TL = (object) $this->post('body');
        if($TL->id_tempat_latihan != ''){
            if($this->ModelTempatLatihan->UpdateTempatLatihan($TL)){
                $this->set_response(array('status' => 'sukses'), REST_Controller::HTTP_CREATED);
            }else{
                $this->set_response(array('error' => 'Error saat simpan data'), 404);
            }
        }else{
            if($this->ModelTempatLatihan->InsertTempatLatihan($TL)){
                $this->set_response(array('status' => 'sukses'), REST_Controller::HTTP_CREATED);
            }else{
                $this->set_response(array('error' => 'Error saat simpan data'), 404);
            }
        }

      //  $this->set_response($message, REST_Controller::HTTP_CREATED);
    }
    function ambilTlDenganId_get($Id)
    {
        # code...
        $where=array('tempat_latihan.id_tempat_latihan'=>$Id);
        $TL=$this->ModelTempatLatihan->GetTempatLatihanById($where)->result();
        $this->set_response($TL[0], REST_Controller::HTTP_CREATED);
    }
    public function hapusTl_delete($Id)
    {
        $this->ModelTempatLatihan->Delete($Id);

        // Validate the id.
        if ($Id <= 0)
        {
            // Set the response and exit
            $this->response(NULL, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
        }

        // $this->some_model->delete_something($id);
        $message = [
            'id' => $Id,
            'message' => 'Deleted the resource'
        ];

        $this->set_response($message, REST_Controller::HTTP_NO_CONTENT); // NO_CONTENT (204) being the HTTP response code
    }

}
