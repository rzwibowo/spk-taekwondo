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

    	
        $result = array();

    	$TLatihan = $this->db->get('tempat_latihan')->result();

    	$kriteria = $this->db->order_by("is_multi","desc")->get('kriteria')->result();

		foreach ($kriteria as $key => $item) {

			$this->db->select('nama_sub, bobot_kriteria,id_sub_kriteria');

			$res_sub = $this->db->get_where('sub_kriteria', array('id_kriteria' => $item->id_kriteria))->result();

			foreach ($res_sub as $Ksub => $Isub) {
				 $res_sub[$Ksub] = (object) array_merge((array)$res_sub[$Ksub], (array)array("nilai" => 0,"jumlah"=> 0));
			}

			$item->subkriteria = $res_sub;
            $kriteria[$key] = (object) array_merge((array)$kriteria[$key], (array)array("rata_rata" => 0));
		}
    	
    	foreach ($TLatihan as $key => $value) {

    	       	$TempLatihan = array(
    	       		"alamat" =>  $value->alamat,
					"id_tempat_latihan" => $value->id_tempat_latihan,
					"latitude" => $value->latitude,
					"longitude" => $value->longitude,
					"nama" => $value->nama,
					"kriteria" => $kriteria
    	       	);

    	       	array_push($result,$TempLatihan );
    	}

    	return $result;
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
