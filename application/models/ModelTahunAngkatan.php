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
   function UpdateTahunAngkatan($Data){
	    $Where=array(
				'id_tahun_angkatan'=>$Data->id_tahun_angkatan
		);

        $this->db->where($Where);
		if($this->db->update('tahun_angkatan',$Data)){
			return true;
		}else {
			return false;
		}
	}
   function InsertTahunAngkatan($Data)
	{
		# code...
		if($this->db->insert('tahun_angkatan',$Data)){
			return true;
		}else{
			return false;
		}
	}
    function GetTahunAngkatanWithFilter($Filter)
	{
		# code...
		$this->db->select('*');
		$this->db->from('tahun_angkatan');
		if(count($Filter) > 0){
			$this->db->like($Filter);
		}
	  return $this->db->get();
	}
	function GatById($Where)
	{
		# code...
		return $this->db->get_where('tahun_angkatan',$Where);
	}
	function Delete($Id)
	{
		$Where=array(
				'id_tahun_angkatan'=>$Id
		);
		$this->db->where($Where);
		if($this->db->delete('tahun_angkatan')){
			return true;
		}else
		{
			return false;
		}
	}
}

?>
