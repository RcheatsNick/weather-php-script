<?php include("fonksiyon.php"); ?>
<html>
<head>
<meta charset="utf-8"> 
<title>Hava Durumu</title>
<link rel="stylesheet" type="text/css" href="style.css" />
<style type="text/css">
body { font-family: "Segoe UI", Arial; font-size: 12px; }
#HavaTum { margin: 0px auto 0px auto; width: 520px; padding: 10px; border: 1px solid #ccc; }
.clearboth0 { clear: both; height: 0px; }
.clearboth10 { clear: both; height: 10px; }
.tbl_thmn tbody td, td { text-align: center; padding: 0px; }
.chosen-select1, .chosen-select2 { width: 255px; }
.IlYukle { float: left; }
.IlceYukle { margin-left: 10px; float: left; display: none; }
.VeriYukle { margin-top: 10px; display: none; }
area { outline: none; }
</style>
<link rel="stylesheet" href="chosen/chosen.css">
<link rel="stylesheet" href="chosen/docsupport/prism.css">
<script src="jquery-2.1.1.js"></script>
<script src="chosen/chosen.jquery.js" type="text/javascript"></script>
<script src="chosen/docsupport/prism.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript">
$.Cek2 = function(Ilce) {
	$('.VeriYukle').html("Yükleniyor");
	$.ajax({
		type: "POST",
		url:'cek2.php',
		data: { Ilce: Ilce }
	})
	.done(function(data) {
		$('.VeriYukle').html(data);
	});
};
$.Cek1 = function(Il) {
	$('.IlceYukle').html("Yükleniyor");
	$.ajax({
		type: "POST",
		url:'cek1.php',
		data: { Il: Il }
	})
	.done(function(data) {
		$('.IlceYukle').html(data);
		$(".chosen-select2").chosen();
	});
};
$(document).ready(function() {
	$(".chosen-select1").chosen();
	$(document.body).on('change', '#IlSec' ,function(){
		var Il = $("#IlSec").find("option:selected").val();
		if (Il!=="") { 
		$(".IlceYukle").css("display","block"); 
		$(".VeriYukle").css("display","block"); 
		$.Cek1(Il); $.Cek2(Il); } else { 
		$(".IlceYukle").css("display","none");
		$(".VeriYukle").css("display","none");
		}
	});
	$(document.body).on('change', '#IlceSec' ,function(){
		var Ilce = $("#IlceSec").find("option:selected").val();
		if (Ilce!=="") { 
		$(".VeriYukle").css("display","block"); 
		$.Cek2(Ilce); } else { 
		$(".VeriYukle").css("display","none");
		}
	});
	$("#turkiyeMap area").click( function () {
        var Il2 = $(this).attr("href");
		Il2 = Il2.replace('#','');
		if (Il2!=="") { 
		$(".IlceYukle").css("display","block"); 
		$(".VeriYukle").css("display","block");
		$("#IlSec").val(Il2);
		$(".chosen-select1").trigger("chosen:updated"); 
		$.Cek1(Il2); $.Cek2(Il2); } else { 
		$(".IlceYukle").css("display","none");
		$(".VeriYukle").css("display","none"); 
		}
    });
});
</script>
</head>
<body>
<div id="HavaTum">
<?php $SiteyeBaglan = Baglan("http://www.mgm.gov.tr/tahmin/il-ve-ilceler.aspx"); 
// echo $SiteyeBaglan; 
preg_match('#<div id="divSecim\d+Blok">(.*?)</div>\s+<div style="clear:both;">#',$SiteyeBaglan,$HarIlIlce);
$HaritaIlIlce = str_replace('href="http://www.mgm.gov.tr/tahmin/','href="',$HarIlIlce[1]);
// echo $HaritaIlIlce;
preg_match('#<div id="divSecim\d+Harita">(.*?)</div>\s+<div id="divSecim\d+Il">#',$HaritaIlIlce,$Harita);
$Harita=$Harita[1];
$HaritaLinkDegis=str_replace(array('?m=','#sfB'),array('#',''),$Harita);
echo $HaritaLinkDegis;
preg_match('#<div id="divSecim\d+Il">\s+<ul>(.*?)</ul>\s+</div>#',$HaritaIlIlce,$Il);
$Il=$Il[1];
// echo $Il;
preg_match_all('#<li><a href="\?m=(.*?)\#sfB">(.*?)</a></li>#',$Il,$Iller);
$IlSlug=$Iller[1];
// print_r($IlSlug);
$IlAdi=$Iller[2];
// print_r($IlAdi);
?><div class="clearboth10"></div>
<div class="IlYukle">
<select name="IlSec" id="IlSec" class="chosen-select1">
<option value="">İl Seçiniz</option>
<?php for ($i=0; $i<count($IlSlug); $i++) { ?>
<option value="<?php echo $IlSlug[$i]; ?>"><?php echo $IlAdi[$i]; ?></option>
<?php } ?>
</select>
</div>
<div class="IlceYukle"></div>
<div class="clearboth0"></div>
<div class="VeriYukle"></div>
<div class="clearboth0"></div>
</div>
</body>
</html>