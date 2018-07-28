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
    function GetMahasiswaWithFilter($Filter)
	{
		# code...
		$this->db->select('*');
		$this->db->from('mahasiswa');
        $this->db->join('tahun_angkatan', 'mahasiswa.id_tahun_angkatan = tahun_angkatan.id_tahun_angkatan');
		if(count($Filter) > 0){
			$this->db->like($Filter);
		}
	  return $this->db->get();
	}
	function GetById($Where)
	{
		# code...
		$this->db->select('*');
		$this->db->from('mahasiswa');
        $this->db->join('tahun_angkatan', 'mahasiswa.id_tahun_angkatan = tahun_angkatan.id_tahun_angkatan');
		$this->db->where($Where);

	  return $this->db->get();
	}
	function GetEdit($Where)
	{
		# code...
		return $this->db->get_where('mahasiswa',$Where);
	}
	function UpdateMahasiswa($Data){
	    $Where=array(
				'id_mahasiswa'=>$Data->id_mahasiswa
		);

        $this->db->where($Where);
		if($this->db->update('mahasiswa',$Data)){
			return true;
		}else {
			return false;
		}
	}
	function Delete($Id)
	{
		$Where=array(
				'id_mahasiswa'=>$Id
		);
		$this->db->where($Where);
		if($this->db->delete('mahasiswa')){
			return true;
		}else
		{
			return false;
		}
	}
	function GetMahasiswaWithTahunAngkatan($where){
		return $this->db->get_where('mahasiswa',$where);
	}

}

?>
