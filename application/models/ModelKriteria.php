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
		$SubKriteria = $Data->SubKriteria;
		unset($Data->SubKriteria);
		if($this->db->insert('kriteria',$Data)){
		  $idKriteria = $this->db->insert_id();
          //var_dump($SubKriteria);
          if($Data->istext == '1'){
            foreach ($SubKriteria as $key => $value) {
            	$value['id_kriteria'] = $idKriteria;
          		$this->db->insert('sub_criteria_text',$value);
            }
          }else{
          	foreach ($SubKriteria as $key => $value) {
          		$value['id_kriteria'] = $idKriteria;
          	    $this->db->insert('sub_criteria_nontext',$value);
            }	
          }
          
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
	function Delete($Id)
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
	function detailkriteria($kriteria){
		$Where=array(
				'nama_kriteria'=>str_replace("_"," ",$kriteria)
		);
		$Resultkriteria = $this->db->get_where('kriteria',$Where)->result();
        if($Resultkriteria[0]->istext == "0"){
        	$this->db->select('*');
			$this->db->from('sub_criteria_nontext');
       		$this->db->join('kriteria', 'sub_criteria_nontext.id_kriteria = kriteria.id_kriteria');
       		$this->db->where($Where);
       		return $this->db->get();

        }else{
         	$this->db->select('*');
			$this->db->from('sub_criteria_text');
       		$this->db->join('kriteria', 'sub_criteria_text.id_kriteria = kriteria.id_kriteria');
       		$this->db->where($Where);
       		return $this->db->get();
        }

	}

}

?>
