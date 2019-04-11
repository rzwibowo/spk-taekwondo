<?php
/**
*
*/
class ModelTempatLatihan extends CI_Model
{
	public function __construct() {
		parent::__construct();

		//load database library
		$this->load->database();
	}
	
    function GetTempatLatihan(){

    	return $this->db->get('tempat_latihan');
    }
    
	function InsertTempatLatihan($Data)
	{
		# code...
		if($this->db->insert('tempat_latihan',$Data)){
			return true;
		}else{
			return false;
		}
	}
	function GetTempatLatihanById($Where)
	{
		# code...
		return $this->db->get_where('tempat_latihan',$Where);
	}
	function UpdateTempatLatihan($Data){
	    $Where=array(
			'id_tempat_latihan'=>$Data->id_tempat_latihan
		);

        $this->db->where($Where);
		if($this->db->update('tempat_latihan',$Data)){
			return true;
		}else {
			return false;
		}
	}
	function Delete($Id)
	{
		$Where=array('id_tempat_latihan'=>$Id);
		$this->db->where($Where);
		if($this->db->delete('tempat_latihan')){
			return true;
		}else
		{
			return false;
		}
	}

}

?>
