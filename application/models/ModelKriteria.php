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
	
    function Getkriteria(){

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
    function GetKriteriaWithFilter($Filter)
	{
		# code...
		$this->db->select('*');
		$this->db->from('kriteria');
		if(count($Filter) > 0){
			$this->db->like($Filter);
		}
	  return $this->db->get();
	}
	function GatById($Where)
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
	function Detete($Id)
	{
		$Where=array(
				'id_kriteria'=>$Id
		);
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
