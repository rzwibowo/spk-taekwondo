<?php
/**
*
*/
class ModelBeasiswa extends CI_Model
{
	public function __construct() {
		parent::__construct();

		//load database library
		$this->load->database();
	}
	
   function InsertBeasiswa($Data)
	{

		# code...
		if($this->db->insert('beasiswa',$Data)){
			return true;
		}else{
			return false;
		}
	}
}

?>
