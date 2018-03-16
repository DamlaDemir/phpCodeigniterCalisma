<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Multiple Files</title>
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"/>
   <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>stil/css/inputcss.css">

<!--YERDEĞİŞTİRME-->
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
 <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<!--YERDEĞİŞTİRME-->

</head>
<body>

<form action="<?php echo base_url();?>index.php/index_controller/urunEkle" method="post"  id="contact_form" enctype="multipart/form-data">

<div class="contact-form">
  <h1>Ürün Ekleme Paneli</h1>
  
   <div class="controls">
       <div class="form-group">
         <p>Ürün Adı:</p>
         <input type="text" class="form-input-text form-control"  required="required" name="urunAdi">                              
      </div>
      
      <div class="form-group">
         <p >Ürün Fiyatı:</p>
         <input type="text"  class="form-input-text form-control"  required="required" name="urunFiyati" >                           
      </div>
      
         <div class="form-group">
         <input type="file" name="files" id="files" multiple="" style="margin-top: 20px;" />
                    
      </div>
      
    
        <div class="send-button bottom-margin">
         <button type="submit" class="btn btn-send send-msg" name="urunEkle">Sırala Ve Ürün Ekle</button>
        </div>
    </div>

</div>
</form>




<div style="clear:both"></div>
<br/>
<br/>
<div id="uploaded_images">
   
</div>






</body>
</html>


<script>

$(document).ready(function(){
   $('#files').change(function(){
    $("#degistir").attr('style', 'display:inline');
   	var files=$('#files')[0].files;
   	var error='';
   	var form_data=new FormData();

   	for (var count =0; count<files.length;count++) {
   		
   		var name=files[count].name;
   		var extension=name.split('.').pop().toLowerCase();

   		if(jQuery.inArray(extension,['gif','png','jpg','jpeg'])==-1)
   		{
   			error+="Invalid"+count+"Image File";
   		}
   		else
   		{
   			form_data.append("files[]",files[count]);
   		}
   	}
   	if(error=='')
   	{

         $.ajax({
         	url:"<?php echo base_url();?>index.php/index_controller/upload",
         	method:"POST",
         	data:form_data,
         	contentType:false,
         	cache:false,
         	processData:false,
         	beforeSend:function()
         	{
         		$('#uploaded_images').html("<label>Uploading..</label>");
         	},

         	success:function(data)
         	{
         		$('#uploaded_images').html(data);
         		$('#files').val('');
         	}
         })
   	}
   	else
   	{
      alert(error);
   	}

    
   });
});


</script>

