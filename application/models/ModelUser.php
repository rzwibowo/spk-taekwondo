<?php
/**
*
*/
class ModelUser extends CI_Model
{
	public function __construct() {
		parent::__construct();

		//load database library
		$this->load->database();
	}
    
    function GetUser() {
        $this->db->select('id_user, username, level');
        $this->db->from('user');

        return $this->db->get();
    }

    function AuthUser($Username,$Password)
    {
        # code...
        $PasswordHash = md5($Password);
        $this->db->select('username, level');
        $this->db->from('user');
        $this->db->where('username', $Username);
        $this->db->where('password', $PasswordHash);
        return $this->db->get();
    }

    function InsertUser($Data)
    {
        # code...
        if($this->db->insert('user',$Data)){
            return true;
        } else {
            return false;
        }
    }

    function UpdateUser($Data){
        $this->db->select('password');
        $this->db->from('user');
        $this->db->where('id_user', $Data->id_user);
        $qres =  $this->db->get()->result()[0];
        if (($qres->password !== md5($Data->password))
            && ($Data->password !== '')){
            $Data->password = md5($Data->password);
        } else {
            $Data->password = $qres->password;
        }
        $Where=array(
            'id_user'=>$Data->id_user
        );
        $this->db->where($Where);
        if ($this->db->update('user',$Data)){
            return true;
        } else {
            return false;
        }
    }

    function Delete($Id)
    {
        $Where=array('id_user'=>$Id);
        $this->db->where($Where);
        if ($this->db->delete('user')){
            return true;
        } else {
            return false;
        }
    }
    
    function GetUserById($Where)
    {
        # code...
        return $this->db->get_where('user',$Where);
    }

}

?>
