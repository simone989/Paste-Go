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
							<li class="active"><a href="CaricoF.html">Upload</a></li>
							<li><a href="downloads.html">Downloads</a></li>
							<li ><a href="controllo.html">Controllo</a></li>
							
							<li class="last"><a href="contacts.html">Contacts</a></li>
						</ul>
					</nav>
				</header>




<?php
if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    $ip = $_SERVER['HTTP_CLIENT_IP'];
} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
} else {
    $ip = $_SERVER['REMOTE_ADDR'];
}

//percorso della cartella dove mettere i file caricati dagli utentiip = new ZipArchive();


$uploaddir = '/var/www/html/site/DirUp/';

//Recupero il percorso temporaneo del file
$userfile_tmp = $_FILES['userfile']['tmp_name'];

//recupero il nome originale del file caricato
$userfile_name = $_FILES['userfile']['name'];


$mysqli = new mysqli('localhost', 'root', '', 'PasteGo');
    if ($mysqli->connect_error) {
        die('Errore di connessione (' . $mysqli->connect_errno . ') '
        . $mysqli->connect_error);
    } else {
     //   echo 'Connesso. ' . $mysqli->host_info . "<br>";
    }



$risultato2 = $mysqli->query("SELECT * FROM file WHERE Codice =".$_POST['Code']." ");

/*
if ($risultato2->num_rows > 0) {
    // output data of each row
    while($row = $risultato2->fetch_assoc()) {
        echo "id: " . $row["ID"]. " - Name: " . $row["Codice"];
        echo "<br>";
    }
} else {
    echo "0 results";
}
*/

if($risultato2->num_rows==1){
 	$_POST['Code']=rand(1000,9999);
 	echo "CODICE GIA' PRESENTE DEL DB, IL TUO NUOVO CODICE E': <br>";
 	echo $_POST['Code']."<br>";
}



$today = getdate();
$timeI= $today['hours'].":".$today['minutes'].":".$today['seconds'];
$dateI= $today['year']."-".$today['mon']."-".$today['mday'];

if($today['minutes']>=50){
	
switch ($today['minutes']) {
	case 50:
		$today['minutes']=0;
		break;
	case 51:
		$today['minutes']=1;
		break;
	case 52:
		$today['minutes']=2;
		break;
	case 53:
		$today['minutes']=3;
		break;
	case 54:
		$today['minutes']=4;
		break;
	case 55:
		$today['minutes']=5;
		break;
	case 56:
		$today['minutes']=6;
		break;
	case 57:
		$today['minutes']=7;
		break;
	case 58:
		$today['minutes']=8;
		break;
	case 59:
		$today['minutes']=9;
		break;

}
$today['hours']+=1;
$oraFV=$today['hours'].":".$today['minutes'].":".$today['seconds'];

}else{
 $today['minutes']+=10;
 $oraFV=$today['hours'].":".$today['minutes'].":".$today['seconds'];

}



// per prima cosa verifico che il file sia stato effettivamente caricato
if (!isset($_FILES['userfile']) || !is_uploaded_file($_FILES['userfile']['tmp_name'])) {
  echo 'Non hai inviato nessun file... <br>';
  exit;    
}


//copio il file dalla sua posizione temporanea alla mia cartella upload
if (move_uploaded_file($userfile_tmp, $uploaddir . $userfile_name)) {
  //Se l'operazione è andata a buon fine...
  echo 'File inviato con successo.';
  echo "<br>";
  echo "Il tuo codice univoco e'" ; 
  echo  "<h3>".$_POST['Code']."</3>";


$percorsoI=$userfile_name;
$sql = "INSERT INTO file(Codice,Ip,percorso,data,ora,oraF)
VALUES(".$_POST['Code'].",'".$ip."', '".$percorsoI."','".$dateI."','".$timeI."','".$oraFV."');
";


$sql2= "INSERT INTO FileTot(Codice,Ip,percorso,data,ora,oraF)
VALUES(".$_POST['Code'].",'".$ip."', '".$percorsoI."','".$dateI."','".$timeI."','".$oraFV."');
";

if ($mysqli->query($sql) === TRUE) {
	$mysqli->query($sql2);
 //   echo "OK <br>";
} else {
    echo "<br>Error " . $mysqli->error."<br>";
}

}else{
  //Se l'operazione è fallta...
  echo 'Upload NON valido!'; 
}


$mysqli->close();
?>


</body>

</dhtml>
