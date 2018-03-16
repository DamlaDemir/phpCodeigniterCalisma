<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class anasayfa_controller extends CI_Controller {

  
	function __construct()
	{
		parent::__construct();
		$this->load->model('anasayfa_model');	
	}

	public function index()
	{
		$result=$this->anasayfa_model->bilgileriGetir();
	    $result2=$this->anasayfa_model->fotograflariGetir();
		$dataArray=array("urunBilgileri"=>$result,
                         "fotografBilgileri"=>$result2
			             );
		$this->load->view("anasayfa",$dataArray);
	}

	public  function fotograflariGetir($urunId)
	{      
        $formData=array("fotografBilgi"=>$result);
	}


}