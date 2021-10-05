<html>
			<head>
						<title>Hava Durumu </title>
						<link rel="stylesheet" type="text/css" href="style.css">
			</head>
			<body>
			<div class='resp_code frms noborders' align=center id='maindiv'>
						<input type='text' name='city' id='city' value='Coimbatore' maxlength=25>
						<input type='submit' value='Click' id='clk'>
						<div class="weather-wrapper hide">
									<table class='table'>
										<tr>
											<td>Konum</td>
											<td class="weather-place"></td>
										</tr>
										<tr>
											<td>Sıcaklık</td>
											<td class="weather-temperature">(<span class="weather-min-temperature"></span> - <span class="weather-max-temperature"></span>)</td>
										</tr>
										<tr>
											<td>Açıklama</td>
											<td class="weather-description capitalize"></td>
										</tr>
										<tr>
											<td>Humidity</td>
											<td class="weather-humidity"></td>
										</tr>
										<tr>
											<td>Rüzgar Hızı</td>
											<td class="weather-wind-speed"></td>
										</tr>
										<tr>
											<td>Sunrise</td>
											<td class="weather-sunrise"></td>
										</tr>
										<tr>
											<td>Sunset</td>
											<td class="weather-sunset"></td>
										</tr>
									</table>
						</div>
						<div  align='center' style="font-size: 10px;color: #dadada;" id="dumdiv">
						<a href="https://www.hscripts.com" id="dum" style="font-size: 10px;color: #dadada;text-decoration:none;color: #dadada;">&copy;h</a>
						</div>
			</div>	
			<script src="jquery.1.9.1.min.js"></script>
			<script src="openWeather.js"></script>	
			<script>
						function chk(){
						var sds = document.getElementById("dum");
						if(sds == null){
							alert("You are using a free package.\n You are not allowed to remove the tag.\n");
						}
						var sdss = document.getElementById("dumdiv");
						if(sdss == null){
							alert("You are using a free package.\n You are not allowed to remove the tag.\n");
							document.getElementById("maindiv").style.visibility="hidden";
						}
						}
					window.onload=chk;
				$(document).ready(function() {
					$('#city').bind('keyup blur',function(){ 
					var node = $(this);
					node.val(node.val().replace(/[^a-z]/g,'') ); }
				);
				$("#clk").click(function(){
					var city = $("#city").val();
					//alert(city);
					$('.weather-temperature').openWeather({
						key: 'ab8b2f0d83f4ad02aaaeabe6d8d77895',
						city: city+', IN',
						descriptionTarget: '.weather-description',
						windSpeedTarget: '.weather-wind-speed',
						minTemperatureTarget: '.weather-min-temperature',
						maxTemperatureTarget: '.weather-max-temperature',
						humidityTarget: '.weather-humidity',
						sunriseTarget: '.weather-sunrise',
						sunsetTarget: '.weather-sunset',
						placeTarget: '.weather-place',
						success: function() {			
							//show weather
							$('.weather-wrapper').show();
							
						},
						error: function(message) {			
							console.log(message);
							$('.weather-wrapper').hide();
							alert("Enter City Name Properly.");			
						}
					});
				});
				});
			
			</script>	
			</body>
</html>



	
	
	
