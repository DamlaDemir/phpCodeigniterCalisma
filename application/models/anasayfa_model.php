<?php

class anasayfa_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
 	
	}

	function index()
    {
		
	}

    public function bilgileriGetir()
    {
        $query=$this->db->get('urunbilgi');
        if($query->num_rows()>0)
        {
            return $query->result();        
        }    
    }

    public  function fotograflariGetir()
    {         
        $query=$this->db->get('fotografBilgi');
        if($query->num_rows()>0)
        {
          return $query->result();
        }
    }
}

?>