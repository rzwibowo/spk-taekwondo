<?php
/**
*
*/
class ModelMahasiswa extends CI_Model
{
	public function __construct() {
		parent::__construct();

		//load database library
		$this->load->database();
	}
	
    function GetMahasiswa(){

    	return $this->db->get('mahasiswa');
    }
    
	function InsertMahasiswa($Data)
	{
		# code...
		if($this->db->insert('mahasiswa',$Data)){
			return true;
		}else{
			return false;
		}
	}
}
?>
