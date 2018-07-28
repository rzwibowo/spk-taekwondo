<?php
/**
*
*/
class ModeltahunAngkatan extends CI_Model
{
	public function __construct() {
		parent::__construct();

		//load database library
		$this->load->database();
	}
	
    function GetTahunAngkatan(){

    	return $this->db->get('tahun_angkatan');
    }
}

?>
