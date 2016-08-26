<!DOCTYPE html>
<html lang="en">
	<head>
		<title></title>
		<meta charset="utf-8">
		<link rel="stylesheet" href="css/reset.css" type="text/css" media="screen">
		<link rel="stylesheet" href="css/style.css" type="text/css" media="screen">
		<link rel="stylesheet" href="css/grid.css" type="text/css" media="screen">
		<script src="js/jquery-1.6.3.min.js" type="text/javascript"></script>

	</head>
	<body id="page3">
		<div class="extra">
			<div class="main">
<!--==============================header=================================-->
				<header>
					<div class="wrapper p4">
						<h1><a href="index.html">Software</a></h1>
						<ul class="list-services">
							<li><a href="#">Site Map</a></li>
							<li><a href="#">Help</a></li>
							<li><a href="#">FAQs</a></li>
						</ul>
					</div>
					<nav>
						<ul class="menu">
							<li><a href="index.html">Home</a></li>
							<li><a href="CaricoF.html">Upload</a></li>
							<li><a href="downloads.html">Downloads</a></li>
							<li class="active"><a href="controllo.html">Controllo</a></li>
							
							<li class="last"><a href="contacts.html">Contacts</a></li>
						</ul>
					</nav>
				</header>



<div id="Pannello">
<?php


$mysqli = new mysqli('localhost', 'root', '', 'PasteGo');
    if ($mysqli->connect_error) {
        die('Errore di connessione (' . $mysqli->connect_errno . ') '
        . $mysqli->connect_error);
    } else {
        echo 'Connesso. ' . $mysqli->host_info . "<br>";
    }


$query2= $mysqli->query("Select * from UtentiAdmin where Username= '".$_POST['UserName']."'");

if($query2->num_rows>0){
echo "UTENTE GIA' PRESENTE, INSEIRE UN NOME UTENTE DIVERSO <BR>";

}else{


$sql="INSERT INTO UtentiAdmin(Username,Password) VALUES('".$_POST['UserName']."','".$_POST['password']."') ";


 if($mysqli->query($sql)===TRUE) echo "OK UTENTE CREATO <br>";
        else  echo "<br>Error " . $mysqli->error."<br>";

}

?>
</div>
	</body>
</html>
