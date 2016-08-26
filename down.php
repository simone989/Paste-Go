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
                            <li class="active"><a href="downloads.html">Downloads</a></li>
                            <li ><a href="controllo.html">Controllo</a></li>
                            
                            <li class="last"><a href="contacts.html">Contacts</a></li>
                        </ul>
                    </nav>
                </header>


<?php

  //SOMETHING DONE THAT SETS $url
function create_zip($files = array(),$destination = '',$overwrite = false) {
    //if the zip file already exists and overwrite is false, return false
    if(file_exists($destination) && !$overwrite) { return false; }
    //vars
    $valid_files = array();
    //if files were passed in...
    if(is_array($files)) {
        //cycle through each file
        foreach($files as $file) {
            //make sure the file exists
            if(file_exists($file)) {
                $valid_files[] = $file;
            }
        }
    }
   
    if(count($valid_files)) {
      
        $zip = new ZipArchive();
        if($zip->open($destination,$overwrite ? ZIPARCHIVE::OVERWRITE : ZIPARCHIVE::CREATE) !== true) {
            return false;
        }
        
        foreach($valid_files as $file) {
            $zip->addFile($file,$file);
        }

        $zip->close();
      
        return file_exists($destination);
    }
    else
    {
        return false;
    }
}


if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    $ip = $_SERVER['HTTP_CLIENT_IP'];
} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
} else {
    $ip = $_SERVER['REMOTE_ADDR'];
}

$mysqli = new mysqli('localhost', 'root', '', 'PasteGo');
    if ($mysqli->connect_error) {
        die('Errore di connessione (' . $mysqli->connect_errno . ') '
        . $mysqli->connect_error);
    } else {
        echo 'Connesso. ' . $mysqli->host_info . "<br>";
    }



$today = getdate();
$timeI= $today['hours'].":".$today['minutes'].":".$today['seconds'];
$dateI= $today['year']."-".$today['mon']."-".$today['mday'];
$dataoraCan=$dateI." ".$timeI;
//echo $dataoraCan."<br>";
$inserimento=TRUE;

$tempoint=$today['hours'].$today['minutes'];
$tempoint2=intval($tempoint);

$query1= $mysqli->query("SELECT data from ElencoDate where data != '".$dateI."' AND CheckC IS NULL");
$query2= $mysqli->query("SELECT percorso,Codice,Ip,data,ora from file");


//CANCELLAZIONE GIORNALIERA
if($query1->num_rows==1){
    $row4= $query1->fetch_assoc();
    if($row4['data']!=$dateI){
        while($row3 = $query2->fetch_assoc()){
            $mysqli->query("INSERT into Filecancellati(percorso,datacaricamento,oracaricamento,codice,Ip,dataoracancellamento)
                VALUES ('".$row3['percorso']."','".$row3['data']."','".$row3['ora']."','".$row3['Codice']."','".$row3["Ip"]."','".$dataoraCan."')");
    
        }


        $mysqli->query("DELETE FROM file WHERE Codice!= '".$_POST['Code']."'");
        $mysqli->query("UPDATE ElencoDate set CheckC=1 where data!='".$dateI."' AND CheckC IS NULL");
        $mysqli->query("INSERT INTO ElencoDate(data)
            VALUES('".$dateI."')");
        echo "DATI GIORNALIERI CANCELLATI <br>";
        $inserimento=false;
    }
}


//CONTROLLO ORARIO DOPO 10M
$risultato2 = $mysqli->query("SELECT file.oraF FROM file WHERE Codice =".$_POST['Code']." ");
if ($risultato2->num_rows == 1) {
   
    while($row = $risultato2->fetch_assoc()) {
        $tempoQ= $row["oraF"];      
    }

    $tempoOstring= substr($tempoQ,0,2).substr($tempoQ, 3,2);
    $tempoOint= intval($tempoOstring);

    if($tempoint2 >$tempoOint){

        $inserimento=false;

        $query4= $mysqli->query("SELECT file.percorso, file.data, file.ora, file.Codice, file.Ip from file where Codice='".$_POST['Code']."'");

       
      while($row5=$query4->fetch_assoc()){
            echo "prova while <br>";
        $mysqli->query("INSERT into Filecancellati(percorso,datacaricamento,oracaricamento,codice,Ip,dataoracancellamento)
                VALUES ('".$row5['percorso']."','".$row5['data']."','".$row5['ora']."','".$row5['Codice']."','".$row5["Ip"]."','".$dataoraCan."')");

      /*   echo $row5['percorso'].$row5['data'].$row5['ora'].$row5['Codice']." IP; ".$row5['Ip'].$dataoraCan;
*/
      unlink("DirUp/".$row5['percorso']);
      }

        $mysqli->query("DELETE FROM file WHERE Codice=".$_POST['Code']." ");
        echo "CANCELLATO <br>";
        $inserimento=false;
    }
 
}


//PROCEDURA NORMALE
if($inserimento==TRUE && isset($_POST['Code'])){
unlink("MyFile.zip");
$DataOra2=$today['year']."-".$today['mon']."-".$today['mday']." ".$today['hours'].":".$today['minutes'].":".$today['seconds'];

$risultato2 = $mysqli->query("SELECT * FROM file WHERE Codice =".$_POST['Code']." ");




if($risultato2->num_rows==1){

while($row=$risultato2->fetch_assoc()){

$sql="INSERT INTO ElencoDown(CodFile,Ipdown,dateG,ora)
        VALUES(".$_POST['Code'].",'".$ip."','".$row['data']."','".$row['ora']."');";   


    $urlout= "DirUp/".$row["percorso"];
    //$urlout=$row["percorso"];
    if($mysqli->query($sql)===TRUE) echo "OK <br>";
        else  echo "<br>Error " . $mysqli->error."<br>";
}
echo "APERTO";
$files_to_zip = array(
    $urlout
);
//if true, good; if false, zip creation failed
$result = create_zip($files_to_zip,"MyFile.zip");

  header('Location:'."MyFile.zip");  
 
}else
{
    echo "CODICE INSERITO NON PRESENTE NEL DATABSE, INSERIRE UN CODICE CORRETTO";

}
}else echo "SE HAI INSERTO IL FILE DOPO MEZZANOTTE RIPROVARE A EFFETTUARE IL DOWNLOAD, PREMERE F5<BR>";
?>


</body>
</html>
