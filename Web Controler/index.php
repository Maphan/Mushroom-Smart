<?php 
require_once('php-object/ArrayList.php');
require_once('php-object/value_object.php');

$ArrayValues=array();
$item=new Value("เห็ดนางรม","28","20","90","70");
array_push($ArrayValues,$item);
$item=new Value("เห็ดนางฟ้า","35","28","90","70");
array_push($ArrayValues,$item);
$item=new Value("เห็ดภูฐาน","32","25","90","70");
array_push($ArrayValues,$item);
$item=new Value("เห็ดเป๋าฮื้อ","32","28","90","70");
array_push($ArrayValues,$item);
$item=new Value("เห็ดหูหนู","35","25","90","80");
array_push($ArrayValues,$item);
$item=new Value("เห็ดขอนขาว","35","30","90","70");
array_push($ArrayValues,$item);
$item=new Value("เห็ดหอม","28","10","90","60");
array_push($ArrayValues,$item);
$item=new Value("หลินจือ","28","26","90","85");
array_push($ArrayValues,$item);
$item=new Value("เห็ดหัวลิง","25","15","70","60");
array_push($ArrayValues,$item);
$item=new Value("เห็ดโคนญี่ปุ่น","30","24","85","80");
array_push($ArrayValues,$item);
?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Smart Farm</title>
	<link href="bootstrap/css/bootstrap.css" rel="stylesheet">
	<link href="css/style.css" rel="stylesheet">
	<link href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet">
	<link href="css/Snackbar.css" rel="stylesheet">
	
	<script src="https://www.gstatic.com/firebasejs/4.12.0/firebase.js"></script>
	
	<style>
		.radio_style{
			width: 35px;
			height: 35px;
		}
	</style>
</head>

<body>
	<div id="header_bar" class="bg-dark py-4">
		<center>
			<img src="images/logo01.png" height="80" />
			<span style="font-size: 35px;color: #FFF">PHARJAN FARM</span>
		</center>
	</div>
	<div class="row mb-3">
		<div class="col-3"></div>
		<div class="col-6" style="height: 60px; background-color: #5C5C5C; color: #FFF; border-radius: 0px 0px 7px 7px;">
			<h5 id="nameMosh" class="text-center pt-3" >Name</h5>
		</div>
		<div class="col-3"></div>
	</div>
	
	<div class="container-fluid pt-4">
		<center>
			<div class="col-12 row p-1">
				<div class="col-md-6">
					<table>
						<tr>
							<td width="50%"></td>
							<td width="50%">
								<b></b>
							</td>
						</tr>
						<tr width="100%">
							<td width="90%" align="right"></td>						
							<td align="right">
								<div class="progress progress-bar-vertical" style="display: flex; float: left">
									<div id="hum" class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="height: 0%;">
									  <b><span id="hum_text">0%</span></b>
									</div>
								</div>
							</td>
							<td align="right">
								<div class="rounded-circle bg-dark box_cricle">
									<p style="font-size: 28px;color: #0EC47E">ความชื้น</p>
									<p id="hum_text_c">0 %</p>
								</div>
							</td>
						</tr>
					</table>
				</div>
				<div class="col-md-6">
					<table>
						<tr>
							<td width="50%"></td>
							<td width="50%">
								<b></b>
							</td>
						</tr>
						<tr width="100%">					
							<td align="left">
								<div class="rounded-circle bg-dark box_cricle">
									<p style="font-size: 28px;color: #0EC47E">อุณหภูมิ</p>
									<p id="temp_text_c">0 °C</p>
								</div>
							</td>
							<td align="left">
								<div class="progress progress-bar-vertical">
									<div id="temp" class="progress-bar bg-danger progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="height: 0%;">
										<b><span id="temp_text">0</span></b>
									</div>
								</div>
							</td>
							<td width="90%" align="left"></td>	
						</tr>
					</table>
				</div>
			</div>
		</center>
		
		
		<!--	////////////////////	-->
		<div class="col-sm-8 offset-2">
			<div class="card bg-transparent mt-5 mb-2" style="border: 1px dashed #868686;">
				<h5 class="card-header text-center">เลือกชนิดเห็ด</h5>
			<div class="card-body row pt-0">
				<div class="col-md-12">	
					<table class="table table-striped">
					  <thead>
						<tr>
						  <th scope="col">#</th>
						  <th scope="col">ชนิดเห็ด</th>
						  <th scope="col">อุณหภูมิ</th>
						  <th scope="col">ความชื้น</th>
						  <th scope="col">เลือก</th>
						</tr>
					  </thead>
					  <tbody>
					  	<?php
							$n=count($ArrayValues);
							for($i=0;$i<$n;$i++){
						?>
						<tr>
						  <th scope="row"><?=$i+1;?></th>
						  <td><?=$ArrayValues[$i]->getName();?></td>
						  <td><?=$ArrayValues[$i]->getMinTemp()."-".$ArrayValues[$i]->getMaxTemp()." °C"?></td>
						  <td><?=$ArrayValues[$i]->getMinHum()."-".$ArrayValues[$i]->getMaxHum()." %"?></td>
						  <td>
						    <input type="radio" name="RadioGroup1" value="radio" id="RadioGroup1"  onFocus="setBrowHT(<?=$ArrayValues[$i]->getMinHum()?>,<?=$ArrayValues[$i]->getMaxHum()?>,<?=$ArrayValues[$i]->getMinTemp()?>,<?=$ArrayValues[$i]->getMaxTemp()?>,'<?=$ArrayValues[$i]->getName()?>')">
					      </td>
						</tr>
						<?php }?>
					  </tbody>
					</table>
				</div>
			</div>			
			</div>
		</div>
		<!--	//Custom T	-->
		<div class="col-sm-8 offset-2">
			<div class="card bg-transparent mt-5 mb-1" style="border: 1px dashed #868686;">
				<h5 class="card-header text-center">ตั้งค่าขอบเขต อุณหภูมิ</h5>
			<div class="card-body row">
				<div class="col-md-6">	
					<center>				
					<div class="col-10 mb-2">
						<div class="form-inline">
							<input id="MinT" class="form-control" type="number" style="width: 150px" placeholder="ค่าต่ำสุด" />
							<button onClick="setBrowT()" class="btn btn-primary btn-sm">save</button>
						</div>
					</div>
					<div class="rounded-circle bg-dark box_cricle-s">
						<p style="font-size: 15px;color: #0EC47E">ต่ำสุด</p>
						<p id="minTemp_text">0 C</p>
					</div>
					</center>
				</div>
				<div class="col-md-6">
					<div class="col-10 mb-2">
						<div class="form-inline">
							<input id="MaxT" class="form-control" type="number" style="width: 150px" placeholder="ค่าสูงสุด" />
							<button onClick="setBrowT()" class="btn btn-primary btn-sm">save</button>
						</div>
					</div>
					<div class="rounded-circle bg-dark box_cricle-s">
							<p style="font-size: 15px;color: #0EC47E">สูงสุด</p>
							<p id="maxTemp_text">0 C</p>
					</div>
				</div>
			</div>			
			</div>
		</div>
		<!--	//Custom value H	-->
		<div class="col-sm-8 offset-2">
			<div class="card bg-transparent mt-5 mb-2" style="border: 1px dashed #868686;">
				<h5 class="card-header text-center">ตั้งค่าขอบเขต ความชื้น</h5>
			<div class="card-body row">
				<div class="col-md-6">	
					<center>				
					<div class="col-10 mb-2">
						<div class="form-inline">
							<input id="MinH" class="form-control" type="number" style="width: 150px" placeholder="ค่าต่ำสุด" />
							<button onClick="setBrowH()" class="btn btn-primary btn-sm">save</button>
						</div>
					</div>
					<div class="rounded-circle bg-dark box_cricle-s">
						<p style="font-size: 15px;color: #0EC47E">ต่ำสุด</p>
						<p id="minHum_text">0 %</p>
					</div>
					</center>
				</div>
				<div class="col-md-6">
					<div class="col-10 mb-2">
						<div class="form-inline">
							<input id="MaxH" class="form-control" type="number" style="width: 150px" placeholder="ค่าสูงสุด" />
							<button onClick="setBrowH()" class="btn btn-primary btn-sm">save</button>
						</div>
					</div>
					<div class="rounded-circle bg-dark box_cricle-s">
							<p style="font-size: 15px;color: #0EC47E">สูงสุด</p>
							<p id="maxHum_text">0 %</p>
					</div>
				</div>
			</div>			
			</div>
		</div>
		
		
	</div>
	<div id="snackbar">text</div>
	
	<script src="bootstrap/jquery-3.2.1.slim.min.js"></script>
	<script src="bootstrap/popper.min.js"></script>	
	<script src="bootstrap/js/bootstrap.min.js"></script>
	<script src="js/jquery.min.js"></script>
	<script src="js/Snackbar.js"></script>
	
	<script type="text/javascript">
		// Initialize Firebase
		var config = {
			apiKey: "AIzaSyBtFcSRw7o0Pzp9FLREqe6YkLrCVPs8f4E",
			authDomain: "testlot-5e8c9.firebaseapp.com",
			databaseURL: "https://testlot-5e8c9.firebaseio.com",
			projectId: "testlot-5e8c9",
			storageBucket: "testlot-5e8c9.appspot.com",
			messagingSenderId: "399867801330"
		};
		firebase.initializeApp(config);
		
		//--GET DATA from Firebase
		$(document).ready(function(){			
			var dataBase=firebase.database();
			dataBase.ref('value').on('value',function(snap){
				var MyValue = snap.val();
				
				$("#hum").css("height", MyValue.Humidity + "%").attr("aria-valuenow", MyValue.Humidity);
				$("#hum_text").text(MyValue.Humidity + " %");
				$("#hum_text_c").text(MyValue.Humidity + " %");
								
				$("#temp").css("height", MyValue.Temperature + "%").attr("aria-valuenow", MyValue.Temperature);
				$("#temp_text").text(MyValue.Temperature + " °C");
				$("#temp_text_c").text(MyValue.Temperature + " °C");
				
				$("#minHum_text").text(MyValue.MinHum + " %");
				$("#MinH").val(MyValue.MinHum);
				$("#maxHum_text").text(MyValue.MaxHum + " %");
				$("#MaxH").val(MyValue.MaxHum);
				
				$("#minTemp_text").text(MyValue.MinTemp + " C");
				$("#MinT").val(MyValue.MinTemp);
				$("#maxTemp_text").text(MyValue.MaxTemp + " C");
				$("#MaxT").val(MyValue.MaxTemp);
				
				$("#nameMosh").text(MyValue.NameMush)
				
			});
			console.log(temp);
			
		});
		
		//set BrowH
		function setBrowH(){
			var newMin = $("#MinH").val();
			var newMax = $("#MaxH").val();
			var nameMush="Custom"
			var dataBase=firebase.database();
			console.log(newMax+" : "+newMin);
			dataBase.ref('value').update({MinHum:parseInt(newMin),MaxHum:parseInt(newMax),NameMush:nameMush});
			Snackbar('success');
		}
		//set BrowT
		function setBrowT(){
			var newMin = $("#MinT").val();
			var newMax = $("#MaxT").val();
			var nameMush="Custom"
			var dataBase=firebase.database();
			console.log(newMax+" : "+newMin);
			dataBase.ref('value').update({MinTemp:parseInt(newMin),MaxTemp:parseInt(newMax),NameMush:nameMush});
			Snackbar('success');
		}
		//set BrowHT
		function setBrowHT(minH,maxH,minT,maxT,nameM){
			var newMinH = minH;
			var newMaxH = maxH;
			var newMinT = minT;
			var newMaxT = maxT;
			var newNameM=nameM;
			console.log(newNameM);
			
			var dataBase=firebase.database();
			console.log(newMaxH+" : "+newMinH);
			dataBase.ref('value').update({
				MinHum:parseInt(newMinH),
				MaxHum:parseInt(newMaxH),
				MinTemp:parseInt(newMinT),
				MaxTemp:parseInt(newMaxT),
				NameMush:newNameM
			});
			Snackbar('success');
		}
	</script>
</body>
</html>
