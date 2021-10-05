<?php include("fonksiyon.php");
function Cek2($Ilce) { 
	$VeriBaglan = Baglan("http://www.mgm.gov.tr/tahmin/il-ve-ilceler.aspx?m=".$Ilce."#sfB"); 
	preg_match('#<div id="govde_ust_genis">              <div id="govde_ust_genis_icerik_sayfa">(.*?)</div>         </div>#',$VeriBaglan,$IcerikTum);
	$IcerikTum=$IcerikTum[1];
	// echo $IcerikTum;
	preg_match('#<h1 id="sfB" style="clear:both;">(.*?)</h1>#',$IcerikTum,$IcerikBaslik);
	$IcerikBaslik=$IcerikBaslik[0];
	preg_match('#<div id="divMerkez">(.*?)</div>#',$IcerikTum,$IlceBilgi);
	$IlceBilgi=$IlceBilgi[0];
	preg_match('#<div id="divSonDurum">(.*?)</div>#',$IcerikTum,$SonDurum);
	$SonDurum = $SonDurum[1];
	preg_match('#<div id="divTahmin" style=".*?">\s+<div id="cp_sayfa_tahmin5gunluk">\s+(.*?)\s+</div>\s+</div>#',$IcerikTum,$Tahminler);
	if (!empty($Tahminler)) {
	$Tahminler=$Tahminler[1];
	} ?>
	<div id="VeriGoster">
	<?php if (!empty($IcerikBaslik)) { echo $IcerikBaslik; ?>
	<div class="clearboth10"></div>
	<?php } if (!empty($IlceBilgi)) { echo $IlceBilgi; ?>
	<div class="clearboth10"></div>
	<?php } if (!empty($SonDurum)) { echo $SonDurum; ?>
	<div class="clearboth10"></div>
	<?php } if (!empty($Tahminler)) { echo $Tahminler; } ?>
	</div><?php
}
if(isset($_POST["Ilce"])) { 
	$Ilce = $_POST["Ilce"];
	if ($Ilce!="") {
		Cek2($Ilce);
	}
} ?>