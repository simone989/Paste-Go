<!DOCTYPE html>
<html lang="en">
<script src="Chart.js">	</script>
<script type="text/javascript">
	var Vx='';
	var Vx2='';
	var Vx3='';
	var Vx4='';
function stampa(x){
	var y= document.getElementById("Pannello");
	y.innerHTML=x;
}
function grafico2(){
	stampa("<table><tr><TD>Grafico Caricamento file giornalieri</TD><TD>Grafico Download giornalieri</TD></tr><tr><td><canvas id='myChart' width='400' height='400'></canvas></td><td><canvas id='myChart2' width='400' height='400'></canvas></td></tr></table>");

var ctx = document.getElementById("myChart").getContext("2d");
// This will get the first returned node in the jQuery collection.
var myNewChart = new Chart(ctx);
myNewChart.Bar(data, options);

var ctx2 = document.getElementById("myChart2").getContext("2d");
// This will get the first returned node in the jQuery collection.
var myNewChart = new Chart(ctx2);
myNewChart.Bar(data2, options);



}



var options={

    ///Boolean - Whether grid lines are shown across the chart
    scaleShowGridLines : true,

    //String - Colour of the grid lines
    scaleGridLineColor : "rgba(0,0,0,.05)",

    //Number - Width of the grid lines
    scaleGridLineWidth : 1,

    //Boolean - Whether to show horizontal lines (except X axis)
    scaleShowHorizontalLines: true,

    //Boolean - Whether to show vertical lines (except Y axis)
    scaleShowVerticalLines: true,

    //Boolean - Whether the line is curved between points
    bezierCurve : true,

    //Number - Tension of the bezier curve between points
    bezierCurveTension : 0.4,

    //Boolean - Whether to show a dot for each point
    pointDot : true,

    //Number - Radius of each point dot in pixels
    pointDotRadius : 4,

    //Number - Pixel width of point dot stroke
    pointDotStrokeWidth : 1,

    //Number - amount extra to add to the radius to cater for hit detection outside the drawn point
    pointHitDetectionRadius : 20,

    //Boolean - Whether to show a stroke for datasets
    datasetStroke : true,

    //Number - Pixel width of dataset stroke
    datasetStrokeWidth : 2,

    //Boolean - Whether to fill the dataset with a colour
    datasetFill : true,

    //String - A legend template
    legendTemplate : "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].strokeColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>"

};

</script>
<style type="text/css">
	
	table{
		width: 100%;
		border:6px;

	}

	#Pannello{
		margin-bottom: 120px;

	}
</style>


<?php
$VarStampa='';


	$VarStampa='';
	
	$mysqli = new mysqli('localhost', 'root', '1404', 'PasteGo');
	    if ($mysqli->connect_error) {
	        die('Errore di connessione (' . $mysqli->connect_errno . ') '
	        . $mysqli->connect_error);
	    } else {
	    //    echo 'Connesso. ' . $mysqli->host_info . "<br>";
	    }

$query1= $mysqli->query("SELECT ElencoDown.Chiavedown, ElencoDown.CodFile,ElencoDown.Ipdown, ElencoDown.dateG, ElencoDown.ora  FROM ElencoDown");

	if($query1->num_rows>0){
		$VarStampa="ELENCO Download:<BR> <table ><tr><td>CHIAVEDOWN </td> <td>CodFile </td> <td>Ipdown </td> <td>Dataora </td></tr>";

		while($row=$query1->fetch_assoc()){
			$VarStampa=$VarStampa."<tr><td>".$row["Chiavedown"]."</td><td>".$row["CodFile"]."</td><td>".$row["Ipdown"]."</td><td>".$row["dateG"]."</td><td>".$row["ora"]."</td></tr>";
		}
		$VarStampa=$VarStampa."</table><br><br>";

	echo "<script >Vx='".$VarStampa."'</script>";
	
 }




	
	$mysqli = new mysqli('localhost', 'root', '1404', 'PasteGo');
	    if ($mysqli->connect_error) {
	        die('Errore di connessione (' . $mysqli->connect_errno . ') '
	        . $mysqli->connect_error);
	    } else {
	    //    echo 'Connesso. ' . $mysqli->host_info . "<br>";
	    }

$query1= $mysqli->query("SELECT file.ID,file.Codice,file.percorso,file.data,file.ora,file.oraF FROM file");

	if($query1->num_rows>0){
		$VarStampa2="ELENCO FILE:<BR><table ><tr><td>ID </td> <td>Codice </td> <td>Percorso </td> <td>Data </td> <td>Ora </td><td>OraF </td></tr>";
		while($row=$query1->fetch_assoc()){

			$VarStampa2=$VarStampa2."<tr><td>".$row["ID"]."</td><td>".$row["Codice"]."</td><td>".$row["percorso"]."</td><td>".$row["data"]."</td><td>".$row["ora"]."</td><td>".$row["oraF"]."</td></tr>";
		}
		$VarStampa2=$VarStampa2."</table><br><br>";

	echo "<script >Vx2='".$VarStampa2."'</script>";
 }

	
	$mysqli = new mysqli('localhost', 'root', '1404', 'PasteGo');
	    if ($mysqli->connect_error) {
	        die('Errore di connessione (' . $mysqli->connect_errno . ') '
	        . $mysqli->connect_error);
	    } else {
	    //    echo 'Connesso. ' . $mysqli->host_info . "<br>";
	    }

$query1= $mysqli->query("SELECT Filecancellati.id,Filecancellati.percorso,Filecancellati.datacaricamento, Filecancellati.oracaricamento,Filecancellati.codice, Filecancellati.ip,Filecancellati.dataoracancellamento FROM Filecancellati");

	$VarStampa3="ELENCO FILE CANCELLATI:<BR><table ><tr><td>Id </td> <td>Percprsp </td> <td>Data Caricamento </td> <td>Ora Caricamento </td> <td>Codice </td><td>Ip </td><td>Data Ora Cancellamento</td></tr>";
	if($query1->num_rows>0){


		while($row=$query1->fetch_assoc()){
			$VarStampa3=$VarStampa3."<tr><td>".$row["id"]."</td><td>".$row["percorso"]."</td><td>".$row["datacaricamento"]."</td><td>".$row["oracaricamento"]."</td><td>".$row["codice"]."</td><td>".$row["ip"]."</td><td>".$row["dataoracancellamento"]."</td></tr>";
		}

		$VarStampa3=$VarStampa3."</table><br><br>";

echo "<script >Vx3='".$VarStampa3."'</script>";

 }

?>
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

<?php

if(isset($_POST["UserName"]) && (isset($_POST["password"]))){
	$mysqli = new mysqli('localhost', 'root', '1404', 'PasteGo');
	    if ($mysqli->connect_error) {
	        die('Errore di connessione (' . $mysqli->connect_errno . ') '
	        . $mysqli->connect_error);
	    } else {
	    //    echo 'Connesso. ' . $mysqli->host_info . "<br>";
	    }

	$query1= $mysqli->query("SELECT Username, Password FROM UtentiAdmin");

	if($query1->num_rows>0){
		while($row = $query1->fetch_assoc()){
			if($row["Username"]==$_POST["UserName"] && $row["Password"]==$_POST["password"]){

				echo "
				<br>
				<br>
				<div id='pannello2'>
			<button name='grafico' onclick='grafico2()'> Grafico</button>
			<button name='down' onclick='stampa(Vx)'>Elenco Download </button>
			<button name='file' onclick='stampa(Vx2)'>Elenco File </button>
			<button name='fileC' onclick='stampa(Vx3)'>Elenco File Cancellati </button>
			<br><br>
			AGGIUNGERE NUOVO UTENTI ADMIN:
			<form name='input' action='InserimetoU.php' method='post' enctype='multipart/form-data'>
		<b>UserName</b>
		<input type='text' name='UserName' >
		<br>
		<b>Password</b>
		<input type='password' name='password'  >
		<br>
		<input type='submit' value='Aggiungi utente' name='submit'>
		

		</form>
<br>
<br>
<br>


				</div>";

//				ElencoDow();
//				ElencoFile();
//				ElencoFileC();
			}
		}
		
	

	}

	

}


?>



<div id="Pannello">
<table>
<tr>
<td>
<canvas id="myChart" width="400" height="400"></canvas>
</td><td>
<canvas id="myChart2" width="400" height="400"></canvas>
</td>
</tr>
</table>
</div>
<?php



$ELENCODATE="";
$ELENCOVALORI="";
$ELENCODATE2="";
$ELENCOVALORI2="";
$mysqli = new mysqli('localhost', 'root', '1404', 'PasteGo');
	    if ($mysqli->connect_error) {
	        die('Errore di connessione (' . $mysqli->connect_errno . ') '
	        . $mysqli->connect_error);
	    } else {
	    //    echo 'Connesso. ' . $mysqli->host_info . "<br>";
	    }

	  $query1=$mysqli->query("SELECT FileTot.data,count(*) as cnt FROM FileTot GROUP BY FileTot.data");
 	
	  if($query1->num_rows>0){

	  	while($row=$query1->fetch_assoc()){
	  		$ELENCODATE=$ELENCODATE."'".$row['data']."',";
	  		$ELENCOVALORI=$ELENCOVALORI.$row['cnt'].",";

	  	}
	  
	  
	  }


echo "<script>
var data = {
    labels: [".$ELENCODATE."],
    datasets: [
        {
            label: 'Date caricaento file',
            fillColor: 'rgba(200,20,20,0.7)',
            strokeColor: 'rgba(220,220,220,1)',
            pointColor: 'rgba(0,0,255,1)',
            pointStrokeColor: '#fff',
            pointHighlightFill: '#fff',
            pointHighlightStroke: 'rgba(0,0,255,1)',
            data: [".$ELENCOVALORI."]
        }
    ]
};</script>";

$query2=$mysqli->query("SELECT ElencoDown.dateG, count(*) as cnt FROM ElencoDown GROUP BY ElencoDown.dateG");

if($query2->num_rows>0){

	  	while($row=$query2->fetch_assoc()){
	  		$ELENCODATE2=$ELENCODATE2."'".$row['dateG']."',";
	  		$ELENCOVALORI2=$ELENCOVALORI2.$row['cnt'].",";

	  	}
	  
	  
	  }


echo "<script>
var data2 = {
    labels: [".$ELENCODATE2."],
    datasets: [
        {
            label: 'Date caricaento file',
            fillColor: 'rgba(20,20,200,0.7)',
            strokeColor: 'rgba(220,220,220,1)',
            pointColor: 'rgba(220,220,220,1)',
            pointStrokeColor: '#fff',
            pointHighlightFill: '#fff',
            pointHighlightStroke: 'rgba(220,220,220,1)',
            data: [".$ELENCOVALORI2."]
        }
    ]
};</script>";



?>
	</body>
</html>