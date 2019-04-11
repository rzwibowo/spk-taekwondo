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
class User extends REST_Controller {

    function __construct($config = 'rest')
    {
        // Construct the parent class
        parent::__construct($config);
        $this->load->model('ModelUser');

    }

    public function ambilUsr_get()
    {
        $data = $this->ModelUser->GetUser()->result();
        if ($data) {
            $this->set_response($data, REST_Controller::HTTP_OK);
        } else {
            $this->set_response(array('error' => 'Tidak ditemukan data'),  REST_Controller::HTTP_NOT_FOUND);
        }
    }
    public function simpanUsr_post()
    {
        $Usr=(object) $this->post('body');
        $Usr->password = md5($Usr->password);
        if ($this->ModelUser->InsertUser($Usr)) {
            $this->set_response(array('status' => 'sukses'), REST_Controller::HTTP_CREATED);
        } else {
            $this->set_response(array('error' => 'Error saat simpan data'),  REST_Controller::HTTP_BAD_REQUEST);
        }
    }
    public function updateUsr_put()
    {
        $Usr = (object) $this->put('body');
        if ($this->ModelUser->UpdateUser($Usr)){
            $this->set_response(array('status' => 'sukses'), REST_Controller::HTTP_CREATED);
        } else {
            $this->set_response(array('error' => 'Error saat simpan data'),  REST_Controller::HTTP_BAD_REQUEST);
        }
    }
    function ambilUsrDenganId_get($Id)
    {
        # code...
        $where = array('user.id_user'=>$Id);
        $Usr = $this->ModelUser->GetUserById($where)->result();
        if ($Usr) {
            $this->set_response($Usr[0], REST_Controller::HTTP_CREATED);
        } else {
            $this->set_response(array('error' => 'Tidak ditemukan data'),  REST_Controller::HTTP_NOT_FOUND);
        }
    }
    function hapusUsr_delete($Id)
    {
        $this->ModelUser->Delete($Id);
        if ($Id <= 0)
        {
            $this->response(NULL, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
        }
        $this->set_response(array('status' => 'sukses'), REST_Controller::HTTP_NO_CONTENT); // NO_CONTENT (204) being the HTTP response code
    }
    function login_post() {
        $Usr = $this->post('body');
        if ($this->ModelUser->AuthUser($User['username'], $User['password'])) {
            $this->set_response($data, REST_Controller::HTTP_OK);
        } else {
            $this->set_response(array('error' => 'Tidak ditemukan data'),  REST_Controller::HTTP_NOT_FOUND);
        }
    }
}
