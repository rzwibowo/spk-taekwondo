<?php
/**
*
*/
class ModelKriteria extends CI_Model
{
	public function __construct() {
		parent::__construct();

		//load database library
		$this->load->database();
	}
	
    function GetKriteria(){

    	return $this->db->get('kriteria');
    }
    
	function InsertKriteria($Data)
	{
		# code...
		if($this->db->insert('kriteria',$Data)){
			return true;
		}else{
			return false;
		}
	}
	function GetKriteriaById($Where)
	{
		# code...
		return $this->db->get_where('kriteria',$Where);
	}
	function UpdateKriteria($Data){
	    $Where=array(
			'id_kriteria'=>$Data->id_kriteria
		);

        $this->db->where($Where);
		if($this->db->update('kriteria',$Data)){
			return true;
		}else {
			return false;
		}
	}
	function Delete($Id)
	{
		$Where=array('id_kriteria'=>$Id);
		$this->db->where($Where);
		if($this->db->delete('kriteria')){
			return true;
		}else
		{
			return false;
		}
	}

}

?>
