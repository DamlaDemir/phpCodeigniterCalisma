<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class index_controller extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('index_model');
		$this->load->library('session');	
	}

	public function index()
	{
		$this->load->view('index');
	}

	function upload()
	{	    
		if($_FILES["files"]["name"]!='')
		{
			$output='';
			$config["upload_path"]='./upload/';
			$config["allowed_types"]='gif|jpg|png|jpeg';
			$this->load->library('upload',$config);
			$this->upload->initialize($config);
			
			for ($count=0; $count <count($_FILES["files"]["name"]) ; $count++) {

				$_FILES["file"]["name"]=$_FILES["files"]["name"][$count];
				$_FILES["file"]["type"]=$_FILES["files"]["type"][$count];
				$_FILES["file"]["tmp_name"]=$_FILES["files"]["tmp_name"][$count];
				$_FILES["file"]["error"]=$_FILES["files"]["error"][$count];
				$_FILES["file"]["size"]=$_FILES["files"]["size"][$count];
				$_FILES["file"]["width"]=400;
				$_FILES["file"]["height"]=300;
				if($this->upload->do_upload('file'))
				{
					$data=$this->upload->data();
			        $sessionData["bilgi"][$count]=$data["file_name"];
          			$this->session->set_userdata($sessionData);
					$output.='
					<div class="col-md-3" ><img src="'.base_url().'upload/'.$data["file_name"].'" style="width:200px;height:150px;"/></div>';
				}
			}	
        
        	 echo $output;
		}
	}


	function urunEkle()
	{
          if(!empty($this->session->bilgi))
          {
			$dizi['bilgi']=$this->session->bilgi;
			if(isset($_POST['urunEkle']))
			{
	          $formData =array (
	          'urunAdi'=>$this->input->post('urunAdi'),
	          'urunFiyati'=>$this->input->post("urunFiyati"),
	          'satisFoto'=>$dizi['bilgi'][0]
	           );

	           $this->index_model->urunEkle($formData);
	           $result=$this->index_model->urunBul($this->input->post('urunAdi'));
	           foreach ($result as $r) {
	            	$id=$r->urunId;
	            	$sessionData=array('urunId'=>$id);
	          		$this->session->set_userdata($sessionData);
	            }

		         /* for ($i=0; $i <count($dizi['bilgi']) ; $i++) { 
		             $formArray=array("fotografAdi"=>$dizi['bilgi'][$i],
		               	           "urunId"=>$id
		               	           );
		         $result=$this->index_model->fotografEkle($formArray);
				}*/
		        redirect("sirala_controller");
	        }
		}
	}
}

?>