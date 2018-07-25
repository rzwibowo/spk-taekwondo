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
class Login extends REST_Controller {

    function __construct($config = 'rest')
    {
        // Construct the parent class
        parent::__construct($config);
        $this->load->model('ModelUser');

    }
    function UserAutorization_post()
    {
        # code...
         $UserPost = $this->post('body');
         $User=$this->ModelUser->AutUser($UserPost['username'],$UserPost['password'])->result();
         $this->set_response($User, REST_Controller::HTTP_CREATED);
    }

    function GetUserName_get($nip){
        $user=$this->ModelUser->GetUserName($nip)->result();
        $this->set_response($user[0], REST_Controller::HTTP_CREATED);
    }

}
