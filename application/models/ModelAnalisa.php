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
        $this->db->select('analisis_kriteria_id, tanggal_buat, a.id_user, username');
        $this->db->from('analisis_kriteria a');
        $this->db->join('user u', 'a.id_user = u.id_user');
        return $this->db->get();
    }

    function getAnalisisById($Where)
    {
        return $this->db->get_where('detail_analisis_kriteria',$Where);
    }

    function saveNilaiPerbandiganAlternatif($data){
        $H_perbandingan = array('user_id' =>  $data['user'] , 'tanggal' =>date("Y-m-d"));
        
       if($this->db->insert('h_perbandingan',$H_perbandingan)){
           $H_perbandinganId = $this->db->insert_id();

                 foreach ($data['alternatif'] as $key => $value_A) {
                    
                     $H_perbandingan_alternatif = array('H_perbandingan_id' => $H_perbandinganId,'tempat_latihan_id' => $value_A['id_tempat_latihan']);
                     if ($this->db->insert('h_perbandingan_alternatif',$H_perbandingan_alternatif)){
                             $H_perbandingan_alternatif_id = $this->db->insert_id();
                            
                            foreach ($value_A['kriteria'] as $key => $value_K) {
                                $H_perbandingan_kriteria = array('H_perbandingan_alternatif_id' => $H_perbandingan_alternatif_id,'kriteria_id' => $value_K['id_kriteria'],'rata_rata'=> $value_K['rata_rata']);

                                if ($this->db->insert('h_perbandingan_kriteria',$H_perbandingan_kriteria)){
                                    if($value_K['is_multi'] == "1"){
                                         $H_perbandingan_kriteria_Id = $this->db->insert_id();
                                       foreach ($value_K['subkriteria'] as $key => $value_S) {
                                               $H_perbandingan_sub_kriteria = array('H_perbandingan_kriteria_id' => $H_perbandingan_kriteria_Id,'sub_kriteria_id' => $value_S['id_sub_kriteria'],'nilai'=> $value_S['nilai']);
                                               if ($this->db->insert('h_perbandingan_sub_kriteria',$H_perbandingan_sub_kriteria)){
                                                    
                                               }else
                                               {
                                                return false;
                                               }
                                        }
                                    }
                                   
                                } else {
                                return false;
                                }
                            }
                    }

                 }
        } else {
           return false;
       }

    }
    public function hitung_perbandingan(){
        $result = array(
            'tabel_keputusan' => null

        );
         /** ambil history perbandingan yang paling terakhir **/
        $this->db->select('*');
        $this->db->from('h_perbandingan');
        $this->db->order_by('h_perbandingan_id','DESC');
        $this->db->limit(1);
        $perbandingan = $this->db->get()->result()[0];
        
        /** ambil data alternatif berdasarkan perbandingan **/
        $this->db->select('*');
        $this->db->from('h_perbandingan_alternatif a');
        $this->db->join('tempat_latihan b', 'a.tempat_latihan_id = b.id_tempat_latihan');
        $this->db->where('a.h_perbandingan_id',$perbandingan->h_perbandingan_id);
		$this->db->order_by('b.id_tempat_latihan','ASC');
        $alternatif = $this->db->get()->result();

        foreach($alternatif as $key => $value){

		   /** ambil data bobot rata - rata kriteria **/
		   $this->db->select('*');
		   $this->db->from('h_perbandingan_kriteria a');
		   $this->db->join('kriteria b', 'b.id_kriteria = a.kriteria_id');
		   $this->db->where('a.H_perbandingan_alternatif_id',$value->H_perbandingan_alternatif_id);
		   $this->db->order_by('b.id_kriteria','ASC');
		   $kriteria = $this->db->get()->result();

            $alternatif[$key] = (object) array_merge((array)$alternatif[$key], (array)array("kriteria" => $kriteria));
        }
		$this->db->select('*');
		$this->db->from('kriteria');
		$this->db->order_by('id_kriteria','ASC');
		$M_kriteria=  $this->db->get()->result();

		$result['tabel_keputusan'] = array(
        "kriteira"=>$M_kriteria,
        "alternatif"=>$alternatif);

		/**array(2){
		['kriteira'] => $M_kriteria
		['alternatif']=
		};**/

        return $result;

    }
}

?>
