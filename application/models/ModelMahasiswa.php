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
        $this->db->join('sub_criteria_text kendaraan', 'mahasiswa.kendaraan = kendaraan.id_sub_criteria');
        $this->db->join('sub_criteria_text pekerjaan', 'mahasiswa.pkj_orangtua = pekerjaan.id_sub_criteria');
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
	function GetMahasiswaWithTahunAngkatan($id_tahun){
		$this->db->select('mahasiswa.jenis_kelamin,
			mahasiswa.tempat_lahir,
			mahasiswa.tgl_lahir,
			mahasiswa.alamat,
			mahasiswa.nama,
			mahasiswa.nim,
			mahasiswa.id_mahasiswa,
			mahasiswa.pgh_orangtua,
			mahasiswa.ipk,
			tahun_angkatan.tahun_angkatan,
			kendaraan.kriteria kendaraan,
			pekerjaan.kriteria pkj_orangtua,
			mahasiswa.jml_tanggungan,
			kendaraan.bobot bobotkendaraan,
			pekerjaan.bobot bobotpkj_orangtua,
			tanggungan.bobot bobotJmlTanggungan,
			ipk.bobot bobotipk,
			phasilan.bobot bobotpenghasilanorg');
		$this->db->from('mahasiswa');
        $this->db->join('tahun_angkatan', 'mahasiswa.id_tahun_angkatan = tahun_angkatan.id_tahun_angkatan');
        $this->db->join('sub_criteria_text kendaraan', 'mahasiswa.kendaraan = kendaraan.id_sub_criteria');
        $this->db->join('sub_criteria_text pekerjaan', 'mahasiswa.pkj_orangtua = pekerjaan.id_sub_criteria');
        $this->db->join('sub_criteria_nontext tanggungan', 'mahasiswa.tanggunganCriteria = tanggungan.id_sub_criteria');
        $this->db->join('sub_criteria_nontext ipk', 'mahasiswa.ipkCriteria = ipk.id_sub_criteria');
        $this->db->join('sub_criteria_nontext phasilan', 'mahasiswa.penghasilanCriteria = phasilan.id_sub_criteria');
		$this->db->where('mahasiswa.id_tahun_angkatan',$id_tahun);
    	return $this->db->get();
	}

}

?>
