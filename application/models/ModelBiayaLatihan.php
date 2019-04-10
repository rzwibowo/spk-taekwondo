<?php
/**
*
*/
class ModelBiayaLatihan extends CI_Model
{
	public function __construct() {
		parent::__construct();

		//load database library
		$this->load->database();
	}
	
    function GetBiaya(){
		$this->db->select('dk.id_detail_kriteria,
			dk.nilai, dk.id_tempat_latihan,
			tl.nama');
		$this->db->from('detail_kriteria as dk');
		$this->db->join('tempat_latihan as tl',
			'dk.id_tempat_latihan = tl.id_tempat_latihan');	
        $this->db->where('id_kriteria', 2);

    	return $this->db->get_where();
    }
    
	function InsertBiaya($Data)
	{
		# code...
		if($this->db->insert('detail_kriteria',$Data)){
			return true;
		}else{
			return false;
		}
	}
	function GetBiayaById($Where)
	{
		# code...
		return $this->db->get_where('detail_kriteria',$Where);
	}
	function UpdateBiaya($Data){
	    $Where=array(
			'id_detail_kriteria'=>$Data->id_detail_kriteria
		);

        $this->db->where($Where);
		if($this->db->update('detail_kriteria',$Data)){
			return true;
		}else {
			return false;
		}
	}
	function Delete($Id)
	{
		$Where=array(
				'id_detail_kriteria'=>$Id
		);
		$this->db->where($Where);
		if($this->db->delete('detail_kriteria')){
			return true;
		}else
		{
			return false;
		}
	}

}

?>
