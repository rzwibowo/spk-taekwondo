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
		 $beasiswa = array();
		foreach ($Data as $key => $value) {
			$array = array(
                'id_mahasiswa' => $value['id_mhs'],
                'peringkat' => $key+1,
                );
			array_push($beasiswa, $array);
		}
		if($this->db->insert_batch('beasiswa',$beasiswa)){
			return true;
		}else{
			return false;
		}
	}
	function GetBeasiswaByTahunAngkatan($id_tahun)
	{
		$this->db->select('beasiswa.peringkat,
			tahun_angkatan.tahun_angkatan,
			mahasiswa.nim,
			mahasiswa.nama,
			mahasiswa.jenis_kelamin,
			mahasiswa.tempat_lahir,
			mahasiswa.tgl_lahir,
			mahasiswa.alamat,
			mahasiswa.ipk,
			kendaraan.kriteria kendaraan,
			mahasiswa.pgh_orangtua,
			pekerjaan.kriteria pkj_orangtua,
			mahasiswa.jml_tanggungan
			');
		$this->db->from('beasiswa');
	    $this->db->join('mahasiswa', 'mahasiswa.id_mahasiswa = beasiswa.id_mahasiswa');
        $this->db->join('tahun_angkatan', 'mahasiswa.id_tahun_angkatan = tahun_angkatan.id_tahun_angkatan');
        $this->db->join('sub_criteria_text kendaraan', 'mahasiswa.kendaraan = kendaraan.id_sub_criteria');
        $this->db->join('sub_criteria_text pekerjaan', 'mahasiswa.pkj_orangtua = pekerjaan.id_sub_criteria');
        $this->db->join('sub_criteria_nontext tanggungan', 'mahasiswa.tanggunganCriteria = tanggungan.id_sub_criteria');
        $this->db->join('sub_criteria_nontext ipk', 'mahasiswa.ipkCriteria = ipk.id_sub_criteria');
        $this->db->join('sub_criteria_nontext phasilan', 'mahasiswa.penghasilanCriteria = phasilan.id_sub_criteria');
		$this->db->where('tahun_angkatan.id_tahun_angkatan',$id_tahun);
		return $this->db->get();
	}
}

?>
