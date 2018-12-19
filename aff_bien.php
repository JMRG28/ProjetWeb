<?php
include "header.php";
include "bd.php";
include "Bien.php";

ini_set("display_errors",1);error_reporting(E_ALL);

function conversion($d){
	$nd=explode("/",$d);
	$r=[];
	array_push($r, $nd[2], $nd[1],$nd[0]);
	$res=implode("-",$r);
	return $res;
}

function conversion2($d){
	$nd=explode(" ",$d);
	return $nd[0];
}

if (!isset($_SESSION['member'])){
	header('Location: login2.php');
}
else{
	$bien=new Bien(null,null,null,null,null,null,null,null,null);
	$bien->getFromURL($_GET["bid"]);
	$member=unserialize($_SESSION['member']);
	if(isset($_POST["reserver"]) && isset($_POST["date_deb"]) && isset($_POST["date_fin"]) && $bien->Prop->Email!=$member->Email){
		if(strtotime(conversion($_POST["date_deb"]))<strtotime(conversion($_POST["date_fin"]))){
			if(strtotime(conversion($_POST["date_deb"]))>strtotime(date("Y-m-d"))){
				$bd = new PDO("mysql:host=$servername;port=$port;dbname=$dbname;charset=UTF8", $username, $password); $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$peutReserver=true;
				foreach($bd->query('SELECT * FROM CONSOMMATION_B where ID_Bien="'.$bien->ID_Bien.'"') as $row){
					if((strtotime(conversion($_POST["date_deb"]))>=strtotime($row["DateDeb"]) && strtotime(conversion($_POST["date_deb"]))<=strtotime($row["DateFin"]))
					|| (strtotime(conversion($_POST["date_fin"]))>=strtotime($row["DateDeb"]) && strtotime(conversion($_POST["date_fin"]))<=strtotime($row["DateFin"]))){
						$peutReserver=false;
					}
				}
				if($peutReserver){
					$stmt = $bd->prepare("INSERT INTO CONSOMMATION_B (EmailConso, ID_Bien, DateDeb,DateFin)VALUES (:EmailConso, :ID_Bien, :DateDeb,:DateFin)");
					$stmt->bindValue(":EmailConso", $member->Email);
					$stmt->bindValue(":ID_Bien",$bien->ID_Bien);
					$stmt->bindValue(":DateDeb", conversion($_POST["date_deb"]));
					$stmt->bindValue(":DateFin", conversion($_POST["date_fin"]));
					$stmt->execute();
					$member->Recu+=1;
					$_SESSION["member"]=serialize($member);
				}else{
					echo "<h1> Erreur: Vous ne pouvez pas réserver ce bien</h1>";
				}
			}else{
				echo "<h1> Erreur: La date de début est dans le passé! </h1>";
			}
		}else{
			echo "<h1> Erreur: La date de début est après la date de fin! </h1>";
		}
	}
}
?>

<!DOCTYPE html>
<html lang="en" >

<head>
	<meta charset="UTF-8">
	<title></title>
	<meta name="viewport"
	content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
	<link rel="stylesheet" href="css/style_profile.css">
	<link rel="stylesheet" href="css/main.css">

	<!-- Icons font CSS-->
	<link href="js/vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
	<link href="js/vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
	<!-- Font special for pages-->
	<link href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

	<!-- Vendor CSS-->
	<link href="js/vendor/select2/select2.min.css" rel="stylesheet" media="all">
	<link href="js/vendor/datepicker/daterangepicker.css" rel="stylesheet" media="all">

	<!-- Main CSS-->
	<link rel="stylesheet" href="css/menu.css">
	<link href="css/style_register.css" rel="stylesheet" media="all">
	<style>
	#bla
	{
		text-align:center;

	}
	#bla1, #bla2
	{
		width:40%;
		margin:30px;
		display: inline-block;
	}
	</style>
	<script src="js/OpenLayers-2.13.1/OpenLayers.js"></script>
	<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
	<style>
	#Map {
		border-radius: 10px;
		overflow: hidden;
	}

	#Map div canvas{
		border-radius: 10px;
	}
	#OpenLayers_Control_Attribution_7{
		bottom:0;
	}
	#OL_Icon_22_innerImage{
		border:2px solid #021a40;
		border-radius: 50%;
	}
</style>
<script>
function getDistance(lat1,lon1,lat2,lon2) {
	var R = 6371;
	var dLat = deg2rad(lat2-lat1);
	var dLon = deg2rad(lon2-lon1);
	var a =
	Math.sin(dLat/2) * Math.sin(dLat/2) +
	Math.cos(deg2rad(lat1)) * Math.cos(deg2rad(lat2)) *
	Math.sin(dLon/2) * Math.sin(dLon/2)
	;
	var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a));
	var d = R * c;
	return d;
}

function deg2rad(deg) {
	return deg * (Math.PI/180)
}
function loadMap(){
	var latU;
	var lngU;
	var latU2;
	var lngU2;
	$.getJSON('https://api.opencagedata.com/geocode/v1/json?q='+document.getElementById("add2").value+'&key=816e747854f64c8389a43b269e5b74d9&language=en&pretty=1',
	function(data){
		console.log(data)
		latU2=data["results"][0]["geometry"]["lat"];
		lngU2=data["results"][0]["geometry"]["lng"];
		$.getJSON('https://api.opencagedata.com/geocode/v1/json?q='+document.getElementById("add").value+'&key=816e747854f64c8389a43b269e5b74d9&language=en&pretty=1',
		function(a){
			console.log(a);
			latU=a["results"][0]["geometry"]["lat"];
			lngU=a["results"][0]["geometry"]["lng"];
			var lat            = latU;
			var lon            = lngU;
			var zoom           = 14;
			console.log(lat);
			console.log(lon);
			var newBound = new OpenLayers.Bounds();
			var fromProjection = new OpenLayers.Projection("EPSG:4326");   // Transform from WGS 1984
			var toProjection   = new OpenLayers.Projection("EPSG:900913"); // to Spherical Mercator Projection
			var position       = new OpenLayers.LonLat(lon, lat).transform( fromProjection, toProjection);
			newBound.extend(position);
			var position2       = new OpenLayers.LonLat(lngU2, latU2).transform( fromProjection, toProjection);
			newBound.extend(position2);

			map = new OpenLayers.Map("Map");
			var mapnik         = new OpenLayers.Layer.OSM();
			map.addLayer(mapnik);

			var markers = new OpenLayers.Layer.Markers( "Markers" );
			map.addLayer(markers);

			var size = new OpenLayers.Size(30,30);
			var offset = new OpenLayers.Pixel(-(size.w/2), -size.h);
			console.log(document.getElementById("pic").value);
			var icon = new OpenLayers.Icon(document.getElementById("pic").value,size,offset);
			markers.addMarker(new OpenLayers.Marker(position,icon));

			var markers2 = new OpenLayers.Layer.Markers( "Markers" );
			map.addLayer(markers2);
			markers2.addMarker(new OpenLayers.Marker(position2));

			var vector = new OpenLayers.Layer.Vector();
			vector.addFeatures([new OpenLayers.Feature.Vector(new OpenLayers.Geometry.LineString([position, position2]))]);
			map.addLayers([vector]);
			map.zoomToExtent(newBound);

			var dst = getDistance(lon, lat,lngU2, latU2)
			console.log(dst);
			document.getElementById("dst").innerHTML="Distance: "+dst.toFixed(2)+" km";


		});
	});
}
</script>

</head>

<body onload="loadMap()">

	<div class="wrapper">

		<div class="profile-card js-profile-card">
			<div class="profile-card__img">
				<a href="<?php echo 'profile2.php?uid='.$bien->Prop->URL;?>">
					<img src="<?php echo $bien->Prop->Photo;?>"  alt="profile card">
				</a>
			</div>

			<div class="profile-card__cnt js-profile-cnt">
				<div class="profile-card__txt"><?php echo $bien->Prop->Prenom." ".$bien->Prop->Nom; ?> </div>

				<div class="profile-card__name"><?php echo $bien->Titre; ?> </div>
				<div class="profile-card__txt">Prix :<strong><?php echo $bien->PrixNeuf."€";?></strong></div>
				<div class="profile-card__txt"><strong>"</strong><?php echo $bien->Descriptif;?><strong>"</strong></div>

				<div class="profile-card__txt">
					<img style="height:300px;" src="<?php echo $bien->Photo;?>" alt="profile card">
				</div>
				<div class="profile-card-loc">
					<span class="profile-card-loc__icon">
						<svg class="icon"><use xlink:href="#icon-location"></use></svg>
					</span>

					<span class="profile-card-loc__txt">
						<?php echo $bien->Prop->Adresse;?>
					</span>

				</div>
				<br>

				<br>
				<br>
				<div class="profile-card-loc">
					<input type="text" value="<?php echo $member->Adresse;?>" id="add" hidden>
					<input type="text" value="<?php echo $bien->Prop->Adresse;?>" id="add2" hidden>
					<input type="text" value="<?php echo $member->Photo;?>" id="pic" hidden>
					<div id="Map" style="height:350px; width:80%;"></div>
				</div>
				<br>
				<h5 id="dst" ></h5>

				<div id="Dispo">
					<h6>Bien réservé :</h6>
					<ul>
						<?php
						$bd = new PDO("mysql:host=$servername;port=$port;dbname=$dbname;charset=UTF8", $username, $password); $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
						foreach ($bd->query("SELECT * FROM CONSOMMATION_B WHERE ID_Bien='".$bien->ID_Bien."'") as $row){
							if(strtotime($row["DateFin"])>=strtotime(date("Y-m-d"))){
								echo "<li>".conversion2($row["DateDeb"])." - ".conversion2($row["DateFin"])."<li></br>";
							}
						}
						?>

					</ul>
				</div>
				<div id="bla" class="profile-card-ctr">
					<form action="" method="post">
						<div id="bla1" class="col-2">
							<div class="input-group">
								<label class="label">Date de Debut</label>
								<div class="input-group-icon">
									<input class="input--style-4 js-datepicker" type="text" name="date_deb" autocomplete="off">
								</div>
							</div>
						</div>

						<div id="bla2" class="col-2">
							<div class="input-group">
								<label class="label">Date de Fin</label>
								<div class="input-group-icon">
									<input class="input--style-4 js-datepicker" type="text" name="date_fin" autocomplete="off">
								</div>
							</div>
						</div>
						<button name="reserver" type="submit" class="profile-card__button button--blue js-message-btn">Réserver</button>

					</form>
				</div>
			</div>


		</div>

	</div>

	<svg hidden="hidden">
		<defs>


			<symbol id="icon-location" viewBox="0 0 32 32">
				<title>location</title>
				<path d="M16 31.68c-0.352 0-0.672-0.064-1.024-0.16-0.8-0.256-1.44-0.832-1.824-1.6l-6.784-13.632c-1.664-3.36-1.568-7.328 0.32-10.592 1.856-3.2 4.992-5.152 8.608-5.376h1.376c3.648 0.224 6.752 2.176 8.608 5.376 1.888 3.264 2.016 7.232 0.352 10.592l-6.816 13.664c-0.288 0.608-0.8 1.12-1.408 1.408-0.448 0.224-0.928 0.32-1.408 0.32zM15.392 2.368c-2.88 0.192-5.408 1.76-6.912 4.352-1.536 2.688-1.632 5.92-0.288 8.672l6.816 13.632c0.128 0.256 0.352 0.448 0.64 0.544s0.576 0.064 0.832-0.064c0.224-0.096 0.384-0.288 0.48-0.48l6.816-13.664c1.376-2.752 1.248-5.984-0.288-8.672-1.472-2.56-4-4.128-6.88-4.32h-1.216zM16 17.888c-3.264 0-5.92-2.656-5.92-5.92 0-3.232 2.656-5.888 5.92-5.888s5.92 2.656 5.92 5.92c0 3.264-2.656 5.888-5.92 5.888zM16 8.128c-2.144 0-3.872 1.728-3.872 3.872s1.728 3.872 3.872 3.872 3.872-1.728 3.872-3.872c0-2.144-1.76-3.872-3.872-3.872z"></path>
				<path d="M16 32c-0.384 0-0.736-0.064-1.12-0.192-0.864-0.288-1.568-0.928-1.984-1.728l-6.784-13.664c-1.728-3.456-1.6-7.52 0.352-10.912 1.888-3.264 5.088-5.28 8.832-5.504h1.376c3.744 0.224 6.976 2.24 8.864 5.536 1.952 3.36 2.080 7.424 0.352 10.912l-6.784 13.632c-0.32 0.672-0.896 1.216-1.568 1.568-0.48 0.224-0.992 0.352-1.536 0.352zM15.36 0.64h-0.064c-3.488 0.224-6.56 2.112-8.32 5.216-1.824 3.168-1.952 7.040-0.32 10.304l6.816 13.632c0.32 0.672 0.928 1.184 1.632 1.44s1.472 0.192 2.176-0.16c0.544-0.288 1.024-0.736 1.28-1.28l6.816-13.632c1.632-3.264 1.504-7.136-0.32-10.304-1.824-3.104-4.864-5.024-8.384-5.216h-1.312zM16 29.952c-0.16 0-0.32-0.032-0.448-0.064-0.352-0.128-0.64-0.384-0.8-0.704l-6.816-13.664c-1.408-2.848-1.312-6.176 0.288-8.96 1.536-2.656 4.16-4.32 7.168-4.512h1.216c3.040 0.192 5.632 1.824 7.2 4.512 1.6 2.752 1.696 6.112 0.288 8.96l-6.848 13.632c-0.128 0.288-0.352 0.512-0.64 0.64-0.192 0.096-0.384 0.16-0.608 0.16zM15.424 2.688c-2.784 0.192-5.216 1.696-6.656 4.192-1.504 2.592-1.6 5.696-0.256 8.352l6.816 13.632c0.096 0.192 0.256 0.32 0.448 0.384s0.416 0.064 0.608-0.032c0.16-0.064 0.288-0.192 0.352-0.352l6.816-13.664c1.312-2.656 1.216-5.792-0.288-8.352-1.472-2.464-3.904-4-6.688-4.16h-1.152zM16 18.208c-3.424 0-6.24-2.784-6.24-6.24 0-3.424 2.816-6.208 6.24-6.208s6.24 2.784 6.24 6.24c0 3.424-2.816 6.208-6.24 6.208zM16 6.4c-3.072 0-5.6 2.496-5.6 5.6 0 3.072 2.528 5.6 5.6 5.6s5.6-2.496 5.6-5.6c0-3.104-2.528-5.6-5.6-5.6zM16 16.16c-2.304 0-4.16-1.888-4.16-4.16s1.888-4.16 4.16-4.16c2.304 0 4.16 1.888 4.16 4.16s-1.856 4.16-4.16 4.16zM16 8.448c-1.952 0-3.552 1.6-3.552 3.552s1.6 3.552 3.552 3.552c1.952 0 3.552-1.6 3.552-3.552s-1.6-3.552-3.552-3.552z"></path>
			</symbol>


			<symbol id="icon-behance" viewBox="0 0 32 32">
				<title>behance</title>
				<path d="M9.281 6.412c0.944 0 1.794 0.081 2.569 0.25 0.775 0.162 1.431 0.438 1.988 0.813 0.55 0.375 0.975 0.875 1.287 1.5 0.3 0.619 0.45 1.394 0.45 2.313 0 0.994-0.225 1.819-0.675 2.481-0.456 0.662-1.119 1.2-2.006 1.625 1.213 0.35 2.106 0.962 2.706 1.831 0.6 0.875 0.887 1.925 0.887 3.163 0 1-0.194 1.856-0.575 2.581-0.387 0.731-0.912 1.325-1.556 1.781-0.65 0.462-1.4 0.8-2.237 1.019-0.831 0.219-1.688 0.331-2.575 0.331h-9.544v-19.688h9.281zM8.719 14.363c0.769 0 1.406-0.181 1.906-0.55 0.5-0.363 0.738-0.963 0.738-1.787 0-0.456-0.081-0.838-0.244-1.131-0.169-0.294-0.387-0.525-0.669-0.688-0.275-0.169-0.588-0.281-0.956-0.344-0.356-0.069-0.731-0.1-1.113-0.1h-4.050v4.6h4.388zM8.956 22.744c0.425 0 0.831-0.038 1.213-0.125 0.387-0.087 0.731-0.219 1.019-0.419 0.287-0.194 0.531-0.45 0.706-0.788 0.175-0.331 0.256-0.756 0.256-1.275 0-1.012-0.287-1.738-0.856-2.175-0.569-0.431-1.325-0.644-2.262-0.644h-4.7v5.419h4.625z"></path>
				<path d="M22.663 22.675c0.587 0.575 1.431 0.863 2.531 0.863 0.788 0 1.475-0.2 2.044-0.6s0.913-0.825 1.044-1.262h3.45c-0.556 1.719-1.394 2.938-2.544 3.675-1.131 0.738-2.519 1.113-4.125 1.113-1.125 0-2.131-0.181-3.038-0.538-0.906-0.363-1.663-0.869-2.3-1.531-0.619-0.663-1.106-1.45-1.45-2.375-0.337-0.919-0.512-1.938-0.512-3.038 0-1.069 0.175-2.063 0.525-2.981 0.356-0.925 0.844-1.719 1.494-2.387s1.413-1.2 2.313-1.588c0.894-0.387 1.881-0.581 2.975-0.581 1.206 0 2.262 0.231 3.169 0.706 0.9 0.469 1.644 1.1 2.225 1.887s0.994 1.694 1.25 2.706c0.256 1.012 0.344 2.069 0.275 3.175h-10.294c0 1.119 0.375 2.188 0.969 2.756zM27.156 15.188c-0.462-0.512-1.256-0.794-2.212-0.794-0.625 0-1.144 0.106-1.556 0.319-0.406 0.213-0.738 0.475-0.994 0.787-0.25 0.313-0.425 0.65-0.525 1.006-0.1 0.344-0.163 0.663-0.181 0.938h6.375c-0.094-1-0.438-1.738-0.906-2.256z"></path>
				<path d="M20.887 8h7.981v1.944h-7.981v-1.944z"></path>
			</symbol>

			<symbol id="icon-link" viewBox="0 0 32 32">
				<title>link</title>
				<path d="M17.984 11.456c-0.704 0.704-0.704 1.856 0 2.56 2.112 2.112 2.112 5.568 0 7.68l-5.12 5.12c-2.048 2.048-5.632 2.048-7.68 0-1.024-1.024-1.6-2.4-1.6-3.84s0.576-2.816 1.6-3.84c0.704-0.704 0.704-1.856 0-2.56s-1.856-0.704-2.56 0c-1.696 1.696-2.624 3.968-2.624 6.368 0 2.432 0.928 4.672 2.656 6.4 1.696 1.696 3.968 2.656 6.4 2.656s4.672-0.928 6.4-2.656l5.12-5.12c3.52-3.52 3.52-9.248 0-12.8-0.736-0.672-1.888-0.672-2.592 0.032z"></path>
				<path d="M29.344 2.656c-1.696-1.728-3.968-2.656-6.4-2.656s-4.672 0.928-6.4 2.656l-5.12 5.12c-3.52 3.52-3.52 9.248 0 12.8 0.352 0.352 0.8 0.544 1.28 0.544s0.928-0.192 1.28-0.544c0.704-0.704 0.704-1.856 0-2.56-2.112-2.112-2.112-5.568 0-7.68l5.12-5.12c2.048-2.048 5.632-2.048 7.68 0 1.024 1.024 1.6 2.4 1.6 3.84s-0.576 2.816-1.6 3.84c-0.704 0.704-0.704 1.856 0 2.56s1.856 0.704 2.56 0c1.696-1.696 2.656-3.968 2.656-6.4s-0.928-4.704-2.656-6.4z"></path>
			</symbol>
		</defs>
	</svg>

	<script  src="js/profile.js"></script>
	<!-- Jquery JS-->
	<script src="js/vendor/jquery/jquery.min.js"></script>
	<!-- Vendor JS-->
	<script src="js/vendor/select2/select2.min.js"></script>
	<script src="js/vendor/datepicker/moment.min.js"></script>
	<script src="js/vendor/datepicker/daterangepicker.js"></script>

	<!-- Main JS-->
	<script src="js/global.js"></script>
</body>

</html>
