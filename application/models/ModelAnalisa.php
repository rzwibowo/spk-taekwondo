<?php
/**
*
*/
class ModelAnalisa extends CI_Model
{
	public function __construct() {
		parent::__construct();

		//load database library
		$this->load->database();
	}
	
    function GetAnalisaKriteria(){

    	$result = array();
    	$kriterias = $this->db->get('kriteria')->result();
    	$indexShow = 1;
        foreach ($kriterias as $key => $value) {
             $colums = array();
             $index = 0;
 			 foreach ($kriterias as $Kcolum => $vColums) {

 			 	if($index >= $indexShow){
 			 			array_push($colums, array('row' => $vColums->nama_kriteria,'value' => null,'IsShow' => 1));
	 			 }else{
	 			 		array_push($colums, array('row' => $vColums->nama_kriteria,'value' => null,'IsShow' => 0));
	 			 }
 			 	$index ++ ;
 			 }

             array_push($result,array('row' => $value->nama_kriteria, 'colums' => $colums ));
             $indexShow ++;
        }
    	return $result;

    }
    
	

}

?>
