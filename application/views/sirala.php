<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to CodeIgniter</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>/stil/css/siralaStyle.css">
 <!--YERDEĞİŞTİRME-->
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <!--YERDEĞİŞTİRME-->
 
</head>

<body>


<?php 
 if($siraliBilgi==0)
        {
?>
<div>
    <a href="javascript:void(0);" class="btn outlined mleft_no reorder_link" id="save_reorder">SIRALA</a>
    <div id="reorder-helper" class="light_box" style="display:none;">1.Fotoğrafları Kaydır.<br>Ve Kaydet'e bas.</div>
    <div class="gallery">
        <ul class="reorder_ul reorder-photos-list">
        <?php 
       
          $count=1;
        for ($i=0; $i <count($bilgi); $i++) { 
            ?>
          <li id="image_li_<?php echo $count ?>" class="ui-sortable-handle"><a href="javascript:void(0);" style="float:none;" class="image_link"><img src="<?php echo base_url()?>upload/<?php echo $bilgi[$i]?>" alt=""></a></li>
        
               <?php $count++; }?>
       
           
      
        </ul>
    </div>
</div>
<?php } ?>


<?php 
if($siraliBilgi!=0)
        {
?>
<div>
<br/><br/><br/><br/><br/><br/><br/><br/>
    <a href="javascript:void(0);" class="btn outlined mleft_no reorder_link" id="save_reorder">reorder photos</a>
    <div id="reorder-helper" class="light_box" style="display:none;">1.Fotoğrafları Kaydır.<br>Ve Kaydet'e bas.</div>
    <div class="gallery">
        <ul class="reorder_ul reorder-photos-list">
        <?php 
        
          $count=1;
    foreach ($siraliBilgi as $s) {
    
            ?>
          <li id="image_li_<?php echo $count ?>" class="ui-sortable-handle"><a href="javascript:void(0);" style="float:none;" class="image_link"><img src="<?php echo base_url()?>upload/<?php echo $s->fotografAdi?>" alt=""></a></li>
        
               <?php $count++; } ?>
       
           
      
        </ul>
    </div>
</div>
<?php } ?>

<p id="demo"></p>
<p id="demo2"></p>

</body>
</html>

 <script>
    $(document).ready(function(){
    $('.reorder_link').on('click',function(){
        $("ul.reorder-photos-list").sortable({ tolerance: 'pointer' });
        $('.reorder_link').html('KAYDET');
        $('.reorder_link').attr("id","save_reorder");
        $('#reorder-helper').slideDown('slow');
        $('.image_link').attr("href","javascript:void(0);");
        $('.image_link').css("cursor","move");
        $("#save_reorder").click(function( e ){
            if( !$("#save_reorder i").length ){
                $(this).html('').prepend('<img src="images/refresh-animated.gif"/>');
                $("ul.reorder-photos-list").sortable('destroy');
            
    
                var h = [];
                $("ul.reorder-photos-list li").each(function() {  h.push($(this).attr('id').substr(9));  });
                
                var z = [];
                $("ul.reorder-photos-list li a img").each(function() {  z.push($(this).attr('src').substr(35));  });
                //document.getElementById("demo").innerHTML=z;
                //document.getElementById("demo2").innerHTML=h;
                
            
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url();?>index.php/sirala_controller/update",
                    data: {ids: " " + h + "",names:z+""},
                    success: function(){
                        window.location.href ="anasayfa_controller"
                    }
                }); 
                return false;
            }   
            e.preventDefault();     
        });
    });
});
</script>