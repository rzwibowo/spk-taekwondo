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

             array_push($result,array('row' => $value->nama_kriteria,'id' => $value->id_kriteria, 'colums' => $colums,'jumlah' => null,'bobot' => null,'hasil' => null ));
             $indexShow ++;
        }
    	return $result;

    }
    function hitungMatrixPerbandinganKeriteria($keriteria)
    {
        $result = array();

        $Matrix1 = null;
        $Matrix2 = null;
        $Matrix3 = null;
        $Matrix4 = null;
        $Matrix5 = null;

        // Perhitungan Matrix 1
        $Matrix1 =  $keriteria;
        $index = 0;
        foreach ($Matrix1 as $key => $value) {
                $index1 = 0;
                foreach ($value["colums"] as $key1 => $value1) {
                     if($index == $index1){
                        $value["colums"][$key1]['value'] = 1;
                     }

                $index1 ++;
                }
         $index ++ ;
         $Matrix1[$key] = $value;
        }

         $index =0;
         foreach ($Matrix1 as $key => $value) {
                $jumlah = 0;
                $index1 = 0;
                foreach ($value["colums"] as $key1 => $value1) {
                    if($index1 < (count($keriteria)) && $index1 > $index ){
                     $Matrix1[$index1]["colums"][$index]['value'] = number_format($value["colums"][$index]['value'] / $value["colums"][$index1]["value"],4);
                    }

                $jumlah = number_format($jumlah + $Matrix1[$index1]["colums"][$index]['value'],4);
                $index1 ++;
                }
         $Matrix1[$index]["jumlah"] =  $jumlah;
         $index ++ ;
         }
         //Perhitungan Matrix 1 End

         // Perhitungan Matrix 2
         $Matrix2 =  $Matrix1;
         $index =0;
         foreach ($Matrix1 as $key => $value) {
                $index1 = 0;
                $jumlah = 0;
                foreach ($value["colums"] as $key1 => $value1) {
                $Matrix2[$index]["colums"][$index1]["value"] = number_format($Matrix1[$index]["colums"][$index1]["value"] /  $Matrix1[$index1]["jumlah"],4);

                $jumlah = number_format($jumlah + $Matrix2[$index]["colums"][$index1]["value"],4);
                $index1 ++;
                }
         $Matrix2[$index]["jumlah"] =  $jumlah;
          $Matrix2[$index]["bobot"] =  $jumlah / count($keriteria);
         $index ++ ;
         }
        // Perhitungan Matrix 2 End

        // Perhitungan Matrix 3
        $Matrix3 =  $Matrix2;
        $index =0;
         foreach ($Matrix3 as $key => $value) {
                $index1 = 0;
                $jumlah = 0;
                foreach ($value["colums"] as $key1 => $value1) {
                $Matrix3[$index]["colums"][$index1]["value"] = number_format($Matrix2[$index1]["bobot"] *  $Matrix1[$index]["colums"][$index1]["value"] ,4);

                $jumlah = number_format($jumlah + $Matrix3[$index]["colums"][$index1]["value"] ,4);
                $index1 ++;
                }
         $Matrix3[$index]["jumlah"] =  $jumlah;
          $Matrix3[$index]["bobot"] =  null;
         $index ++ ;
         }
        // Perhitungan Matrix 3 End


        // Perhitungan Matrix 4
          $Matrix4 = $keriteria;
          $index =0;
          $totalHasil = 0;
         foreach ($Matrix3 as $key => $value) {
                $index1 = 0;
                $jumlah = 0;

                foreach ($value["colums"] as $key1 => $value1) {
                $jumlah = number_format($jumlah + $Matrix3[$index]["colums"][$index1]["value"] ,4);
                $index1 ++;
                }

          $Matrix4[$index]["jumlah"] =  $jumlah;
          $Matrix4[$index]["bobot"] =  $Matrix2[$index]["bobot"] ;
          $Matrix4[$index]["hasil"] =  number_format($Matrix4[$index]["jumlah"] / $Matrix4[$index]["bobot"],4);
          $totalHasil = $totalHasil + $Matrix4[$index]["hasil"];
         $index ++ ;
         }
         $rata_rata = number_format($totalHasil / count($keriteria),4);
         $resultMatrix4 =array("ratarata" => $rata_rata,"Matrix4" => $Matrix4);
        // Perhitungan Matrix 4 end


        // Perhitungan Matrix 5
         $Matrix5 = array("N" => count($keriteria), "Xmaks" => $rata_rata ,"IR" => 1,12,
          "CI" => (($rata_rata - count($keriteria)) / count($keriteria) - 1), "CR" =>   (($rata_rata - count($keriteria)) / count($keriteria) - 1) / 1,12);
        // Perhitungan Matrix 5 End

        $result = array('Matrix1' => $Matrix1,'Matrix2' => $Matrix2, 'Matrix3' => $Matrix3 ,'Matrix4' => $resultMatrix4,'Matrix5' =>  $Matrix5);
        return $result;
    }
    function saveAnalisisKriteria($keriteria){
        $analisis_kriteria = array('tanggal_buat' => date("Y-m-d") , 'id_user' => $keriteria['id_user'] );
        
        if($this->db->insert('analisis_kriteria',$analisis_kriteria)){
            $analisis_kriteria_id = $this->db->insert_id();

            foreach ($keriteria['Matrix4'] as $key => $value) {
                $detail_analisis_kriteria = array('analisis_kriteria_id' => $analisis_kriteria_id,'kriteria_id' => $value['id'], 'bobot' => $value['bobot']);
                    if ($this->db->insert('detail_analisis_kriteria',$detail_analisis_kriteria)){
                } else {
                    return false;
                }
            }
        } else {
            return false;
        }
    }

    function getListAnalisisKriteria()
    {
        $this->db->select('analisis_kriteria_id, tanggal_buat, id_user, username');
        $this->db->from('analisis_kriteria a');
        $this->db->join('user u', 'a.id_user = u.id_user');
        return $this->db->get();
    }
}

?>
