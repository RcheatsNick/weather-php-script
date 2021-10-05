<?php include("fonksiyon.php");
function Cek1($Il) { 
	$IlceyeBaglan = Baglan("http://www.mgm.gov.tr/tahmin/il-ve-ilceler.aspx\?m=".$Il."\#sfB");
	//echo $IlceyeBaglan;
	preg_match('#<div id="divSecim\d+Blok">(.*?)</div>\s+<div style="clear:both;">#',$IlceyeBaglan,$HarIlIlce);
	$HaritaIlIlce = str_replace('href="http://www.mgm.gov.tr/tahmin/','href="',$HarIlIlce[1]);
	// echo $HaritaIlIlce;
	preg_match('#<div id="divSecim\d+Harita">(.*?)</div>\s+<div id="divSecim\d+Il">#',$HaritaIlIlce,$Harita);
	$Harita=$Harita[1];
	preg_match('#<div id="divSecim\d+Ilce">\s+<ul>(.*?)</ul>\s+</div>#',$HaritaIlIlce,$Ilce);
	$Ilce=$Ilce[1];
	// echo $Ilce;
	preg_match_all('#<li><a href="\?m=(.*?)\#sfB">(.*?)</a></li>#',$Ilce,$Ilceler);
	$IlceSlug=$Ilceler[1];
	// print_r($IlceSlug);
	$IlceAdi=$Ilceler[2];
	// print_r($IlceAdi); ?>
	<select name="IlceSec" id="IlceSec" class="chosen-select2">
	<option value="">İlçe Seçiniz</option>
	<?php for ($i=0; $i<count($IlceSlug); $i++) { ?>
	<option value="<?php echo $IlceSlug[$i]; ?>"><?php echo $IlceAdi[$i]; ?></option>
	<?php } ?>
	</select>
<?php
}
if(isset($_POST["Il"])) { 
	$Il = $_POST["Il"];
	if ($Il!="") {
		Cek1($Il);
	}
} ?>