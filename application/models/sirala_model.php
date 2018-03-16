<?php

class sirala_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
 	
	}

	function index()
    {
		
	  }
	
    public function getir($urunId)
    {
     $this->db->where("urunId",$urunId);
		 $this->db->order_by("img_order", "asc");//id'ye göre küçükten büyüğe sıralama
		 $query=$this->db->get('fotografbilgi');

        if($query->num_rows()>0)
        {
            return $query->result();    
        } 
        else
            return 0;       
    }

    public function updateOrder($countArray,$nameArray,$urunId)
    {
      $count=1;
       for ($i=0; $i <count($nameArray) ; $i++) { 
           $dataArray=array(
            'fotografAdi'=>$nameArray[$i],
            'img_order'=>$count,
            'urunId'=>$urunId
            );
          $query=$this->db->insert('fotografbilgi',$dataArray);
           $count++;
     
       }
        return $query;
     }
}

?>