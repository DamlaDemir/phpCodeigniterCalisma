<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Multiple Files</title>
    
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>stil/css/urunbilgi.css"/>

    <!-- FANCYBOX BAŞLANGIÇ -->
	<!-- Add jQuery library -->
	<script type="text/javascript" src="<?php echo base_url();?>stil/js/fancyjs/jquery-1.10.2.min.js"></script>

	<!-- Add mousewheel plugin (this is optional) -->
	<script type="text/javascript" src="<?php echo base_url();?>stil/js/fancyjs/jquery.mousewheel.pack.js?v=3.1.3"></script>

	<!-- Add fancyBox main JS and CSS files -->
	<script type="text/javascript" src="<?php echo base_url();?>stil/js/fancyjs/jquery.fancybox.pack.js?v=2.1.5"></script>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>stil/css/fancycss/jquery.fancybox.css?v=2.1.5" media="screen" />

	<!-- Add Button helper (this is optional) -->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>stil/css/fancycss/jquery.fancybox-buttons.css?v=1.0.5" />
	<script type="text/javascript" src="<?php echo base_url();?>stil/js/fancyjs/jquery.fancybox-buttons.js?v=1.0.5"></script>

	<!-- Add Thumbnail helper (this is optional) -->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>stil/css/fancycss/jquery.fancybox-thumbs.css?v=1.0.7" />
	<script type="text/javascript" src="<?php echo base_url();?>stil/js/fancyjs/jquery.fancybox-thumbs.js?v=1.0.7"></script>

	<!-- Add Media helper (this is optional) -->
	<script type="text/javascript" src="<?php echo base_url();?>stil/js/fancyjs/jquery.fancybox-media.js?v=1.0.6"></script>

	<script type="text/javascript">
		$(document).ready(function() {
			/*
			 *  Simple image gallery. Uses default settings
			 */

			$('.fancybox').fancybox();

			/*
			 *  Different effects
			 */

			// Change title type, overlay closing speed
			$(".fancybox-effects-a").fancybox({
				helpers: {
					title : {
						type : 'outside'
					},
					overlay : {
						speedOut : 0
					}
				}
			});

			// Disable opening and closing animations, change title type
			$(".fancybox-effects-b").fancybox({
				openEffect  : 'none',
				closeEffect	: 'none',

				helpers : {
					title : {
						type : 'over'
					}
				}
			});

			// Set custom style, close if clicked, change title type and overlay color
			$(".fancybox-effects-c").fancybox({
				wrapCSS    : 'fancybox-custom',
				closeClick : true,

				openEffect : 'none',

				helpers : {
					title : {
						type : 'inside'
					},
					overlay : {
						css : {
							'background' : 'rgba(238,238,238,0.85)'
						}
					}
				}
			});

			// Remove padding, set opening and closing animations, close if clicked and disable overlay
			$(".fancybox-effects-d").fancybox({
				padding: 0,

				openEffect : 'elastic',
				openSpeed  : 150,

				closeEffect : 'elastic',
				closeSpeed  : 150,

				closeClick : true,

				helpers : {
					overlay : null
				}
			});

			/*
			 *  Button helper. Disable animations, hide close button, change title type and content
			 */

			$('.fancybox-buttons').fancybox({
				openEffect  : 'none',
				closeEffect : 'none',

				prevEffect : 'none',
				nextEffect : 'none',

				closeBtn  : false,

				helpers : {
					title : {
						type : 'inside'
					},
					buttons	: {}
				},

				afterLoad : function() {
					this.title = 'Image ' + (this.index + 1) + ' of ' + this.group.length + (this.title ? ' - ' + this.title : '');
				}
			});


			/*
			 *  Thumbnail helper. Disable animations, hide close button, arrows and slide to next gallery item if clicked
			 */

			$('.fancybox-thumbs').fancybox({
				prevEffect : 'none',
				nextEffect : 'none',

				closeBtn  : false,
				arrows    : false,
				nextClick : true,

				helpers : {
					thumbs : {
						width  : 50,
						height : 50
					}
				}
			});

			/*
			 *  Media helper. Group items, disable animations, hide arrows, enable media and button helpers.
			*/
			$('.fancybox-media')
				.attr('rel', 'media-gallery')
				.fancybox({
					openEffect : 'none',
					closeEffect : 'none',
					prevEffect : 'none',
					nextEffect : 'none',

					arrows : false,
					helpers : {
						media : {},
						buttons : {}
					}
				});

			/*
			 *  Open manually
			 */

			$("#fancybox-manual-a").click(function() {
				$.fancybox.open('1_b.jpg');
			});

			$("#fancybox-manual-b").click(function() {
				$.fancybox.open({
					href : 'iframe.html',
					type : 'iframe',
					padding : 5
				});
			});

			$("#fancybox-manual-c").click(function() {
				$.fancybox.open([
					{
						href : '1_b.jpg',
						title : 'My title'
					}, {
						href : '2_b.jpg',
						title : '2nd title'
					}, {
						href : '3_b.jpg'
					}
				], {
					helpers : {
						thumbs : {
							width: 75,
							height: 50
						}
					}
				});
			});


		});
		</script>
	<style type="text/css">
		.fancybox-custom .fancybox-skin {
			box-shadow: 0 0 50px #222;
		}

		body {
			max-width: 700px;
			margin: 0 auto;
		}
	</style>
	<!-- FANCYBOX BİTİŞ -->
</head>
<body>

<?php 

$xml = simplexml_load_file('http://www.tcmb.gov.tr/kurlar/today.xml');
foreach ($xml->Currency as $Currency) {
    // USD ALIŞ-SATIŞ
    if ($Currency['Kod'] == "USD") {
        $usd_DS = $Currency->BanknoteSelling;//satış
        $usd_DA = $Currency->BanknoteBuying;//alış
    }
    // EURO ALIŞ-SATIŞ
    if ($Currency['Kod'] == "EUR") {
        $eur_DS = $Currency->BanknoteSelling;
        $eur_DA = $Currency->BanknoteBuying;
    }
    // USD EFEKTİF ALIŞ-SATIŞ
    if ($Currency['Kod'] == "USD") {
        $usd_ES = $Currency->ForexSelling;
        $usd_EA = $Currency->ForexBuying;
    }
    // EURO EFEKTİF ALIŞ-SATIŞ
    if ($Currency['Kod'] == "EUR") {
        $eur_ES = $Currency->ForexSelling;
        $eur_EA = $Currency->ForexBuying;
    }
}
$i=0;
foreach ($urunBilgileri as $u) {
 
 $dolar=(float)$u->urunFiyati*(float)$usd_ES;
 $uero=(float)$u->urunFiyati*(float)$eur_ES;
 foreach ($fotografBilgileri as $f) {
	if($f->urunId==$u->urunId)
	{
		  echo '<a class="fancybox" href="'.base_url().'upload/'.$f->fotografAdi.'" data-fancybox-group="gallery'.$i.'" title="Lorem ipsum dolor sit amet"><figure class="snip1492">
		 <img src="'.base_url().'upload/'.$u->satisFoto.'" style="width=300px;height:300px;"/>
		  <figcaption>
		    <h3>'.$u->urunAdi.'</h3>
		    <div class="price">'.
		      $u->urunFiyati.'TL'.
		      '<p>'.$dolar.'$</p>'.
		      '<p>'.$uero.'£</p>'.
		    '</div>
		  </figcaption><i class="ion-plus-round"></i>
		</figure></a>';
		$ilkFoto=$f->fotografAdi;
		break;
}
}

foreach ($fotografBilgileri as $f) {
	if($f->urunId==$u->urunId && $f->fotografAdi!=$ilkFoto)
	{
		echo '<a class="fancybox" href="'.base_url().'upload/'.$f->fotografAdi.'" data-fancybox-group="gallery'.$i.'" title="Lorem ipsum dolor sit amet"></a>';
	}
}

$i=$i+1;


}
?>


</body>
</html>