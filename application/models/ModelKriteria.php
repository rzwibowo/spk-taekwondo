<?php

/**
 *
 */
class ModelKriteria extends CI_Model
{
	public function __construct()
	{
		parent::__construct();

		//load database library
		$this->load->database();
	}

	function GetKriteria()
	{
		$this->db->order_by("is_multi", "desc");
		return $this->db->get('kriteria');
	}

	function GetKriteriaAndSub()
	{
		$res = $this->db->get('kriteria')->result();

		foreach ($res as $item) {
			$this->db->select('nama_sub, bobot_kriteria');
			$res_sub = $this->db->get_where('sub_kriteria', array('id_kriteria' => $item->id_kriteria))->result();

			$item->subkriteria = $res_sub;
		}

		return $res;
	}

	// function InsertKriteria($Data)
	// {
	// 	# code...
	// 	if($this->db->insert('kriteria',$Data)){
	// 		return true;
	// 	}else{
	// 		return false;
	// 	}
	// }
	function GetKriteriaById($Where)
	{
		# code...
		// get kriteria
		$res = $this->db->get_where('kriteria', $Where)->result();

		$this->db->select('id_sub_kriteria, nama_sub, bobot_kriteria');
		$res_sub = $this->db->get_where('sub_kriteria', $Where)->result();

		$res[0]->subkriteria = $res_sub;

		return $res[0];
	}
	function UpdateKriteria($Data)
	{
		$Where = array(
			'id_kriteria' => $Data->id_kriteria
		);

		$this->db->where($Where);

		// return $Data->subkriteria;
		if ($this->db->update('kriteria', $Data)) {
			$main_q = true;
			$sub_q = true;

			$sub_update = $Data->subkriteria;
			if ($this->db->update_batch('sub_kriteria', $sub_update, 'id_sub_kriteria')) {
				$sub_q = true;
			} else {
				$sub_q = false;
			}

			return $main_q || $sub_q;
		} else {
			return false;
		}
	}
	// function Delete($Id)
	// {
	// 	$Where=array('id_kriteria'=>$Id);
	// 	$this->db->where($Where);
	// 	if($this->db->delete('kriteria')){
	// 		return true;
	// 	}else
	// 	{
	// 		return false;
	// 	}
	// }

}
