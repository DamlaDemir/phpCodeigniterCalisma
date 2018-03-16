<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class sirala_controller extends CI_Controller {
  
	function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->model('sirala_model');	
	}

	public function index()
	{
		 if(!empty($this->session->urunId))
		 {
            $urunId=$this->session->urunId;
         }

		$data=$this->sirala_model->getir($urunId);
		$formArray=array("siraliBilgi"=>$data,
			              "bilgi"=>$this->session->bilgi
			             );
		if(!empty($this->session->bilgi)){
		 $this->load->view('sirala',$formArray);
	    }

	}

	public function update()
	{    
		$countArray=explode(",",$_POST['ids']);
		$nameArray=explode(",",$_POST['names']);
		 if(!empty($this->session->urunId)){
            $urunId=$this->session->urunId;
           }
	
		$result=$this->sirala_model->updateOrder($countArray,$nameArray,$urunId);				
	}
}

?>