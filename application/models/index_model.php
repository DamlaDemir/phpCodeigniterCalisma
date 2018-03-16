<?php


class index_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}

	function index(){
		
	}

	
    public function urunEkle($formData)
    {
    	$this->db->insert('urunbilgi',$formData);

	}
    public function fotografEkle($formData)
    {
    	$query=$this->db->insert('fotografbilgi',$formData);
       return $query;
	}

	 public function urunBul($ad)
    {
    	$this->db->where('urunAdi',$ad);//1.parametre sutun adı
    	$query=$this->db->get('urunBilgi');
    	if($query->num_rows()>0)
    	{
    		return $query->result();
    	}
	}
}

?>